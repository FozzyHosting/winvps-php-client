<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineUserDefinition extends EntityDefinition
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $password;
}
