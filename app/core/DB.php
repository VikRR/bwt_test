<?php

namespace bwttest\app\core;

/**
 * Class DB pattern Singleton
 *
 * @package bwttest\app\core
 */
class DB
{
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var
     */
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

    /**
     *
     * @return DB
     */
    public static function connect()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *
     * @param $query
     * @param array $param
     * @return \PDOStatement
     */
    public function execute($query, $param = [])
    {
        $stmt = $this->pdo->prepare($query);

        $stmt->execute($param);

        return $stmt;
    }
}