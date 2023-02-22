<?php

namespace App\Helpers;

class LaravelHelper
{
    public static function getEloquentSqlWithBindings($query): string
    {
        return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
            return is_numeric($binding) ? $binding : "'{$binding}'";
        })->toArray());
    }
}
