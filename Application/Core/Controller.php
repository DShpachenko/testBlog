<?php

namespace Core;

use Core\View;

class Controller
{

    protected $model;
    protected $view;
    protected $data;

    function __construct()
    {
        global $config;

        $this->view = new View();
    }

    function action_index()
    {

    }	
}