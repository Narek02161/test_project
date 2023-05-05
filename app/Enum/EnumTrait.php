<?php

namespace App\Enum;

trait EnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function implodeValues(): string
    {
        return implode(',', self::values());
    }
}
