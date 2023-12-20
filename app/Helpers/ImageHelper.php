<?php

namespace App\Helpers;

/**
 * Class ImageHelper
 */
class ImageHelper
{
    public static function getAvatarImage($name): string
    {
        $replaceable = $name; //preg_replace('/[^a-z0-9 _.-]+/i', '', $name);

        $query = http_build_query([
            'seed' => $replaceable,
            'radius' => 50,
            'backgroundType' => 'gradientLinear',
        ]);

        return 'https://api.dicebear.com/7.x/initials/svg?'.$query;
    }
}
