<?php

declare(strict_types=1);

namespace Modules\Feedback\Enums;

enum FeedbackRelationEnum: string
{
    case Site = 'site';
    case Engine = 'engine';

    public static function toLabels(): array
    {
        return [
            self::Site->value => 'info',
            self::Engine->value => 'primary',
        ];
    }

    public static function toSelect(): array
    {
        return [
            self::Site->value => 'Сайт',
            self::Engine->value => 'Движок',
        ];
    }
}
