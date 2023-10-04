<?php

namespace Upanupstudios\Envoke\Php\Client;

abstract class AbstractApi
{
  /**
   * @var Envoke $client.
   */
  protected $client;

  public function __construct(Envoke $client)
  {
      $this->client = $client;
  }
}
