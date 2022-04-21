<?php

namespace Fozzy\WinVPS\Tests\V2\Entities;

use PHPUnit\Framework\TestCase;
use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use Fozzy\WinVPS\Api\V2\Entities\Locations;
use Fozzy\WinVPS\Api\V2\HttpClients\Guzzle;
use Fozzy\WinVPS\Api\V2\Schemas\LocationsListResponse;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class LocationsTest extends ApiEntityTest
{
    public function testList()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"name":"Test Location"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Locations::class, 'list', [], $response);
        $this->assertInstanceOf(LocationsListResponse::class, $list);
    }

    public function testListWithPage()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"name":"Test Location"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Locations::class, 'list', [1], $response);
        $this->assertInstanceOf(LocationsListResponse::class, $list);
    }

    public function testListWithInvalidPage()
    {
        $this->expectException(InvalidApiResponse::class);
        $response = new Response(
            500,
            ['Content-Type' => 'text/html'],
            'An error has occurred.<br />Please try again later or contact support at sales@fozzy.com'
        );

        $this->runAPI(Locations::class, 'list', [2], $response);
    }
}
