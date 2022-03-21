<?php

namespace Fozzy\WinVPS\Api\V2\Schemas;

class EntityList
{
    /**
     * Make an array with {Entity}Definition class objects
     *
     * @param array $data Array with entities data
     * @param string $entityName Entity name
     * @return Definition[]
     */
    public static function make(array $data, string $entityName): array
    {
        $entityDefinitionClassname = __NAMESPACE__ . '\\' . $entityName . 'Definition';
        $entityList = [];

        foreach ($data as $entity) {
            $entityList[] = $entityDefinitionClassname::make($entity);
        }

        return $entityList;
    }
}
