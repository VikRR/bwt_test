<?php

/**
 *  'Единая точка входа';
 */


use bwttest\app\controllers\ErrorController;
use bwttest\app\core\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);


define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

try{
    try {
        session_start();

        $router = new Router();

        if($router->run()){
            $router->run();
        }else{
            $error = new ErrorController();

            $error->error404();
        }


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}catch(Exception $exception){
    echo $exception->getMessage();
}
