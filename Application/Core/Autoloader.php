<?php

namespace Core;

class Autoloader
{

    public function __construct()
    {

    }

    public static function autoload($file)
    {
        $file = str_replace('\\', '/', $file);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/Application/';
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/Application/' . $file . '.php';
        
        if(file_exists($filePath)) {
            if(config('logging')) {
                logging(('подключили ' . $filePath));
            }

            require_once($filePath);
        } else {
            $flag = true;

            if(config('logging')) {
                logging(('начинаем рекурсивный поиск'));
            }

            Autoloader::recursiveAutoload($file, $path, $flag);
        }
    }

    public static function recursiveAutoload($file, $path, $flag)
    {
        if(FALSE !== ($handle = opendir($path)) && $flag) {
            while(FAlSE !== ($dir = readdir($handle)) && $flag) {
                if(strpos($dir, '.') === FALSE) {
                    $path2 = $path . '/' . $dir;
                    $filePath = $path2 . '/' . $file . '.php';

                    if(config('logging')) {
                        logging(('ищем файл <b>' . $file . '</b> in ' . $filePath));
                    }

                    if(file_exists($filePath)) {
                        if(config('logging')) {
                            logging(('подключили ' . $filePath ));
                        }

                        $flag = FALSE;
                        require_once($filePath);
                        break;
                    }

                    Autoloader::recursiveAutoload($file, $path2, $flag); 
                }
            }

            closedir($handle);
        }
    }
}

\spl_autoload_register('Core\Autoloader::autoload');