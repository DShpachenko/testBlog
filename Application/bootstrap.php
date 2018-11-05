<?php

require_once 'Core/helpers.php';
require_once 'Core/Autoloader.php';

use Core\Autoloader;
use Core\Router;

$route = new Router();
$route->start();