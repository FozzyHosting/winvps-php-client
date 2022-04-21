<?php

namespace Fozzy\WinVPS\Tests\V2\HttpClients;

use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use PHPUnit\Framework\TestCase;
use Fozzy\WinVPS\Api\V2\HttpClients\Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class GuzzleTest extends TestCase
{
    public function testGuzzleInvalidHandler()
    {
        $this->expectError();
        new Guzzle('test', 'test', ['test']);
    }

    public function testGuzzleEmptyHandler()
    {
        $client = new Guzzle('test', 'test');
        $this->assertInstanceOf(Guzzle::class, $client);
    }

    public function testGuzzleValidHandler()
    {
        $mock = new MockHandler(
            [new Response(200, ['Content-Length' => 0])]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $this->assertInstanceOf(Guzzle::class, $client);
    }

    public function testGuzzleInvalidApiUrl()
    {
        $this->expectError();
        new Guzzle('test', ['test']);
    }

    public function testGuzzleEmptyApiUrl()
    {
        $this->expectError();
        new Guzzle('test');
    }

    public function testGuzzleInvalidApiKey()
    {
        $this->expectError();
        new Guzzle(['test'], 'test');
    }

    public function testGuzzleNullApiKey()
    {
        $this->expectError();
        new Guzzle(null, 'test');
    }

    public function testGuzzleRequestEmptyResource()
    {
        $this->expectError();
        $client = new Guzzle('test', 'test');
        $client->request();
    }

    public function testGuzzleStdClassResponse()
    {
        $mock = new MockHandler(
            [new Response(
                200,
                ['Content-Type' => 'application/json; charset=UTF-8'],
                '{"data":[{"id":4,"name":"MetaTrader Exness"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('brands');
        $this->assertIsArray($response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('pagination', $response);
    }

    public function testGuzzleTrueResponse()
    {
        $mock = new MockHandler(
            [new Response(
                204,
                ['Content-Length' => 0]
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('jobs/test', 'DELETE');
        $this->assertTrue($response);
    }

    public function testGuzzleExceptionResponse()
    {
        $this->expectException(InvalidApiResponse::class);
        $mock = new MockHandler(
            [new Response(
                500,
                ['Content-Type' => 'text/html'],
                'An error has occurred.<br />Please try again later or contact support at sales@fozzy.com'
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $response = $client->request('brands', 'GET', [], ['page' => 2]);
    }

    public function testGuzzleErrorResponse()
    {
        $this->expectExceptionMessage('Job doesn`t exists or doesn`t belongs to your machines.');
        $mock = new MockHandler(
            [new Response(
                404,
                ['Content-Type' => 'application/json; charset=UTF-8'],
                '{"error":"Job doesn`t exists or doesn`t belongs to your machines."}'
            )]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Guzzle('test', 'test', $handlerStack);
        $client->request('jobs/test', 'DELETE');
    }
}
