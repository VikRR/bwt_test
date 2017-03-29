<?php

namespace bwttest\app\core;


class Validation
{
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

    public static function matchRegex($pattern, $subject, $message = '')
    {
        if (preg_match($pattern, $subject) === 1) {

            return $subject;
        } else {
            throw new \Exception($message);
        }
    }

    public static function name($name)
    {
        foreach ($name as $k => $v) {
            $name = self::matchRegex('/^([a-zA-zа-яА-Я]{2,30})$/', $v, "The {$k} must contain only letters.");

            return $name;
        }
    }

    public static function email($param)
    {
        self::matchRegex('/(.+)@(\w+).([a-zA-z]{2,4})/', $param,
            'The email field must be filled with a valid email.');

        return $param;
    }

    public static function date($param)
    {
        self::matchRegex('~^([0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01]))$~', $param,
            'Date format does not match. Example format date 1900-12-01');

        return $param;
    }

    public static function unique($param1, $param2, $message)
    {
        if ($param1 === $param2) {

            return true;
        } else {
            throw new \Exception($message);
        }
    }

    //public static function uniqueEmail($param)
    //{
    //    $email = self::email($param);
    //
    //    if ($param) {
    //
    //
    //        return true;
    //    } else {
    //        throw new \Exception("Email is not unique, please enter another.");
    //        //TODO Add message
    //    }
    //}

    public static function password($pass1, $pass2)
    {
        $password = self::matchRegex('~^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$~', $pass1,
            'The password must contain at least one lowercase letter, a capital letter and a number.');

        if (self::unique($password, $pass2, 'Password and repeat password not match.')) {
            //TODO: дописать
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            return $hash_password;
        }
    }

}