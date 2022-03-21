<?php

namespace Fozzy\WinVPS\Api\V2\Entities;

use Fozzy\WinVPS\Api\V2\Schemas\TemplatesListResponse;

class Templates extends Entity
{
    /**
     * Returns list of all templates available for new machines.
     *
     * @param int $page Page number
     * @return TemplatesListResponse
     */
    public function list(int $page = 1): TemplatesListResponse
    {
        $response = $this->httpClient->request('templates', 'GET', [], ['page' => $page]);
        return TemplatesListResponse::make($response);
    }
}
