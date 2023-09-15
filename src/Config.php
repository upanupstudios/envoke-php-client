<?php

namespace Upanupstudios\Envoke\Php\Client;

final class Config
{
  /**
   * The API ID.
   *
   * @var string
   */
  private $apiId;

  /**
   * The API Key.
   *
   * @var string
   */
  private $apiKey;

  public function __construct(string $apiId, string $apiKey)
  {
    $this->apiId = $apiId;
    $this->apiKey = $apiKey;
  }

  /**
   * Get API ID.
   */
  public function getApiId(): string
  {
    return $this->apiId;
  }

  /**
   * Get API Key.
   */
  public function getApiKey(): string
  {
    return $this->apiKey;
  }
}
