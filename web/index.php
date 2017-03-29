<?php

/**
 *  'Единая точка входа';
 */

use bwttest\app\core\Model;
use bwttest\app\core\Router;
//use bwttest\app\core\DB;

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT',__DIR__);
//define('ROOT',dirname(__DIR__));

require_once ROOT . '/app/core/function.php';//TODO: delete on production
require_once ROOT . '/vendor/autoload.php';

$router = new Router();

$router->run();


//debug(Router::getRoute());


//print_r($conf_db);


//$db = DB::connect('mysql:host='.$conf_db['host'].'; dbname='.$conf_db['dbname'].'; charset=utf8;', $conf_db['username'], $conf_db['password'], $conf_db['pdo_attr']);

//$query = new DBQuery($db);
//$query->query('select * from users');
//$model = new Model();
//debug($model);
//print_r(get_class_methods($model));

//debug($model->query('select * from users'));


