<?php

namespace App\Traits;

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * Get value by name.
     */
    public static function value($name): mixed
    {
        return constant("self::{$name}")->value ?? null;
    }

    /**
     * Get name by value.
     */
    public static function name($value): mixed
    {
        return self::array()[$value] ?? null;
    }
}
