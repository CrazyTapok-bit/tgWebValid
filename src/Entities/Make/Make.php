<?php

namespace TgWebValid\Entities\Make;

class Make
{
    public function __construct(array $props)
    {
        $getClass = get_class($this);

        foreach ($props as $prop => $value) {
            $prop = camelize($prop);
            if (!property_exists($getClass, $prop)) {
                continue;
            }
            $this->$prop = $value;
        }
    }
}
