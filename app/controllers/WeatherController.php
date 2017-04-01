<?php

namespace bwttest\app\controllers;


use bwttest\app\core\Controller;

/**
 * Class WeatherController
 * @package bwttest\app\controllers
 */
class WeatherController extends Controller
{

    /**
     * Weather page
     */
    public function index()
    {
        $model = $this->model->load('weather');

        $weather = $model->parse();

        $this->view->load('weather/index', $weather);
    }


}