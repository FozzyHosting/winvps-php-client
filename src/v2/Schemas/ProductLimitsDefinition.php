<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class ProductLimitsDefinition extends EntityDefinition
{
    /**
     * @var integer
     */
    public $disk_size;

    /**
     * @var integer
     */
    public $ram_min;

    /**
     * @var integer
     */
    public $ram_max;

    /**
     * @var integer
     */
    public $cpu_percent;

    /**
     * @var integer
     */
    public $cpu_cores;

    /**
     * @var integer
     */
    public $bandwidth;

    /**
     * @var integer
     */
    public $traffic;
}
