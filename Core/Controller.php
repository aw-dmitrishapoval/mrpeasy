<?php

namespace Core;

abstract class Controller
{
    protected $view;

    /**
     * Render output by default
     */
    public function indexAction()
    {
        $this->output();
    }

    /**
     * Render html or nothing if view is not set
     * @param array $params
     */
    public function output($params = [])
    {
        if ($this->view) {
            $controller = $this;
            extract($params);
            include(__DIR__ . "/../Application/View/" . $this->view . ".phtml");
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}