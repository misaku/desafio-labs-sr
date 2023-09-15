<?php

namespace Tests\Unit\Primo;

use App\Models\Primo as PrimoModel;
use PHPUnit\Framework\TestCase;

class PrimoModelTest extends TestCase
{
    public function test_that_primo_model_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number) {
            $model = new PrimoModel();

            return $model->isPrime($number)[0]['isPrime'];
        }));
    }

    public function test_that_primo_model_is_valid_array(): void
    {
        $model = new PrimoModel();
        $this->assertTrue(every($model->isPrime(VALID_NUMBERS), function ($reponse) {
            return $reponse['isPrime'];
        }));
    }

    public function test_that_primo_model_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number) {
            $model = new PrimoModel();

            return ! $model->isPrime($number)[0]['isPrime'];
        }));
    }

    public function test_that_primo_model_is_invalid_array(): void
    {
        $model = new PrimoModel();
        $this->assertTrue(every($model->isPrime(INVALID_NUMBERS), function ($reponse) {
            return ! $reponse['isPrime'];
        }));
    }
}
