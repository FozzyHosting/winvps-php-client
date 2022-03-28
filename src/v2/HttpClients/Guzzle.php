<?php

namespace Fozzy\WinVPS\Api\V2\HttpClients;

use Exception;
use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use Fozzy\WinVPS\Api\V2\HttpClients\HttpClient;
use GuzzleHttp\Client;

class Guzzle extends HttpClient
{
    /**
     * Guzzle client
     */
    public $client;

    public function __construct(string $apiKey, string $apiUrl)
    {
        parent::__construct($apiKey, $apiUrl);

        $this->client = new Client(
            [
                'allow_redirects' => false,
                'base_uri' => $this->apiUrl,
                'headers' => [
                    'API-KEY' => $this->apiKey,
                ],
                'http_errors' => false,
            ]
        );
    }

    /**
     * Send request to API
     *
     * @param string $resource API resource
     * @param string $method Request method
     * @param array $headers Request headers
     * @param array $queryParams Request GET params
     * @param array $formParams Request form params
     *
     * @throws InvalidApiResponse
     * @throws Exception
     */
    public function request(string $resource, string $method = 'GET', array $headers = [], array $queryParams = [], array $formParams = [])
    {
        $options = [];
        if (!empty($headers)) {
            $options['headers'] = $headers;
        }
        if (!empty($queryParams)) {
            $options['query'] = $queryParams;
        }
        if (!empty($formParams)) {
            $options['form_params'] = $formParams;
        }

        $response = $this->client->request($method, $resource, $options);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        if ($statusCode == 204 && empty($content)) {
            return true;
        }

        $content = json_decode($content, true);
        if (is_null($content)) {
            throw new InvalidApiResponse;
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400 || !empty($content['error'])) {
            $error = empty($content['error']) ? $response->getReasonPhrase() : $content['error'];
            throw new Exception($error);
        }

        return $content;
    }
}
