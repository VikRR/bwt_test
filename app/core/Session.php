<?php

namespace bwttest\app\core;

/**
 * Class Session
 * @package bwttest\app\core
 */
class Session
{
    /**
     * Add a user entry in the session
     *
     * @param $username
     * @param $userid
     */
    public static function add($username, $userid)
    {
        if(self::checkSession()){
            session_destroy();
        }
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid;
    }

    /**
     * Session destroy
     */
    public static function stop()
    {
        if (self::checkSession()) {
            session_destroy();
        }
    }

    /**
     * Check if there is a record in the session about the user
     *
     * @return bool
     */
    public static function checkSession()
    {
        if (!empty($_SESSION['username'])) {

            return true;
        } else {

            return false;
        }
    }
}