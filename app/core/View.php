<?php

namespace bwttest\app\core;

/**
 * Class View
 * @package bwttest\app\core
 */
class View
{
    /**
     * @param $view
     * @param array $data
     */
    public function load($view, $data = [])
    {
        if($view == 'errors/error404'){
            include_once ROOT . '/app/views/layouts/header.php';
            include_once ROOT . '/app/views/' . $view . '.php';
            include_once ROOT . '/app/views/layouts/footer.php';
        }else{
            include_once ROOT . '/app/views/layouts/header.php';
            include_once ROOT . '/app/views/layouts/menu.php';
            include_once ROOT . '/app/views/' . $view . '.php';
            include_once ROOT . '/app/views/layouts/footer.php';
        }
    }

    /**
     * Obtaining data from forms using POST or GET method
     *
     * @param $method
     * @return array
     */
    public function input($method)
    {
        $data = [];
        if ($method === 'post') {
            if (isset($_POST) && !empty($_POST)) {
                foreach ($_POST as $k => $v) {
                    $data[$k] = $v;
                }
            }
        } elseif ($method === 'get') {
            if (isset($_GET) && !empty($_GET)) {
                foreach ($_GET as $k => $v) {
                    $data[$k] = $v;
                }
            }
        }

        return $data;
    }
}