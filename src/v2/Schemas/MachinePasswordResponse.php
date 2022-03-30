<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class MachinePasswordResponse
{
    /**
     * Machine primary ID.
     *
     * @var integer
     */
    public $id;

    /**
     * Machine name.
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
     * The password for the root user of the machine.
     *
     * @var string
     */
    public $password;

    /**
     * List of additional machine users
     *
     * @var AdditionalMachineUser[]
     */
    public $users;

    /**
     * @throws MappingException
     */
    public static function make(array $machinePassword)
    {
        $instance = new self;

        foreach ($instance as $key => $value) {
            if (!isset($machinePassword[$key])) {
                throw new MappingException('Missing ' . $key . ' for ' . __CLASS__);
            }

            if ($key == 'users') {
                $instance->users = EntityList::make($machinePassword['users'], 'AdditionalMachineUser');
            } else {
                $instance->$key = $machinePassword[$key];
            }
        }

        return $instance;
    }
}
