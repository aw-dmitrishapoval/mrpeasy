<?php

namespace Core;

/**
 * Simple helper class to work with get & post parameters
 */
class Request
{
    private static $get = [];

    private static $post = [];

    public static function boot()
    {
        self::$get = $_GET;
        self::$post = $_POST;

        $_GET = null;
        $_POST = null;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return self::$get[$key] ?? null;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function post($key)
    {
        return self::$post[$key] ?? null;
    }
}