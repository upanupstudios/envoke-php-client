<?php

namespace Upanupstudios\Envoke\Php\Client;

class Contacts extends AbstractApi
{
  /**
   * Retrieve a list of interests.
   *
   * @var string $type
   * @var array $params
   *
   * See https://support.envoke.com/en/articles/1697197-contact-api-read
   * Note that the limit is 100 records in a single request and defaults to a limit to 10.
   */
  public function getAll($params = [])
  {
    $url = 'v1/contacts';

    if(empty($params['result_type'])) {
      $params['result_type'] = 'kvp';
    }

    if(!empty($params)) {
      $url .= '?' . http_build_query($params);
    }

    $response = $this->client->request('GET', $url);

    return $response;
  }
}
