<?php

namespace Tests\Unit\Primo;

use App\Http\Controllers\PrimoController;
use App\Http\Requests\PrimoRequest;
use Tests\TestCase;

class PrimoControllerTest extends TestCase
{
    public function test_that_primo_controller_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number) {
            $controller = new PrimoController();
            $request = PrimoRequest::create('/api/primo', 'POST', ['number' => $number]);
            $response = json_decode($controller->store($request), true);

            return $response[0]['isPrime'];
        }));
    }

    public function test_that_primo_controller_is_valid_array(): void
    {
        $controller = new PrimoController();
        $request = PrimoRequest::create('/api/primo', 'POST', ['number' => VALID_NUMBERS]);
        $response = json_decode($controller->store($request), true);
        $this->assertTrue(every($response, function ($reponse) {
            return $reponse['isPrime'];
        }));
    }

    public function test_that_primo_controller_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number) {
            $controller = new PrimoController();
            $request = PrimoRequest::create('/api/primo', 'POST', ['number' => $number]);
            $response = json_decode($controller->store($request), true);

            return ! $response[0]['isPrime'];
        }));
    }

    public function test_that_primo_controller_is_invalid_array(): void
    {
        $controller = new PrimoController();
        $request = PrimoRequest::create('/api/primo', 'POST', ['number' => INVALID_NUMBERS]);
        $response = json_decode($controller->store($request), true);
        $this->assertTrue(every($response, function ($reponse) {
            return ! $reponse['isPrime'];
        }));
    }
}
