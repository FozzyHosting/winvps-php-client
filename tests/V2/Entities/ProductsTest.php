<?php

namespace Fozzy\WinVPS\Tests\V2\Entities;

use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use Fozzy\WinVPS\Api\V2\Entities\Products;
use Fozzy\WinVPS\Api\V2\Schemas\ProductsListResponse;
use GuzzleHttp\Psr7\Response;

class ProductsTest extends ApiEntityTest
{
    public function testList()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"name":"Test Product","limits":{"cpu_percent":100,"cpu_cores":1,"ram_min":1024,"ram_max":1024,"disk_size":30,"bandwidth":10,"traffic":1}}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Products::class, 'list', [], $response);
        $this->assertInstanceOf(ProductsListResponse::class, $list);
    }

    public function testListWithPage()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"name":"Test Product","limits":{"cpu_percent":100,"cpu_cores":1,"ram_min":1024,"ram_max":1024,"disk_size":30,"bandwidth":10,"traffic":1}}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Products::class, 'list', [1], $response);
        $this->assertInstanceOf(ProductsListResponse::class, $list);
    }

    public function testListWithInvalidPage()
    {
        $this->expectException(InvalidApiResponse::class);
        $response = new Response(
            500,
            ['Content-Type' => 'text/html'],
            'An error has occurred.<br />Please try again later or contact support at sales@fozzy.com'
        );

        $this->runAPI(Products::class, 'list', [2], $response);
    }
}
