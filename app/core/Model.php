<?php

namespace bwttest\app\core;

class Model
{
    private $pdo;
    public $table;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function load($name)
    {
        $model = 'bwttest\app\models\\' . ucfirst($name);

        //$model .= ucfirst($name);

        return new $model();
    }

    public function query($sql, $param = [])
    {
        $stmt = $this->pdo->execute($sql, $param);

        return $stmt;
    }

    public function findAll($param=[])
    {
        $stmt = $this->query("SELECT * FROM {$this->table}", $param);

        $res = $stmt->fetchAll();

        return $res;
    }

    public function getTable()
    {
        return $this->table;
    }

}