<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class ListResponse
{
    /**
     * Array with EntityDefinition class objects
     *
     * @var EntityDefinition[]
     */
    public $data;

    /**
     * Pagination details
     *
     * @var PaginationDetails
     */
    public $pagination;

    /**
     * Make an object of class ListResponse
     *
     * @param array $response Response from the API
     * @return ListResponse
     */
    public static function make(array $response): ListResponse
    {
        $instance = new static;

        $instance->data = EntityList::make($response['data'], static::ENTITY);
        $instance->pagination = PaginationDetails::make($response['pagination']);

        return $instance;
    }
}
