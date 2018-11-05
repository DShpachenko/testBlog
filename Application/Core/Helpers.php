<?php

$config = include('Application\config\config.php');

function config($key)
{
    global $config;

    if(isset($config[$key])) {
        return $config[$key];
    } else {
        dd(['error' => 'Object not found!']);
    }
}

function dd($var, $flag = null)
{
    if(config('debug') || $flag ) {
        echo '<pre>';
        print_r($var);
        echo'</pre>';
        exit(0);
    }
}

function Error404($key = null)
{
    $error = 'Не верный запрос';

    if($key) {
        $error .= ' Код ошибки - ' . $key;
    }

    dd($error, true);
}

function logging($data)
{
    $dir = $_SERVER['DOCUMENT_ROOT'] .'/Log/Log.html';
    $file = fopen($dir, 'a');

    flock($file, LOCK_EX);
    fwrite($file, ('║' . $data . '=>' .date('d.m.Y H:i:s') . '<br/>║<br/>' . PHP_EOL));
    flock($file, LOCK_UN);
    fclose ($file);
}