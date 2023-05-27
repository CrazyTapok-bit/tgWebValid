<?php

namespace TgWebValid\Make;

abstract class Make
{
    /**
     * @param array<string, int|string|bool> $props
     */
    public function __construct(array $props)
    {
        foreach ($props as $prop => $value) {
            $this->setProperty(camelize($prop), $value);
        }
    }

    protected function setProperty(string $property, mixed $value): void
    {
        if (property_exists(get_class($this), $property)) {
            $this->$property = $value;
        }
    }

    /**
     * @return array<string, int|string|bool>
     */
    protected function tryParseJSON(mixed $data): array
    {
        if(is_string($data)) {
            /** @var array<string, int|string|bool> $assoc */
            $assoc = json_decode($data, true);
            return $assoc;
        }
        return [];
    }
}
