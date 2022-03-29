<?php

namespace Fozzy\WinVPS\Tests\V2;

use PHPUnit\Framework\TestCase;
use Fozzy\WinVPS\Api\V2\HttpClients\Guzzle;
use Fozzy\WinVPS\Api\V2\Client;

class ClientTest extends TestCase
{
    public function testClientInvalidHttpClient()
    {
        $this->expectError();
        new Client('test');
    }

    public function testClientEmptyHttpClient()
    {
        $this->expectError();
        new Client();
    }

    public function testClientCreate()
    {
        $httpClient = new Guzzle('test', 'test');
        $client = new Client($httpClient);
        $this->assertInstanceOf(Client::class, $client);
    }
}
