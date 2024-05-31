<?php

namespace App\Exceptions;

use Exception;

class ValidasiException extends Exception
{
    public function render($request){
        $pesan = $request->error;
        return $pesan;
    }
}
