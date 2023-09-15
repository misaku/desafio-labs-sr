<?php

namespace Tests\Unit\Primo;

use App\Http\UseCases\Primo;
use PHPUnit\Framework\TestCase;

define('VALID_NUMBERS', [2, 3, 5, 7, 11, 13]);
define('INVALID_NUMBERS', [-3, -1, 0, 1, 4, 6, 8, 9, 10, 12]);
function every(array $array, callable $callback)
{
    foreach ($array as $item) {
        if (! $callback($item)) {
            return false;
        }
    }

    return true;
}

class PrimoUseCaseTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_primo_is_valid(): void
    {
        $this->assertTrue(every(VALID_NUMBERS, function ($number) {
            return Primo::isValid($number);
        }));
    }

    public function test_that_primo_is_invalid(): void
    {
        $this->assertTrue(every(INVALID_NUMBERS, function ($number) {
            return ! Primo::isValid($number);
        }));
    }
}
