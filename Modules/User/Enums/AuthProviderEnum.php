<?php

declare(strict_types=1);

namespace Modules\User\Enums;

enum AuthProviderEnum: string
{
    case Google = 'google';
    case Vk = 'vkontakte';
    case Telegram = 'telegram';

    /**
     * @return AuthProviderEnum[]
     */
    public static function withNameAttribute(): array
    {
        return [
            self::Vk,
        ];
    }

    public static function labels(): array
    {
        return [
            [
                'id' => self::Google,
                'label' => trans('authorization::authorization.provider_google'),
                'url' => route('auth.providers.redirect', ['provider' => 'google']),
                'icon' => 'google',
            ],
            [
                'id' => self::Vk,
                'label' => trans('authorization::authorization.provider_vk'),
                'url' => route('auth.providers.redirect', ['provider' => 'vkontakte']),
                'icon' => 'vk',
            ],
            /*            [
                            'id' => self::TELEGRAM,
                            'label' => trans('auth.provider_telegram'),
                            'url' => route('auth.providers.redirect', ['provider' => 'telegram']),
                            'icon' => 'telegram'
                        ]*/
        ];
    }
}
