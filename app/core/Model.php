<?php

namespace bwttest\app\core;

/**
 * Class Model
 * @package bwttest\app\core
 */
class Model
{
    /**
     * Object DB
     *
     * @var DB
     */
    protected $pdo;

    /**
     * The name of the table with which the model is associated
     *
     * @var string
     */
    public $table;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    /**
     * Creating a new model object
     *
     * @param $name
     * @return mixed
     */
    public function load($name)
    {
        $model = 'bwttest\app\models\\' . ucfirst($name);

        return new $model();
    }

    /**
     * @param $sql
     * @param array $param
     * @return \PDOStatement
     */
    public function query($sql, $param = [])
    {
        $stmt = $this->pdo->execute($sql, $param);

        return $stmt;
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function getAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);

        $res = $stmt->fetchAll();

        return $res;
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function get($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);

        $res = $stmt->fetch();

        return $res;
    }

}