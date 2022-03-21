<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineUpdateStatus
{
    /**
     * @var integer
     */
    public $h_result;

    /**
     * @var boolean
     */
    public $reboot_required;

    /**
     * @var integer
     */
    public $result_code;

    /**
     * @var string
     */
    public $update_time;

    /**
     * Make an object of class MachineUpdateStatus
     *
     * @param array $updateStatus Update status data
     * @return MachineUpdateStatus
     */
    public static function make(array $updateStatus): MachineUpdateStatus
    {
        $instance = new self;

        foreach ($instance as $key => $value) {
            if (isset($updateStatus[$key])) {
                $instance->$key = $updateStatus[$key];
            }
        }

        return $instance;
    }
}
