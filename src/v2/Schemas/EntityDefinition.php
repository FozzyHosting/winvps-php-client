<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

use Fozzy\WinVPS\Api\Exceptions\MappingException;

class EntityDefinition
{
    /**
     * Make an object of class EntityDefinition
     *
     * @param array $entity Entity data
     * @return EntityDefinition
     * @throws MappingException
     */
    public static function make(array $entity): EntityDefinition
    {
        $instance = new static;

        foreach ($instance as $key => $value) {
            if (!isset($entity[$key])) {
                throw new MappingException('Missing ' . $key . ' for ' . static::class);
            }

            $instance->$key = $entity[$key];
        }

        return $instance;
    }
}
