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
    public $cpu_cores;

    /**
     * @var integer
     */
    public $cpu_percent;

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
}
