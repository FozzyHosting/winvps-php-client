<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\LocationsListResponse;

class Locations extends Entity
{
    /**
     * Returns list of locations available for new machines.
     *
     * @param int $page Page number
     * @return LocationsListResponse
     */
    public function list(int $page = 1): LocationsListResponse
    {
        $response = $this->httpClient->request('locations', 'GET', [], ['page' => $page]);
        return LocationsListResponse::make($response);
    }
}
