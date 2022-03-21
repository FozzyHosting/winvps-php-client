<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class LocationDefinition extends EntityDefinition
{
    /**
     * Location primary ID. Used on machine creation.
     *
     * @var integer
     */
    public $id;

    /**
     * Location name. Can includes country, city, data center name, etc.
     *
     * @var string
     */
    public $name;
}
