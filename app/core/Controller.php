<?php

namespace bwttest\app\core;

/**
 * Class Controller
 * @package bwttest\app\core
 */
class Controller
{
    /**
     * @var Model
     */
    public $model;
    /**
     * @var View
     */
    public $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

}