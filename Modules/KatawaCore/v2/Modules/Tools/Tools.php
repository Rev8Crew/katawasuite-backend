<?php

namespace Modules\KatawaCore\v2\Modules\Tools;

use Illuminate\Support\Collection;

class Tools
{
    public static ?Collection $debugCollection = null;

    public static function addDebugInfo($info, $params = [])
    {
        if (! self::$debugCollection) {
            self::$debugCollection = collect();
        }

        $push = $info;
        if ($params) {
            $push = [
                'message' => $info,
                'params' => $params,
            ];
        }

        self::$debugCollection->push($push);
    }

    /**
     * @return Collection
     */
    public static function getDebugCollection(): ?Collection
    {
        return self::$debugCollection;
    }

    public static function quoted(string $str): string
    {
        return $str ? "\"$str\"" : $str;
    }

    public static function endWithS($value): string
    {
        if ((float) $value) {
            $value = number_format($value, 1);
        }

        return $value ? $value.'s' : $value;
    }

    public static function takeParamsFromFunction(string $function)
    {
        $re = '/.*\((.*)\)/m';
        preg_match_all($re, $function, $matches, PREG_SET_ORDER, 0);

        if (! $matches) {
            $re = '/.*\((.*),(.*)\)/m';
            preg_match_all($re, $function, $matches, PREG_SET_ORDER, 0);
        }

        if (! $matches) {
            return '1.0';
        }

        return $matches[0][1];
    }

    public static function explode(string $search_expression)
    {
        return preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|"."[\s,]*\\\"([^']+)\\\"[\s,]*|"."[\s,]+/", $search_expression, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }

    /**
     * @param  int|string  $position
     * @param  mixed  $insert
     */
    public static function insertIntoArrayByPosition(array &$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }

    public static function isColor(string $str): bool
    {
        $re = '/#([[:xdigit:]]{3}){1,2}\b/m';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        return count($matches) > 0;
    }

    public static function exitWithError(...$args)
    {
        \rr\dd($args, (new \Exception)->getTraceAsString());
    }
}
