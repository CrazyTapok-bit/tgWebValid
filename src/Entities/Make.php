<?php

namespace TgWebValid\Entities;

class Make
{
    public function __construct(array $props)
    {
        foreach ($props as $prop => $value) {
            $prop = $this->kebabCaseToCamelCase($prop);
            if (!property_exists(get_class($this), $prop)) {
                continue;
            }
            $this->$prop = $value;
        }
    }

    protected function kebabCaseToCamelCase(string $str): string
    {
        return lcfirst(implode('', array_map('ucfirst', explode('_', $str))));
    }
}
