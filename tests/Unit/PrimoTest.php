<?php

namespace Tests\Unit;

use App\Http\UseCases\Primo;
use PHPUnit\Framework\TestCase;

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
        $this->assertTrue(every([2,3,5,7,11,13], function ($number){
            return Primo::isValid($number);
        } ));
    }
    public function test_that_primo_is_invalid(): void
    {
        $this->assertTrue(every([-3,-1,0,1,4,6,8,9,10,12], function ($number){
            return !Primo::isValid($number);
        } ));
    }
}
