<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineConfig extends EntityDefinition
{
    /**
     * @var integer
     */
    public $bandwidth;

    /**
     * @var integer
     */
    public $cpu_cores; // phpcs:ignore

    /**
     * @var integer
     */
    public $cpu_percent; // phpcs:ignore

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
}
