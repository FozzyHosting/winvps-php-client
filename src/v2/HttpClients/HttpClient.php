<?php

namespace Fozzy\WinVPS\Api\V2\HttpClients;

class HttpClient
{
    /**
     * API Token
     *
     * @var string
     */
    public $apiKey;

    /**
     * API Url
     *
     * @var string
     */
    public $apiUrl;

    public function __construct(string $apiKey, string $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }
}
