<?php

namespace App\Traits;

trait BaseEnum
{
    public static function toArray(): array
    {
        $arr = [];
        foreach (static::cases() as $case) {
            $arr[] = $case->value;
        }

        return $arr;
    }

    public static function toString(): string
    {
        return implode(',', self::toArray());
    }

    //keys
    public static function names(): array
    {
        $arr = [];
        foreach (static::cases() as $case) {
            $arr[] = $case->name;
        }

        return $arr;
    }

    public static function keys(): array
    {
        return static::names();
    }
}
