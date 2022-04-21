<?php

namespace Fozzy\WinVPS\Tests\V2\Entities;

use PHPUnit\Framework\TestCase;
use Fozzy\WinVPS\Api\V2\HttpClients\Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class ApiEntityTest extends TestCase
{
    public function runAPI($class, $method, $params, $response)
    {
        $mock = new MockHandler([$response]);
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Guzzle('test', 'test', $handlerStack);
        $entity = new $class($httpClient);
        return call_user_func_array([$entity, $method], $params);
    }

    public function testNoTest(): void
    {
        $this->markTestSkipped();
    }
}
