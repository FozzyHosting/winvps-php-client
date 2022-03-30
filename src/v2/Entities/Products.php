<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\ProductsListResponse;

class Products extends Entity
{
    /**
     * Returns list of all available products.
     *
     * @param int $page Page number
     * @return ProductsListResponse
     */
    public function list(int $page = 1): ProductsListResponse
    {
        $response = $this->httpClient->request('products', 'GET', [], ['page' => $page]);
        return ProductsListResponse::make($response);
    }
}
