<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class MachineDefinition
{
    /**
     * Machine name and primary Key.
     *
     * @var string
     */
    public $name;

    /**
     * Current machine status.
     *
     * @var string
     */
    public $status;

    /**
     * Machine notes.
     *
     * @var string
     */
    public $notes;

    /**
     * List of IPs assegned to the Machine.
     *
     * @var IpDefinition
     */
    public $ips;

    /**
     * Details of the Machine operating system and brand.
     *
     * @var MachineOS
     */
    public $os;

    /**
     * Machine resources. Includes both additional resources and default product-defined resources.
     *
     * @var MachineConfig
     */
    public $config;

    /**
     * Make an object of class MachineDefinition
     *
     * @param array $machine Machine data
     * @throws MappingException
     */
    public static function make(array $machine)
    {
        $instance = new self;

        if (!isset($machine['name'])) {
            throw new MappingException('Missing name for ' . __CLASS__);
        }

        $instance->name = $machine['name'];

        if (!isset($machine['status'])) {
            throw new MappingException('Missing status for ' . __CLASS__);
        }

        $instance->status = $machine['status'];

        if (!isset($machine['notes'])) {
            throw new MappingException('Missing notes for ' . __CLASS__);
        }

        $instance->notes = $machine['notes'];

        if (isset($machine['ips'])) {
            $instance->ips = EntityList::make($machine['ips'], 'Ip');
        }

        if (isset($machine['os'])) {
            $instance->os = MachineOS::make($machine['os']);
        }

        if (isset($machine['config'])) {
            $instance->config = MachineConfig::make($machine['config']);
        }

        return $instance;
    }
}
