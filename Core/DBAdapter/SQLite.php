<?php

namespace Core\DBAdapter;

use Core\Config;
use Core\DBAdapter;
use PDO;

class SQLite implements DBAdapter
{
    /**
     * @return PDO
     */
    public function connect()
    {
        return new PDO('sqlite:' . __DIR__ . '/../../Storage/' . Config::get('DBName'));
    }
}