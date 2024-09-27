<?php

namespace Core;

/**
 * Simple classes autoloader
 */
class Autoloader
{
    public static function load()
    {
        spl_autoload_register(function ($class) {
            $file = realpath(__DIR__ . '/../' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}