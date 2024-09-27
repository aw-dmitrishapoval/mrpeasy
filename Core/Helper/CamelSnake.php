<?php

namespace Core\Helper;

class CamelSnake
{
    public static function camelToSnake($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    public static function snakeToCamel($input)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    public static function snakeToUpperCamel($input)
    {
        return ucfirst(self::snakeToCamel($input));
    }
}