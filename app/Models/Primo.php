<?php

namespace App\Models;

use App\Http\UseCases\Primo as PrimoUseCase;

class PrimoItem
{
    private int $number;
    private bool $isPrime;

    /**
     * @param int $number
     * @param bool $isPrime
     */
    public function __construct(int $number, bool $isPrime)
    {
        $this->number = $number;
        $this->isPrime = $isPrime;
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}

class Primo
{

    public function isPrime(int|array $number)
    {
        $response = array();
        if (is_array($number)) {
            foreach ($number as $value) {
                $response[] = $this->buildResponse($value)->expose();
            }
        } else {
            $response[] = $this->buildResponse($number)->expose();
        }

        return $response;
    }

    protected function buildResponse($number)
    {
        return new PrimoItem($number, PrimoUseCase::isValid($number));
    }

}
