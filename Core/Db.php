<?php

namespace Core;

use PDO;

class Db
{
    private static $pdo;

    /**
     * Get a connection depending on the selected adapter
     * @return PDO
     */
    private static function getConnection()
    {
        if (self::$pdo == null) {
            $adapterName = '\Core\DBAdapter\\' . Config::get('DBAdapter');
            $adapter = new $adapterName();
            self::$pdo = $adapter->connect();
        }

        return self::$pdo;
    }

    /**
     * @param string $query
     * @param array $params
     * @return void
     */
    public static function query($query, $params = [])
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
    }

    /**
     * @param string $query
     * @param array $params
     * @return mixed
     */
    public static function fetch($query, $params = [])
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}