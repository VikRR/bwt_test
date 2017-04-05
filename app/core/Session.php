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
     * @param array $data
     */
    public static function add($data)
    {
        if (self::checkSession()) {
            session_destroy();
        }
        session_start();
        foreach ($data as $k => $v) {
            $_SESSION[$k] = $v;
        }
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
        if (!empty($_SESSION)) {

            return true;
        } else {

            return false;
        }
    }
}