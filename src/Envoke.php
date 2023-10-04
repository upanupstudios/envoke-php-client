<?php

namespace Upanupstudios\Envoke\Php\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class Envoke
{
  /**
   * The REST API URL.
   *
   * @var string $api_url
   */
  private $api_url = 'https://e1.envoke.com';


  /**
   * The config class
   *
   * @var Config $api_url
   */
  private $config;

  /**
   * The http client interface.
   *
   * @var ClientInterface $httpClient
   */
  private $httpClient;

  public function __construct(Config $config, ClientInterface $httpClient)
  {
    $this->config = $config;
    $this->httpClient = $httpClient;
  }

  public function getApiUrl()
  {
    return $this->api_url;
  }

  public function getConfig(): Config
  {
    return $this->config;
  }

  public function request(string $method, string $uri, array $options = [])
  {
    try {
      $credentials = base64_encode($this->config->getApiId() . ':' . $this->config->getApiKey());

      $defaultOptions = [
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
          'Authorization' => 'Basic '.$credentials
        ]
      ];

      if(!empty($options)) {
        //TODO: This might not be a deep merge...
        $options = array_merge($defaultOptions, $options);
      } else {
        $options = $defaultOptions;
      }

      $request = $this->httpClient->request($method, $this->api_url.'/'.$uri, $options);

      $body = $request->getBody();
      $response = $body->__toString();

      if($uri == 'api/v4legacy/send/SendEmails') {
        // API returning deprecation errors, remove them to get a proper response
        $response = substr($response, strpos($response, '['));
      }

      // Return as array
      $response = json_decode($response, TRUE);
    } catch (\JsonException $exeption) {
      $response = $exeption->getMessage();
    } catch (RequestException $exception) {
      $response = $exception->getMessage();
    }

    return $response;
  }

  public function ping()
  {
    $response = $this->request('GET', 'v1/contacts');

    return $response;
  }

  /**
   * @return object
   *
   * @throws \InvalidArgumentException
   *  If $class does not exist.
   */
  public function api(string $class)
  {
    switch ($class) {
      case 'interests':
        $api = new Interests($this);
        break;

      case 'messages':
        $api = new Messages($this);
        break;

      case 'contacts':
        $api = new Contacts($this);
        break;

      default:
        throw new \InvalidArgumentException("Undefined api instance called: '$class'.");
    }

    return $api;
  }

  public function __call(string $name, array $args): object
  {
    try {
        return $this->api($name);
    } catch (\InvalidArgumentException $e) {
        throw new \BadMethodCallException("Undefined method called: '$name'.");
    }
  }
}
