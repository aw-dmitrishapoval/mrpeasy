<?php

namespace Core;

use Application\Controller\Error;
use Core\Helper\CamelSnake;

/**
 * Run requested controller
 */
class Dispatcher
{
    public static function dispatch()
    {
        //loading request parameters into single storage
        Request::boot();

        if (!$controllerName = Request::get('controller')) {
            $controllerName = 'index';
        }

        if (!$actionName = Request::get('action')) {
            $actionName = 'index';
        }

        $className = 'Application\Controller\\' . CamelSnake::snakeToUpperCamel($controllerName);
        if (class_exists($className)) {
            $controller = new $className();
            $actionName = CamelSnake::snakeToCamel($actionName);
            if (method_exists($controller, $actionName . 'Action')) {
                $controller->{$actionName . 'Action'}();
                return;
            }
        }

        //run error controller
        $controller = new Error();
        $controller->indexAction();
    }
}