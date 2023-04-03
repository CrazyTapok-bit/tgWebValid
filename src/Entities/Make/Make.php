<?php

namespace TgWebValid\Entities\Make;

abstract class Make
{
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
}
