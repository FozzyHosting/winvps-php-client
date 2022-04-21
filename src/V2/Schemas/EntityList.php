<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class EntityList
{
    /**
     * Make an array with EntityDefinition class objects
     *
     * @param array $data Array with entities data
     * @param string $entityName Entity name
     */
    public static function make(array $data, string $entityName)
    {
        $entityDefinitionClassname = __NAMESPACE__ . '\\' . $entityName . 'Definition';
        $entityList = [];

        foreach ($data as $entity) {
            $entityList[] = $entityDefinitionClassname::make($entity);
        }

        return $entityList;
    }
}
