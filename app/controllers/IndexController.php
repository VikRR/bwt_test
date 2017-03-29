<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            header('Location: weather');
        } else {
            $this->view->load('index/index');
        }
    }
}