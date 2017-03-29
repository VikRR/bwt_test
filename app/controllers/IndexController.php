<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$date = '01/01/1979';
        //echo $date.'<br>';
        //print $timestamp = strtotime(str_replace('/','-', $date));
        //echo '<br>';
        //print date('d/m/Y', $timestamp);
        //echo '<br>';
        //echo '<br>';

        //$model = $this->model->load('user');
        //debug($model->findAll());


        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            header('Location: weather');
        } else {
            $this->view->load('index/index');
        }
    }
}