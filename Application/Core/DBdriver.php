<?php

namespace Core;

class DBdriver
{
    private $connection;
    private $message;

    public function __construct()
    {
        $this->table = 'blogs';
    }

    private function checkInt($value)
    {
        if($value === NULL) {
			return 'NULL';
		}

		if(!is_numeric($value)) {
			$this->message = 'ошибка в методе checkInt, не верный тип данных';

			return FALSE;
		}

		if(is_float($value)) {
			$value = number_format($value, 0, '.', '');
		}

        return $value;
    }

    private function checkString($value)
    {
        if($value === NULL) {
            return 'NULL';
        }

        return	"'" . mysqli_real_escape_string($this->connection, $value) . "'";
    }
    
}