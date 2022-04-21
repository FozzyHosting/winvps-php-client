<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineOS
{
    /**
     * Template primary ID.
     *
     * @var integer
     */
    public $template_id; // phpcs:ignore

    /**
     * Brand primary ID.
     *
     * @var integer
     */
    public $brand_id; // phpcs:ignore

    /**
     * Machine update status
     *
     * @var MachineUpdateStatus
     */
    public $update_status; // phpcs:ignore

    /**
     * Make an object of class MachineOS
     *
     * @param array $machineOs Machine OS data
     * @return MachineOS
     */
    public static function make(array $machineOs): MachineOS
    {
        $instance = new self;

        if (isset($machineOs['template_id'])) {
            $instance->template_id = $machineOs['template_id']; // phpcs:ignore
        }

        if (isset($machineOs['brand_id'])) {
            $instance->brand_id = $machineOs['brand_id']; // phpcs:ignore
        }

        if (isset($machineOs['update_status'])) {
            $instance->update_status = MachineUpdateStatus::make($machineOs['update_status']); // phpcs:ignore
        }

        return $instance;
    }
}
