<?php

namespace App\Exceptions;

use Exception;

class NotFoundClaseAlumnoCursoException extends Exception
{
    public function __construct(String $menssage = "", int $code = 0) {
       return parent::__construct($menssage, $code);
    }
}
