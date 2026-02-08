<?php

namespace App\Exceptions;

use Exception;

class NotFoundClaseException extends Exception
{
    public function __construct(String $menssage = "", int $code = 0) {
       return parent::__construct($menssage, $code);
    }
}
