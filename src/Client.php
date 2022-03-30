<?php

namespace Fozzy\WinVPS\Api;

use Fozzy\WinVPS\Api\Exceptions\InvalidApiVersion;
use Fozzy\WinVPS\Api\Exceptions\InvalidHttpClient;

class Client
{
    /**
     * Make an API client
     *
     * @param string $apiKey API Token
     * @param string $apiUrl API Url
     * @param string $apiVersion API Version
     * @param string $httpClient HTTP Client
     */
    public static function make(string $apiKey, string $apiUrl = null, string $apiVersion = 'v2', string $httpClient = 'guzzle')
    {
        $clientClassname = __NAMESPACE__ . '\\' . ucfirst($apiVersion) . '\\Client';
        if (!class_exists($clientClassname)) {
            throw new InvalidApiVersion;
        }

        $httpClientClassname = __NAMESPACE__ . '\\' . ucfirst($apiVersion) . '\\HttpClients\\' . ucfirst($httpClient);
        if (!class_exists($httpClientClassname)) {
            throw new InvalidHttpClient;
        }

        $apiUrl = empty($apiUrl) ? $clientClassname::DEFAULT_API_URL : $apiUrl;
        $httpClient = new $httpClientClassname($apiKey, $apiUrl);

        return new $clientClassname($httpClient);
    }
}
