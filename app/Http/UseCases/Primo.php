<?php

namespace App\Http\UseCases;

class Primo
{
    private const basePrime = [2, 3, 5, 7];

    static function isValid(int $number)
    {
        // Definicao de numeros primo sao, aqueles q for inteiro, maior que 1 e que for divisivel somente por 1 e ele mesmo.
        if ($number < 2) {
            return false;
        }

        $isPrime = true;
        if (in_array($number, self::basePrime)) {
            return $isPrime;
        }

        //Escolhi o ceil para pegar o interio arredonando para cima, e o sqrt para fazer raiz quadrada visto que senao ncontrar nenhum divisor abaixo dela, nao vai encontar nenum acima.
        for ($startNumber = ceil(sqrt($number)); $startNumber >= 2; $startNumber--) {
            if ($number % $startNumber == 0) {
                $isPrime = false;
                break;
            }
        }

        return $isPrime;
    }
}
