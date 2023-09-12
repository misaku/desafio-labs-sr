<?php

namespace Tests\Unit;

use App\Http\UseCases\Primo;
use App\Models\Primo as PrimoModel;
use App\Http\Controllers\PrimoController;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

define('VALID_NUMBERS',[2,3,5,7,11,13]);
define('INVALID_NUMBERS',[-3,-1,0,1,4,6,8,9,10,12]);
function every(array $array, callable $callback) {
    foreach ($array as $item) {
        if (!$callback($item)) {
            return false;
        }
    }
    return true;
}

class PrimoTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_primo_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number){
            return Primo::isValid($number);
        } ));
    }
    public function test_that_primo_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number){
            return !Primo::isValid($number);
        } ));
    }
    public function test_that_primo_model_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number){
            $model = new PrimoModel();
            return $model->isPrime($number)[0]['isPrime'];
        } ));
    }

    public function test_that_primo_model_is_valid_array(): void
    {
        $model = new PrimoModel();
        $this->assertTrue(every($model->isPrime(VALID_NUMBERS), function ($reponse){
            return $reponse['isPrime'];
        } ));
    }


    public function test_that_primo_model_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number){
            $model = new PrimoModel();
            return !$model->isPrime($number)[0]['isPrime'];
        } ));
    }

    public function test_that_primo_model_is_invalid_array(): void
    {
        $model = new PrimoModel();
        $this->assertTrue(every($model->isPrime(INVALID_NUMBERS), function ($reponse){
            return !$reponse['isPrime'];
        } ));
    }
    public function test_that_primo_controller_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number){
            $controller = new PrimoController();
            $request = Request::create('/api/primo', 'POST', ['number' => $number]);
            $response = json_decode($controller->store($request),true);
            return $response[0]['isPrime'];
        } ));
    }

    public function test_that_primo_controller_is_valid_array(): void
    {
        $controller = new PrimoController();
        $request = Request::create('/api/primo', 'POST', ['number' => VALID_NUMBERS]);
        $response = json_decode($controller->store($request),true);
        $this->assertTrue(every($response, function ($reponse){
            return $reponse['isPrime'];
        } ));
    }


    public function test_that_primo_controller_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number){
            $controller = new PrimoController();
            $request = Request::create('/api/primo', 'POST', ['number' => $number]);
            $response = json_decode($controller->store($request),true);
            return !$response[0]['isPrime'];
        } ));
    }

    public function test_that_primo_controller_is_invalid_array(): void
    {
        $controller = new PrimoController();
        $request = Request::create('/api/primo', 'POST', ['number' => INVALID_NUMBERS]);
        $response = json_decode($controller->store($request),true);
        $this->assertTrue(every($response, function ($reponse){
            return !$reponse['isPrime'];
        } ));
    }
}