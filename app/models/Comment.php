<?php

namespace bwttest\app\models;


use bwttest\app\core\Model;

/**
 * Class Comment
 * @package bwttest\app\models
 */
class Comment extends Model
{
    /**
     * The name of the table with which the model is associated
     *
     * @var string
     */
    public $table = 'comments';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert comment into  comments table
     *
     * @param $data
     * @return \PDOStatement
     */
    public function insertComment($data)
    {
        $stmt = $this->query("INSERT INTO $this->table (user_id, guest_id, comment) VALUES(:user_id, :guest_id, :comment)",
            $data);

        return $stmt;
    }

    /**
     * Select all users comments
     *
     * @return array
     */
    public function usersComments()
    {
        $res = $this->getAll('SELECT us.first_name, us.last_name, co.comment, co.date_create 
                                  FROM comments co, users us 
                                  WHERE co.user_id = us.id 
                                  ORDER BY co.date_create');

        return $res;
    }

    /**
     * Select all guests comments
     *
     * @return array
     */
    public function guestsComments()
    {
        $res = $this->getAll('SELECT gu.guest, co.comment, co.date_create 
                                  FROM comments co, guests gu 
                                  WHERE co.guest_id = gu.id 
                                  ORDER BY co.date_create');

        return $res;
    }

}