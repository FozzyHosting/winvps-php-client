<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class MachineAddIpResponse
{
    /**
     * IP address
     *
     * @var string
     */
    public $address;

    /**
     * Job list
     *
     * @var JobDefinition[]
     */
    public $jobs;

    /**
     * Make an object of class MachineAddIpResponse
     *
     * @param array $addIP Additional IP data
     * @throws MappingException
     */
    public static function make(array $addIP)
    {
        $instance = new self;

        if (!isset($addIP['address'])) {
            throw new MappingException('Missing address for ' . __CLASS__);
        }

        $instance->address = $addIP['address'];

        if (!isset($addIP['jobs'])) {
            throw new MappingException('Missing jobs for ' . __CLASS__);
        }

        $instance->jobs = EntityList::make($addIP['jobs'], 'Job');

        return $instance;
    }
}
