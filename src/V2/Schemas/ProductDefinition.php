<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class ProductDefinition
{
    /**
     * Product primary ID. Used on machine creation.
     *
     * @var integer
     */
    public $id;

    /**
     * Product name.
     *
     * @var string
     */
    public $name;

    /**
     * Predefined product resources.
     *
     * @var ProductLimitsDefinition
     */
    public $limits;

    /**
     * Make an object of class ProductDefinition
     *
     * @param array $product Product data
     * @return ProductDefinition
     * @throws MappingException
     */
    public static function make(array $product): ProductDefinition
    {
        $instance = new self;

        foreach ($instance as $key => $value) {
            if (!isset($product[$key])) {
                throw new MappingException('Missing ' . $key . ' for ' . __CLASS__);
            }

            if ($key == 'limits') {
                $instance->limits = ProductLimitsDefinition::make($product['limits']);
            } else {
                $instance->$key = $product[$key];
            }
        }

        return $instance;
    }
}
