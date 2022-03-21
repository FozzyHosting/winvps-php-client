<?php

namespace Fozzy\WinVPS\Api\V2;

use Fozzy\WinVPS\Api\V2\Entities\Brands;
use Fozzy\WinVPS\Api\V2\Entities\Jobs;
use Fozzy\WinVPS\Api\V2\Entities\Locations;
use Fozzy\WinVPS\Api\V2\Entities\Machines;
use Fozzy\WinVPS\Api\V2\Entities\Products;
use Fozzy\WinVPS\Api\V2\Entities\Templates;
use Fozzy\WinVPS\Api\V2\HttpClients\HttpClient;

class Client
{
    /**
     * Default endpoint for API v2
     */
    const DEFAULT_API_URL = 'https://winvps.fozzy.com/api/v2/';

    /**
     * @var Brands
     */
    public $brands;

    /**
     * @var Jobs
     */
    public $jobs;

    /**
     * @var Locations
     */
    public $locations;

    /**
     * @var Machines
     */
    public $machines;

    /**
     * @var Products
     */
    public $products;

    /**
     * @var Templates
     */
    public $templates;

    public function __construct(HttpClient $httpClient)
    {
        $this->brands = new Brands($httpClient);
        $this->jobs = new Jobs($httpClient);
        $this->locations = new Locations($httpClient);
        $this->machines = new Machines($httpClient);
        $this->products = new Products($httpClient);
        $this->templates = new Templates($httpClient);
    }
}
