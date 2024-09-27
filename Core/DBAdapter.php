<?php

namespace Core;

use PDO;

interface DBAdapter
{
    /**
     * @return PDO
     */
    public function connect();
}