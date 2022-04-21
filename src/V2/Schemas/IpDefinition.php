<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class IpDefinition extends EntityDefinition
{
    /**
     * IP version. 4 or 6
     *
     * @var integer
     */
    public $version;

    /**
     * IP address
     *
     * @var string
     */
    public $address;
}
