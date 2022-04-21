<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class PaginationDetails extends EntityDefinition
{
    /**
     * The total number of entries available in the entire collection
     *
     * @var integer
     */
    public $total;

    /**
     * The number of entries returned per page (default: 50)
     *
     * @var integer
     */
    public $limit;

    /**
     * The page currently returned (default: 1)
     *
     * @var integer
     */
    public $page;

    /**
     * The total number of pages
     *
     * @var integer
     */
    public $pages;
}
