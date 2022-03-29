<?php

namespace Fozzy\WinVPS\Tests\V2\Entities;

use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use Fozzy\WinVPS\Api\V2\Entities\Jobs;
use Fozzy\WinVPS\Api\V2\Schemas\JobDefinition;
use Fozzy\WinVPS\Api\V2\Schemas\JobsListResponse;
use GuzzleHttp\Psr7\Response;

class JobsTest extends ApiEntityTest
{
    public function testList()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"parent_id":0,"machine_id":1,"type":"Add IP","status":"Complete","start_time":"2022-03-27 18:49:20"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Jobs::class, 'list', [], $response);
        $this->assertInstanceOf(JobsListResponse::class, $list);
    }

    public function testListWithPage()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":1,"parent_id":0,"machine_id":1,"type":"Add IP","status":"Complete","start_time":"2022-03-27 18:49:20"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Jobs::class, 'list', [1], $response);
        $this->assertInstanceOf(JobsListResponse::class, $list);
    }

    public function testListWithInvalidPage()
    {
        $this->expectException(InvalidApiResponse::class);
        $response = new Response(
            500,
            ['Content-Type' => 'text/html'],
            'An error has occurred.<br />Please try again later or contact support at sales@fozzy.com'
        );

        $this->runAPI(Jobs::class, 'list', [2], $response);
    }

    public function testListOfPending()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":2,"parent_id":1,"machine_id":1,"type":"Add IP","status":"Pending","start_time":"2022-03-27 18:49:20"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Jobs::class, 'listOfPending', [], $response);
        $this->assertInstanceOf(JobsListResponse::class, $list);
    }

    public function testGetById()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"id":1,"parent_id":0,"machine_id":1,"type":"Add IP","status":"Complete","start_time":"2022-03-27 18:49:20"}}'
        );

        $list = $this->runAPI(Jobs::class, 'getById', [1], $response);
        $this->assertInstanceOf(JobDefinition::class, $list);
    }

    public function testGetByIdNotFound()
    {
        $this->expectExceptionMessage('Job doesn`t exists or doesn`t belongs to your machines.');
        $response = new Response(
            400,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"error":"Job doesn`t exists or doesn`t belongs to your machines."}'
        );

        $this->runAPI(Jobs::class, 'getById', [3], $response);
    }

    public function testCancelById()
    {
        $response = new Response(
            204,
            ['Content-Length' => 0]
        );

        $this->assertTrue($this->runAPI(Jobs::class, 'cancelById', [2], $response));
    }

    public function testCancelByIdNotFound()
    {
        $this->expectExceptionMessage('Job doesn`t exists or doesn`t belongs to your machines.');
        $response = new Response(
            400,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"error":"Job doesn`t exists or doesn`t belongs to your machines."}'
        );

        $this->runAPI(Jobs::class, 'cancelById', [2], $response);
    }
}
