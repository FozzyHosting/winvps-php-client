<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class MachineCreateResponse
{
    /**
     * Machine name
     *
     * @var string
     */
    public $name;

    /**
     * Job list
     *
     * @var JobDefinition[]
     */
    public $jobs;

    /**
     * Make an object of class ListResponse
     *
     * @param array $response Response from the API
     * @return MachineCreateResponse
     * @throws MappingException
     */
    public static function make(array $response): MachineCreateResponse
    {
        $instance = new self;

        if (!isset($response['name'])) {
            throw new MappingException('Missing name for ' . __CLASS__);
        }

        $instance->name = $response['name'];

        if (!isset($response['jobs'])) {
            throw new MappingException('Missing jobs for ' . __CLASS__);
        }

        $instance->jobs = EntityList::make($response['jobs'], 'Job');

        return $instance;
    }
}
