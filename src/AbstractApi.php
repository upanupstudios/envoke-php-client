<?php

namespace Upanupstudios\Envoke\Php\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractApi
{
  /**
   * @var Envoke
   */
  protected $client;

  public function __construct(Envoke $client)
  {
      $this->client = $client;
  }
}
