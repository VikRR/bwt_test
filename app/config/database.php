<?php

return [
    'dsn'      => 'mysql:host=127.0.0.1;dbname=bwt_test;charset=utf8;',
    'username' => 'root',
    'password' => '',
    'pdo_attr' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
    ],
];

