<?php

namespace Core;

class Router
{

    private $controller;
    private $action;
    private $options;
    private $method;
    private $url;

    public function __construct()
    {
        $routs = include('Application\config\routs.php');

        $method = $_SERVER['REQUEST_METHOD'];

        $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $input = json_decode(file_get_contents('php://input'),true);

        $this->url = explode('/', $_SERVER['REQUEST_URI']);

        $alias = $routs[$this->getRouteString($this->url)];

        if(isset($alias)) {
            $this->initVariables($alias);
        } else {
            $this->initVariables($routs['/']);
        }

        if($alias['method'] != $method) {
            Error404(1);
        }

        if($this->options == true) {
            if($method == 'POST') {                
                $this->options = $_POST;
            } else {
                $this->options = $_GET;
            }
        }
    }

    public function start()
    {            
        $controllerName = 'Controllers\\' . $this->controller . 'Controller';
        $action    = $this->action;

        $filepath = $_SERVER['DOCUMENT_ROOT'] . '\\Application\\' . $controllerName . '.php';

        if(file_exists($filepath)) {
            Autoloader::autoload($controllerName, true);
        } else {
            Error404(2);
        }

        $controller = new $controllerName;

        if(method_exists($controller, $action)) {

            // вызываем действие контроллера
            if(!empty($this->options)) {
                $controller->$action($this->options);
            } else {
                $controller->$action();
            }
        } else {
            Error404(3);
        }
    }

    private function initVariables($route)
    {
        $this->controller = $route['controller'];
        $this->action     = $route['action'];
        $this->options    = $route['options'];
        $this->method     = $route['method'];
    }

    private function getRouteString($url)
    {
        for($i = 1; $i <= count($url); $i++) {
            $str .= $url[$i] . '/';
        }

        if(stripos($str, '?')) {            
            $str = stristr($str, '?', true);
        } else {
            $str = substr($str, 0, -2);
        }

        return $str;
    }
}