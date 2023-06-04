<?php

namespace TgWebValid\Support;

use ReflectionClass;
use ReflectionProperty;

abstract class Arrayable
{
    /**
     * Converts the object or its properties to an array recursively.
     *
     * @param ?object $object The object to convert to an array. If null, the current object is used.
     * @return array<string, mixed> The array representation of the object or its properties.
     */
    public function toArray(?object $object = null): array
    {
        $object = $object ?? $this;

        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $result = [];

        foreach ($properties as $property) {
            $name = $property->getName();
            $value = $object->$name ?? null;
            $result[$name] = match(true) {
                is_object($value) => $this->toArray($value),
                is_array($value) => array_map(function($item) {
                    return is_object($item)
                        ? $this->toArray($item)
                        : $item;
                }, $value),
                default => $value
            };
        }

        return $result;
    }
}
