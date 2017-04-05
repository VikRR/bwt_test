<?php

namespace bwttest\app\models;

use bwttest\app\core\Model;

/**
 * Class Guest
 * @package bwttest\app\models
 */
class Guest extends Model
{
    /**
     * The name of the table with which the model is associated
     *
     * @var string
     */
    public $table = 'guests';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert guest data into table guests
     *
     * @param $data
     * @return \PDOStatement
     */
    public function insertGuest($data)
    {
        $stmt = $this->query("INSERT INTO $this->table (guest, email) VALUES(:guest, :email)", $data);

        return $stmt;
    }

    /**
     * Select id from table guests
     *
     * @param $data
     * @return mixed
     */
    public function find($data)
    {
        $res = $this->get("SELECT id FROM $this->table WHERE email = ?", $data);

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

        //print '<pre>'; print_r($data);exit;

        $res = $this->get("SELECT COUNT(email) as `count` FROM $this->table WHERE email=?", $data);

        return $res;
    }
}