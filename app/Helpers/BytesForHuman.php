<?php

declare(strict_types=1);

namespace App\Helpers;

class BytesForHuman
{
    public const BYTE_UNITS = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    public const BYTE_PRECISION = [0, 0, 1, 2, 2, 3, 3, 4, 4];

    public const BYTE_NEXT = 1024;

    public static function format($bytes, $precision = null)
    {
        $bytes = (int) $bytes; //typecast to int to suppress PHP NOTICE
        for ($i = 0; ($bytes / self::BYTE_NEXT) >= 0.9 && $i < count(self::BYTE_UNITS); $i++) {
            $bytes /= self::BYTE_NEXT;
        }

        return round($bytes, is_null($precision) ? self::BYTE_PRECISION[$i] : (int) $precision).self::BYTE_UNITS[$i];
    }
}
