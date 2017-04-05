<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

/**
 * Class ErrorController
 * @package bwttest\app\controllers
 */
class ErrorController extends Controller
{

    public function error404()
    {
        $this->view->load('errors/error404');
    }

}