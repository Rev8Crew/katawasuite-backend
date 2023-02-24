<?php

namespace App\Helpers;

/**
 * Class ImageHelper
 */
class ImageHelper
{
    public static function getAvatarImage($name): string
    {
        $replaceable = rawurlencode($name); //preg_replace('/[^a-z0-9 _.-]+/i', '', $name);

        return 'https://avatars.dicebear.com/v2/initials/'.$replaceable.'.svg';
    }
}
