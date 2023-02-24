<?php

namespace App\Traits;

trait Makeable
{
    /**
     * Create a new resource instance.
     *
     * @param  mixed  ...$parameters
     * @return static
     */
    public static function make(...$parameters)
    {
        // @phpstan-ignore-next-line
        return new static(...$parameters);
    }
}
