<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\BrandsListResponse;

class Brands extends Entity
{
    /**
     * Returns list of all available preinstalled software set.
     *
     * @param int $page Page number
     * @return BrandsListResponse
     */
    public function list(int $page = 1): BrandsListResponse
    {
        $response = $this->httpClient->request('brands', 'GET', [], ['page' => $page]);
        return BrandsListResponse::make($response);
    }
}
