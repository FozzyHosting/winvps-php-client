<?php

namespace Fozzy\WinVPS\Tests;

use PHPUnit\Framework\TestCase;
use Fozzy\WinVPS\Api\Exceptions\InvalidApiVersion;
use Fozzy\WinVPS\Api\Client;
use Fozzy\WinVPS\Api\V2\Client as ClientV2;
use Fozzy\WinVPS\Api\Exceptions\InvalidHttpClient;

class ClientTest extends TestCase
{
    public function testClientMakeInvalidHttpClient()
    {
        $this->expectException(InvalidHttpClient::class);
        Client::make('test', 'test', 'v2', 'curl');
    }

    public function testClientMakeEmptyHttpClient()
    {
        $client = Client::make('test', 'test', 'v2');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiVersion()
    {
        $this->expectException(InvalidApiVersion::class);
        Client::make('test', 'test', 'v3');
    }

    public function testClientMakeEmptyApiVersion()
    {
        $client = Client::make('test', 'test');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiUrl()
    {
        $this->expectError();
        Client::make('test', ['test']);
    }

    public function testClientMakeEmptyApiUrl()
    {
        $client = Client::make('test');
        $this->assertInstanceOf(ClientV2::class, $client);
    }

    public function testClientMakeInvalidApiKey()
    {
        $this->expectError();
        Client::make(['test']);
    }

    public function testClientMakeEmptyApiKey()
    {
        $this->expectError();
        Client::make();
    }
}
