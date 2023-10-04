<?php

namespace Upanupstudios\Envoke\Php\Client;

class Interests extends AbstractApi
{
  /**
   * Retrieve a list of interests.
   *
   * @var string $type
   * @var array $params
   */
  public function getAll($type = null, $params = [])
  {
    $url = 'v2/interests';

    if(!empty($type)) {
      $params['type'] = $type;
    }

    if(!empty($params)) {
      $url .= '?' . http_build_query($params);
    }

    $response = $this->client->request('GET', $url);

    return $response;
  }
}
