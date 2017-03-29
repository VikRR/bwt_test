<?php

namespace bwttest\app\core;


class View
{
    public function load($view, $data = [])
    {
        include_once ROOT . '/app/views/layouts/header.php';
        if (!empty($_SESSION['username'])) {
            include_once ROOT . '/app/views/layouts/menu.php';
        }
        include_once ROOT . '/app/views/' . $view . '.php';
        include_once ROOT . '/app/views/layouts/footer.php';
    }

    public function input($method)
    {
        $data = [];

        if($method === 'post'){
            if(isset($_POST) && !empty($_POST)){
                foreach ($_POST as $k => $v){
                    $data[$k] = $v;
                }
            }
        }elseif($method === 'get'){
            if(isset($_GET) && !empty($_GET)){
                foreach ($_GET as $k => $v){
                    $data[$k] = $v;
                }
            }
        }

        //$type = '$_' . strtoupper($method).'[]';

        //if (isset($type) && !empty($type)) {
        //    foreach ($type as $k => $v) {
        //        $data[$k] = $v;
        //    }
        //}

        return $data;
    }
}