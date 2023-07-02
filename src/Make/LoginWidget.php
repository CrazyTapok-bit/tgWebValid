<?php

namespace TgWebValid\Make;

use Carbon\Carbon;

abstract class LoginWidget extends Make
{
    /**
     * @param array<string, int|string|bool> $props
     */
    public function __construct(array $props = [])
    {
        foreach ($props as $prop => $value) {
            $value = match ($prop) {
                'auth_date' => Carbon::createFromTimestamp((int) $value),
                default     => $value
            };
            $this->setProperty(camelize($prop), $value);
        }
    }
}
