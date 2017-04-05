<?php

namespace bwttest\app\models;

use bwttest\app\core\Model;

/**
 * Class User
 * @package bwttest\app\models
 */
class User extends Model
{
    /**
     * The name of the table with which the model is associated
     *
     * @var string
     */
    public $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add user data into table users
     *
     * @param array $params
     * @return \PDOStatement
     */
    public function insertUser($params = [])
    {
        $stmt = $this->query("INSERT INTO $this->table (first_name, last_name, email, password, male, birthday) 
                                  VALUES (:first_name, :last_name, :email, :password, :male, :birthday)",
            $params);

        return $stmt;
    }

    /**
     * Select user data from the table users when authorizing
     *
     * @param $data
     * @return mixed
     */
    public function login($data)
    {
        $res = $this->get("SELECT * FROM $this->table WHERE email=:email", $data);

        return $res;
    }
}