<?php

namespace Upanupstudios\Envoke\Php\Client;

class Messages extends AbstractApi
{
  /**
   * Send a new message.
   *
   * @var array $data.
   * See https://support.envoke.com/en/articles/1697213-send-email-api
   */
  public function send(array $data)
  {
    $url = 'api/v4legacy/send/SendEmails';

    $emailDataArray['EmailDataArray'][] = $data;
    $body['SendEmails'][] = $emailDataArray;

    $options['body'] = json_encode($body);

    $response = $this->client->request('POST', $url, $options);

    return $response;
  }
}
