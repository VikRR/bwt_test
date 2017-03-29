<?php

namespace bwttest\app\core;

class DB
{
    private $pdo;
    private static $_instance;

    private function __construct()
    {
        $conf_db = require_once ROOT.'/app/config/database.php';
        $this->pdo = new \PDO($conf_db['dsn'], $conf_db['username'], $conf_db['password'], $conf_db['pdo_attr']);
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function connect()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function execute($query, $param = [])
    {
        $stmt = $this->pdo->prepare($query);

        $stmt->execute($param);

        return $stmt;
    }
}