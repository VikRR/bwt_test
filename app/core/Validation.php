<?php

namespace bwttest\app\core;


/**
 * Class Validation
 * @package bwttest\app\core
 */
class Validation
{
    /**
     * Validation of filled form fields
     *
     * @param $data
     * @return array
     * @throws \Exception
     */
    public static function checkEmpty($data)
    {
        $res = [];
        foreach ($data as $k => $v) {
            if (strpos($k, '%') === false && empty($v)) {
                throw new \Exception("The form {$k} field can not be empty.");
            }
            $res [trim($k, '%')] = $v;
        }

        return $res;
    }

    /**
     * Regular expression test
     *
     * @param $pattern
     * @param $subject
     * @param string $message
     * @return mixed
     * @throws \Exception
     */
    public static function matchRegex($pattern, $subject, $message = '')
    {
        if (preg_match($pattern, $subject) === 1) {

            return $subject;
        } else {
            throw new \Exception($message);
        }
    }

    /**
     * Validation name
     *
     * @param array $name
     * @return array|mixed
     */
    public static function name(array $name)
    {
        foreach ($name as $k => $v) {
            $name = self::matchRegex('/^([a-zA-zа-яА-Я]{2,30})$/', $v, "The {$k} must contain only letters.");

            return $name;
        }
    }

    /**
     * Validation email
     *
     * @param $param
     * @return mixed
     */
    public static function email($param)
    {
        self::matchRegex('/(.+)@(\w+).([a-zA-z]{2,4})/', $param,
            'The email field must be filled with a valid email.');

        return $param;
    }

    /**
     * Validating the date format
     *
     * @param $param
     * @return mixed
     */
    public static function date($param)
    {
        if(!empty($param)){
            self::matchRegex('~^([0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]))$~', $param,
                'Date format does not match. Example format date 1900-12-01');
        }

        return $param;
    }

    /**
     * Check for uniqueness
     *
     * @param $param1
     * @param $param2
     * @param $message
     * @return bool
     * @throws \Exception
     */
    public static function unique($param1, $param2, $message)
    {
        if ($param1 === $param2) {

            return true;
        } else {
            throw new \Exception($message);
        }
    }

    /**
     * Validation password
     * Retrieving a hash of the password
     *
     * @param $pass1
     * @param string $pass2
     * @return bool|string
     */
    public static function password($pass1, $pass2 = '')
    {
        $password = self::matchRegex('~^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$~', $pass1,
            'The password must contain at least one lowercase letter, a capital letter and a number.');

        if (self::unique($password, $pass2, 'Password and repeat password not match.')) {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            return $hash_password;
        }
    }

}