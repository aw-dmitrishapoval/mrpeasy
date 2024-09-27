<?php

namespace Core\Helper;

class Url
{
    /**
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return string
     */
    public static function build($controller = null, $action = null, $params = [])
    {
        if ($controller) {
            $params['controller'] = $controller;
        }

        if ($action) {
            $params['action'] = $action;
        }

        return '/' . ($params ? '?' . http_build_query($params) : '');
    }
}