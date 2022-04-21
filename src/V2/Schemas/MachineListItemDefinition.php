<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class MachineListItemDefinition extends EntityDefinition
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
}
