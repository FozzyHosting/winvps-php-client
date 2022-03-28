<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class ProductLimitsDefinition extends EntityDefinition
{
    /**
     * @var integer
     */
    public $disk_size; // phpcs:ignore

    /**
     * @var integer
     */
    public $ram_min; // phpcs:ignore

    /**
     * @var integer
     */
    public $ram_max; // phpcs:ignore

    /**
     * @var integer
     */
    public $cpu_percent; // phpcs:ignore

    /**
     * @var integer
     */
    public $cpu_cores; // phpcs:ignore

    /**
     * @var integer
     */
    public $bandwidth;

    /**
     * @var integer
     */
    public $traffic;
}
