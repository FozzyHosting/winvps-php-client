<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

/**
 * Credentials for additional machine user
 */
class AdditionalMachineUserDefinition extends EntityDefinition
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;
}
