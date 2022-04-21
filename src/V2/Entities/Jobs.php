<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\JobDefinition;
use Fozzy\WinVPS\Api\V2\Schemas\JobsListResponse;

class Jobs extends Entity
{
    /**
     * List of all planned and completed commands.
     *
     * @param int $page Page number
     * @return JobsListResponse
     */
    public function list(int $page = 1): JobsListResponse
    {
        $response = $this->httpClient->request('jobs', 'GET', [], ['page' => $page]);
        return JobsListResponse::make($response);
    }

    /**
     * List of all planned commands.
     *
     * @param int $page Page number
     * @return JobsListResponse
     */
    public function listOfPending(int $page = 1): JobsListResponse
    {
        $response = $this->httpClient->request('jobs/pending', 'GET', [], ['page' => $page]);
        return JobsListResponse::make($response);
    }

    /**
     * View single Job details.
     *
     * @param int $id Job ID
     * @return JobDefinition
     */
    public function getById(int $id): JobDefinition
    {
        $response = $this->httpClient->request('jobs/' . $id);
        return JobDefinition::make($response['data']);
    }

    /**
     * Cancel specified Job.
     *
     * @param int $id Job ID
     * @return bool
     */
    public function cancelById(int $id): bool
    {
        return $this->httpClient->request('jobs/' . $id, 'DELETE');
    }
}
