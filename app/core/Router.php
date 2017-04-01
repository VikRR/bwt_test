<?php

namespace bwttest\app\core;

use bwttest\app\controllers\ErrorController;

/**
 * Class Router
 * @package bwttest\app\core
 */
class Router
{

    /**
     * Config file with routes
     *
     * @var mixed
     */
    private $routes;

    public function __construct()
    {
        $this->routes = require_once ROOT . '/app/config/routes.php';
    }

    /**
     * Get request string
     *
     * @return string
     */
    public function getUrl()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);
        }
    }

    /**
     * @return bool
     */
    public function run()
    {
        $url = $this->getUrl();

        foreach ($this->routes as $pattern_url => $path) {

            if (preg_match("~^$pattern_url$~", $url)) {
                $route = preg_replace("~^$pattern_url$~", $path, $url);

                $controller_action = explode('/', $route);

                $controller = 'bwttest\app\controllers\\';

                $controller .= ucfirst(array_shift($controller_action)).'Controller';

                $action = array_shift($controller_action);

                $params = $controller_action;

                $controller_obj = new $controller();

                $result = call_user_func_array(array($controller_obj, $action), $params);
                if (!is_null($result)) {
                    break;
                }

                return true;
            }
        }
    }
}