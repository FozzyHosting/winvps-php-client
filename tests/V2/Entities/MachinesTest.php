<?php

namespace Fozzy\WinVPS\Tests\V2\Entities;

use Fozzy\WinVPS\Api\Exceptions\InvalidApiResponse;
use Fozzy\WinVPS\Api\V2\Entities\Machines;
use Fozzy\WinVPS\Api\V2\Schemas\CompleteMachinesListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\JobDefinition;
use Fozzy\WinVPS\Api\V2\Schemas\JobsListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineAddIpResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineCreateResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineDefinition;
use Fozzy\WinVPS\Api\V2\Schemas\MachineChangePasswordResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachinesListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineUsersListResponse;
use GuzzleHttp\Psr7\Response;

class MachinesTest extends ApiEntityTest
{
    public function testList()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"name":"VPSTest","status":"Running","notes":""}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'list', [], $response);
        $this->assertInstanceOf(MachinesListResponse::class, $list);
    }

    public function testListWithPage()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"name":"VPSTest","status":"Running","notes":""}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'list', [1], $response);
        $this->assertInstanceOf(MachinesListResponse::class, $list);
    }

    public function testListWithInvalidPage()
    {
        $this->expectException(InvalidApiResponse::class);
        $response = new Response(
            500,
            ['Content-Type' => 'text/html'],
            'An error has occurred.<br />Please try again later or contact support at sales@fozzy.com'
        );

        $this->runAPI(Machines::class, 'list', [2], $response);
    }

    public function testCreate()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"name":"VPSTest","jobs":[{"id":2,"parent_id":1,"machine_id":1,"type":"Initialize","status":"Pending","start_time":"2022-03-29 15:50:15"}]}}'
        );

        $machine = $this->runAPI(
            Machines::class,
            'create',
            [
                [
                    'product_id' => 1,
                    'template_id' => 1,
                    'location_id' => 1,
                ]
            ],
            $response
        );
        $this->assertInstanceOf(MachineCreateResponse::class, $machine);
    }

    public function testCreateError()
    {
        $this->expectExceptionMessage('Error: No free IP found for allocating service.');
        $response = new Response(
            400,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"error":"Error: No free IP found for allocating service."}'
        );

        $this->runAPI(
            Machines::class,
            'create',
            [
                [
                    'product_id' => 1,
                    'template_id' => 1,
                    'location_id' => 1,
                ]
            ],
            $response
        );
    }

    public function testListOfFull()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"name":"VPSTest","status":"In Progress","notes":"","ips":[{"version":4,"address":"xxx.xxx.xxx.xxx"}],"config":{"bandwidth":10,"cpu_cores":1,"cpu_percent":100,"disk_size":30,"ram_min":1024,"ram_max":1500},"os":{"template_id":"1"}}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'listOfFull', [], $response);
        $this->assertInstanceOf(CompleteMachinesListResponse::class, $list);
    }

    public function testListOfRunning()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"name":"VPSTest","status":"Running","notes":""}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'listOfRunning', [], $response);
        $this->assertInstanceOf(MachinesListResponse::class, $list);
    }

    public function testListOfStopped()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"name":"VPSTest","status":"Stopped","notes":""}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'listOfStopped', [], $response);
        $this->assertInstanceOf(MachinesListResponse::class, $list);
    }

    public function testGetByName()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"name":"VPSTest","status":"Running","notes":"","ips":[{"version":4,"address":"xxx.xxx.xxx.xxx"}],"config":{"bandwidth":10,"cpu_cores":1,"cpu_percent":100,"disk_size":30,"ram_min":1024,"ram_max":1500},"os":{"template_id":"1"}}}'
        );

        $machine = $this->runAPI(Machines::class, 'getByName', ['VPSTest'], $response);
        $this->assertInstanceOf(MachineDefinition::class, $machine);
    }

    public function testGetByNameNotFound()
    {
        $this->expectExceptionMessage('Machine doesn`t exists or doesn`t belongs to you.');
        $response = new Response(
            404,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"error":"Machine doesn`t exists or doesn`t belongs to you."}'
        );

        $this->runAPI(Machines::class, 'getByName', ['VPSTest'], $response);
    }

    public function testUpdateByName()
    {
        $response = new Response(
            202,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"jobs":[{"id":3,"parent_id":2,"machine_id":1,"type":"Set Password","status":"Pending","start_time":"2022-03-29 16:31:37"}]}}'
        );

        $jobs = $this->runAPI(
            Machines::class,
            'updateByName',
            [
                'VPSTest',
                [
                    'password' => 'testpassword',
                ]
            ],
            $response
        );
        $this->assertIsArray($jobs);
        $this->assertGreaterThan(0, count($jobs));
        $this->assertInstanceOf(JobDefinition::class, $jobs[0]);
    }

    public function testReinstallByName()
    {
        $response = new Response(
            202,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"jobs":[{"id":5,"parent_id":4,"machine_id":1,"type":"Initialize","status":"Pending","start_time":"2022-03-29 16:38:30"}]}}'
        );

        $jobs = $this->runAPI(
            Machines::class,
            'reinstallByName',
            [
                'VPSTest',
                [
                    'password' => 'testpassword',
                ]
            ],
            $response
        );
        $this->assertIsArray($jobs);
        $this->assertGreaterThan(0, count($jobs));
        $this->assertInstanceOf(JobDefinition::class, $jobs[0]);
    }

    public function testTerminateByName()
    {
        $response = new Response(
            202,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"jobs":[{"id":6,"parent_id":5,"machine_id":1,"type":"Remove","status":"Pending","start_time":"2022-03-31 16:41:33"}]}}'
        );

        $jobs = $this->runAPI(Machines::class, 'terminateByName', ['VPSTest'], $response);
        $this->assertIsArray($jobs);
        $this->assertGreaterThan(0, count($jobs));
        $this->assertInstanceOf(JobDefinition::class, $jobs[0]);
    }

    public function testJobsByName()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"id":6,"parent_id":5,"machine_id":1,"type":"Remove","status":"Pending","start_time":"2022-03-31 16:41:33"}],"pagination":{"total":1,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'jobsByName', ['VPSTest'], $response);
        $this->assertInstanceOf(JobsListResponse::class, $list);
    }

    public function testUsersByName()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":[{"username":"testuser","role":"testrole","password":"testpassword"}],"pagination":{"total":0,"limit":50,"page":1,"pages":1}}'
        );

        $list = $this->runAPI(Machines::class, 'usersByName', ['VPSTest'], $response);
        $this->assertInstanceOf(MachineUsersListResponse::class, $list);
    }

    public function testChangePasswordByName()
    {
        $response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"result":true}}'
        );

        $changePassword = $this->runAPI(Machines::class, 'changePasswordByName', ['VPSTest', 'testpass'], $response);
        $this->assertInstanceOf(MachineChangePasswordResponse::class, $changePassword);
    }

    public function testSendCommandByName()
    {
        $response = new Response(
            202,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"jobs":[{"id":7,"parent_id":6,"machine_id":1,"type":"Start","status":"Pending","start_time":"2022-03-29 17:00:44"}]}}'
        );

        $jobs = $this->runAPI(Machines::class, 'sendCommandByName', ['VPSTest', 'start'], $response);
        $this->assertIsArray($jobs);
        $this->assertGreaterThan(0, count($jobs));
        $this->assertInstanceOf(JobDefinition::class, $jobs[0]);
    }

    public function testAddIpByName()
    {
        $response = new Response(
            202,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            '{"data":{"address":"xxx.xxx.xxx.xxx","jobs":[{"id":8,"parent_id":7,"machine_id":1,"type":"Add IP","status":"Pending","start_time":"2022-03-29 17:05:04"}]}}'
        );

        $addIp = $this->runAPI(Machines::class, 'addIpByName', ['VPSTest'], $response);
        $this->assertInstanceOf(MachineAddIpResponse::class, $addIp);
    }
}
