<?php

namespace App\Modules\KatawaParser\v2\Modules\Helpers;

use App\Modules\KatawaParser\v2\Modules\Configs\Config;

class KatawaHelper
{
    public static function isCharacter(string $character): bool
    {
        return array_key_exists($character, Config::getInstance()->getConfigValue('characters'));
    }

    public static function isContainCharacter(string $character): bool
    {
        foreach (Config::getInstance()->getConfigValue('characters') as $key => $name) {
            if ( strpos($character, $key) !== false) {
                return true;
            }
        }

        return false;
    }

    public static function replaceCharactersFromMessage(string $message): string
    {
        $text =  $message;

        foreach (Config::getInstance()->getConfigValue('replace_characters_from_message') as $search => $replace) {
            if (strpos($text, $search) !== false) {
                $text = str_replace($search, $replace, $text);
            }
        }

        return $text;
    }
}
