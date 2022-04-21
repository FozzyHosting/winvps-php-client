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
    public $brandsInstance;

    /**
     * @var Jobs
     */
    public $jobsInstance;

    /**
     * @var Locations
     */
    public $locationsInstance;

    /**
     * @var Machines
     */
    public $machinesInstance;

    /**
     * @var Products
     */
    public $productsInstance;

    /**
     * @var Templates
     */
    public $templatesInstance;

    /**
     * @var HttpClient
     */
    public $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Create and return Brands instance
     *
     * @return Brands
     */
    public function brands(): Brands
    {
        if (!$this->brandsInstance) {
            $this->brandsInstance = new Brands($this->httpClient);
        }

        return $this->brandsInstance;
    }

    /**
     * Create and return Jobs instance
     *
     * @return Jobs
     */
    public function jobs(): Jobs
    {
        if (!$this->jobsInstance) {
            $this->jobsInstance = new Jobs($this->httpClient);
        }

        return $this->jobsInstance;
    }

    /**
     * Create and return Locations instance
     *
     * @return Locations
     */
    public function locations(): Locations
    {
        if (!$this->locationsInstance) {
            $this->locationsInstance = new Locations($this->httpClient);
        }

        return $this->locationsInstance;
    }

    /**
     * Create and return Machines instance
     *
     * @return Machines
     */
    public function machines(): Machines
    {
        if (!$this->machinesInstance) {
            $this->machinesInstance = new Machines($this->httpClient);
        }

        return $this->machinesInstance;
    }

    /**
     * Create and return Products instance
     *
     * @return Products
     */
    public function products(): Products
    {
        if (!$this->productsInstance) {
            $this->productsInstance = new Products($this->httpClient);
        }

        return $this->productsInstance;
    }

    /**
     * Create and return Templates instance
     *
     * @return Templates
     */
    public function templates(): Templates
    {
        if (!$this->templatesInstance) {
            $this->templatesInstance = new Templates($this->httpClient);
        }

        return $this->templatesInstance;
    }
}
