<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class TemplateDefinition extends EntityDefinition
{
    /**
     * Template primary ID. Used on machine creation.
     *
     * @var integer
     */
    public $id;

    /**
     * Template name includes OS version.
     *
     * @var string
     */
    public $name;
}
