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
     * Select of all data from the table
     *
     * @param array $param
     * @return array
     */
    public function findAll($param=[])
    {
        $stmt = $this->query("SELECT * FROM $this->table", $param);

        $res = $stmt->fetchAll();

        return $res;
    }

    /**
     * Check for the presence of email in the table
     *
     * @param $data
     * @return mixed
     */
    public function uniqueEmail($data)
    {
        $stmt = $this->query("SELECT COUNT(email) as `count` FROM $this->table WHERE email=?", $data);

        $res = $stmt->fetch();

        return $res;
    }

}