<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineUpdateStatus
{
    /**
     * @var integer
     */
    public $h_result; // phpcs:ignore

    /**
     * @var boolean
     */
    public $reboot_required; // phpcs:ignore

    /**
     * @var integer
     */
    public $result_code; // phpcs:ignore

    /**
     * @var string
     */
    public $update_time; // phpcs:ignore

    /**
     * Make an object of class MachineUpdateStatus
     *
     * @param array $updateStatus Update status data
     */
    public static function make(array $updateStatus)
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
