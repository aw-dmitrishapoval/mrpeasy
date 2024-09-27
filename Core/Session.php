<?php

namespace Core;

/**
 * Simple session helper
 */
class Session
{
    /**
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return void
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }
}