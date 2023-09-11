<?php

namespace App\Models;

use App\Http\UseCases\Primo as PrimoUseCase;

class Primo
{

    public function isPrime(int $number)
    {
        $isValid =PrimoUseCase::isValid($number);
        return $isValid;
    }

}
