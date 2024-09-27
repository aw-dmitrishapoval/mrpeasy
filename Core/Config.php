<?php

namespace Core;

class Config
{
    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        $config = include __DIR__ . "/../Config.php";

        return $config[$key] ?? null;
    }
}