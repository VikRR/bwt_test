<?php

namespace bwttest\app\core;


class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

}