<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class BrandDefinition extends EntityDefinition
{
    /**
     * Brand primary ID. Used on machine creation.
     *
     * @var integer
     */
    public $id;

    /**
     * Brand name
     *
     * @var string
     */
    public $name;
}
