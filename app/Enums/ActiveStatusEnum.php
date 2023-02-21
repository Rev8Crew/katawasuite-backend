<?php
declare(strict_types=1);

namespace App\Enums;

enum ActiveStatusEnum: int
{
    case Active = 10;
    case Inactive = 0;

    public static function toLabels(): array
    {
        return [
            self::Active->value => 'success',
            self::Inactive->value => 'danger'
        ];
    }

    public static function toSelect(): array
    {
        return [
            self::Active->value => 'Активно',
            self::Inactive->value => 'Неактивно'
        ];
    }
}
