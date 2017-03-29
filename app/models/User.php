<?php

namespace bwttest\app\models;

use bwttest\app\core\Model;

class User extends Model
{
    public $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function uniqueEmail($data)
    {
        $stmt = $this->query("SELECT COUNT(email) as `count` FROM $this->table WHERE email=?", $data);

        $res = $stmt->fetch();

        if($res['count'] == 0){

            return true;
        }else{
            throw new \Exception('Email is not unique, please enter another.');
        }
    }

    public function insert($params = [])
    {
        $stmt = $this->query("INSERT INTO $this->table (first_name, last_name, email, password, male, birthday) VALUES (:first_name, :last_name, :email, :password, :male, :birthday)",
            $params);

        return $stmt;
    }
}