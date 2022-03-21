<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class JobDefinition extends EntityDefinition
{
    /**
     * Job primary ID. Can be used to show Job details or cancel the command.
     *
     * @var integer
     */
    public $id;

    /**
     * ID of the last Job before the current one. Since the commands are executed
     * sequentially, parent ID can be used to monitor the progress of command processing.
     *
     * @var integer
     */
    public $parent_id;

    /**
     * ID of the machine Job created for.
     *
     * @var integer
     */
    public $machine_id;

    /**
     * Defines the command which be executed.
     *
     * @var string
     */
    public $type;

    /**
     * Command status.
     *
     * @var string
     */
    public $status;

    /**
     * Time after which the command can be started. The Job will not be started before
     * this time but can be started some time later when the queue reaches its completion.
     *
     * @var string
     */
    public $start_time;
}
