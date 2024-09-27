<?php

require_once __DIR__ . ('../../Core/Autoloader.php');

Core\Autoloader::load();

session_start();

Core\Dispatcher::dispatch();
