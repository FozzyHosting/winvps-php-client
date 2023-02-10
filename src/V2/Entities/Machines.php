<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\CompleteMachinesListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\EntityList;
use Fozzy\WinVPS\Api\V2\Schemas\JobsListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineAddIpResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineCreateResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineDefinition;
use Fozzy\WinVPS\Api\V2\Schemas\MachineChangePasswordResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachineUsersListResponse;
use Fozzy\WinVPS\Api\V2\Schemas\MachinesListResponse;

class Machines extends Entity
{
    /**
     * Returns machines list in short form.
     *
     * @param int $page Page number
     * @return MachinesListResponse
     */
    public function list(int $page = 1): MachinesListResponse
    {
        $response = $this->httpClient->request('machines', 'GET', [], ['page' => $page]);
        return MachinesListResponse::make($response);
    }

    /**
     * Create new machine.
     *
     * @param array $params     Array containing the necessary params of machine
     *
     * $params['product_id']    (integer)   Required. Primary Product ID.
     * $params['template_id']   (integer)   Required. Primary Template ID.
     * $params['location_id']   (integer)   Required. Primary Location ID.
     * $params['password']      (string)    The main machine password used for Administrator user.
     * $params['brand_id']      (integer)   Primary Brand ID.
     * $params['disk_type']     (string)    ['hdd' | 'ssd'] Server disk type. HDD or SSD.
     * $params['add_disk']      (integer)   Additional disk size.
     * $params['add_ram']       (integer)   Additional RAM size in MB.
     * $params['add_cpu']       (integer)   Additional CPU cores count.
     * $params['add_band']      (integer)   Additional bandwidth.
     * $params['auto_start']    (integer)
     * $params['add_ipv6']      (integer)
     * $params['ui_language']   (string) ['en-US' | 'de-DE' | 'ru-RU' | 'zh-CN' | 'ar-SA' | 'ja-JP' | 'ko-KR']
     *
     * @return MachineCreateResponse
     */
    public function create(array $params = []): MachineCreateResponse
    {
        $response = $this->httpClient->request('machines', 'POST', [], [], $params);
        return MachineCreateResponse::make($response['data']);
    }

    /**
     * Returns machines list in complete form.
     *
     * @param int $page Page number
     * @return CompleteMachinesListResponse
     */
    public function listOfFull(int $page = 1): CompleteMachinesListResponse
    {
        $response = $this->httpClient->request('machines/full', 'GET', [], ['page' => $page]);
        return CompleteMachinesListResponse::make($response);
    }

    /**
     * Returns list of currently running machines.
     *
     * @param int $page Page number
     * @return MachinesListResponse
     */
    public function listOfRunning(int $page = 1): MachinesListResponse
    {
        $response = $this->httpClient->request('machines/running', 'GET', [], ['page' => $page]);
        return MachinesListResponse::make($response);
    }

    /**
     * Returns list of currently stopped or suspended machines.
     *
     * @param int $page Page number
     * @return MachinesListResponse
     */
    public function listOfStopped(int $page = 1): MachinesListResponse
    {
        $response = $this->httpClient->request('machines/stopped', 'GET', [], ['page' => $page]);
        return MachinesListResponse::make($response);
    }

    /**
     * Returns machine details.
     *
     * @param string $name Machine name
     * @return MachineDefinition
     */
    public function getByName(string $name): MachineDefinition
    {
        $response = $this->httpClient->request('machines/' . $name);
        return MachineDefinition::make($response['data']);
    }

