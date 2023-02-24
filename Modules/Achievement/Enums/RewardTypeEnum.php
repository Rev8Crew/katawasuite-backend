<?php

declare(strict_types=1);

namespace Modules\Achievement\Enums;

enum RewardTypeEnum: string
{
    case Text = 'text';
    case Image = 'image';
    case Sound = 'sound';
    case Video = 'video';

    public static function labels(): array
    {
        return [
            self::Text->value => 'Текст',
            self::Image->value => 'Ссылка на изображение',
            self::Sound->value => 'Ссылка на звук',
            self::Video->value => 'Ссылка на видео',
        ];
    }
}
