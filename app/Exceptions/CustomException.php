<?php

namespace App\Exceptions;

use Exception;
use App\Helper\ResponseFormatter;

class CustomException extends Exception
{
    public function render($request){
        $pesan = 'Jarak Terlalu Jauh';
        return $pesan;
    }
}
