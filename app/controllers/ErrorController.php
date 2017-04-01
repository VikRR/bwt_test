<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

class ErrorController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function error404()
    {
        $this->view->load('errors/error404');
    }

}