    /**
     * Update machine details.
     *
     * @param string $name Machine name
     * @param array $params     Array containing the necessary params of machine
     * $params['product_id']    (integer)   Primary Product ID.
     * $params['password']      (string)    The main machine password used for Administrator user.
     * $params['add_disk']      (integer)   Additional disk size.
     * $params['add_ram']       (integer)   Additional RAM size in MB.
     * $params['add_cpu']       (integer)   Additional CPU cores count.
     * $params['add_band']      (integer)   Additional bandwidth.
     *
     * @return JobDefinition[]
     */
    public function updateByName(string $name, array $params = []): array
    {
        $response = $this->httpClient->request('machines/' . $name, 'PUT', [], [], $params);
        $jobs = empty($response['data']['jobs']) ? [] : $response['data']['jobs'];
        return EntityList::make($jobs, 'Job');
    }

    /**
     * Reinstall machine.
     *
     * @param string $name Machine name
     * @param array $params     Array containing the necessary params of machine
     * $params['template_id']   (integer)   Primary Template ID.
     * $params['password']      (string)    The main machine password used for Administrator user.
     * $params['brand_id']      (integer)   Primary Brand ID.
     * $params['auto_start']    (integer)
     *
     * @return JobDefinition[]
     */
    public function reinstallByName(string $name, array $params = []): array
    {
        $response = $this->httpClient->request('machines/' . $name, 'POST', [], [], $params);
        $jobs = empty($response['data']['jobs']) ? [] : $response['data']['jobs'];
        return EntityList::make($jobs, 'Job');
    }

    /**
     * Terminate machine.
     *
     * @param string $name Machine name
     * @return JobDefinition[]
     */
    public function terminateByName(string $name): array
    {
        $response = $this->httpClient->request('machines/' . $name, 'DELETE');
        $jobs = empty($response['data']['jobs']) ? [] : $response['data']['jobs'];
        return EntityList::make($jobs, 'Job');
    }

    /**
     * Returns list of jobs assigned to machine.
     *
     * @param string $name Machine name
     * @param int $page Page number
     * @return JobsListResponse
     */
    public function jobsByName(string $name, int $page = 1): JobsListResponse
    {
        $response = $this->httpClient->request('machines/' . $name . '/jobs', 'GET', [], ['page' => $page]);
        return JobsListResponse::make($response);
    }

    /**
     * Returns list of additional system users.
     *
     * @param string $name Machine name
     * @param int $page Page number
     * @return MachineUsersListResponse
     */
    public function usersByName(string $name, int $page = 1): MachineUsersListResponse
    {
        $response = $this->httpClient->request('machines/' . $name . '/users', 'GET', [], ['page' => $page]);
        return MachineUsersListResponse::make($response);
    }

    /**
     * Change VPS machine password.
     *
     * @param string $name Machine name
     * @param string $password New machine password
     * @return MachineChangePasswordResponse
     */
    public function changePasswordByName(string $name, string $password): MachineChangePasswordResponse
    {
        $params = ['password' => $password];
        $response = $this->httpClient->request('machines/' . $name . '/change_password', 'POST', [], [], $params);
        return MachineChangePasswordResponse::make($response['data']);
    }

    /**
     * Send single command which does not need additional options.
     *
     * @param string $name Machine name
     * @param string $command Command name
     * Command keys:
     *  - start - Start machine
     *  - stop - Stop machine
     *  - restart - Restart machine
     *  - enable_rdp - Enable RDP on machine
     *  - enable_network - Enable network on machine
     *  - restart_mt - Restart MT on machine
     *  - run_updates_install - Install updates on machine
     *
     * @return JobDefinition[]
     */
    public function sendCommandByName(string $name, string $command): array
    {
        $response = $this->httpClient->request('machines/' . $name . '/' . $command, 'POST');
        $jobs = empty($response['data']['jobs']) ? [] : $response['data']['jobs'];
        return EntityList::make($jobs, 'Job');
    }

    /**
     * Send unary machine command.
     *
     * @param string $name Machine name
     * @return MachineAddIpResponse
     */
    public function addIpByName(string $name): MachineAddIpResponse
    {
        $response = $this->httpClient->request('machines/' . $name . '/add_ip', 'POST');
        return MachineAddIpResponse::make($response['data']);
    }
}
