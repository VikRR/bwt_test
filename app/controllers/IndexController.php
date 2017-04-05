<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

/**
 * Class IndexController
 * @package bwttest\app\controllers
 */
class IndexController extends Controller
{

    /**
     * Main page
     */
    public function index()
    {
        if (!empty($_SESSION['username'])) {
            header('Location: weather');
        } else {
            $this->view->load('form/registration');
        }
    }
}