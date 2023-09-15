<?php

namespace Tests\Unit\Sort;

use App\Http\Controllers\SortController;
use App\Http\Requests\SortRequest;
use PHPUnit\Framework\TestCase;

class SortControllerTest extends TestCase
{
    public function test_that_controller_sorted_itens(): void
    {
        $controller = new SortController();
        $request = SortRequest::create('/api/sort', 'POST', ['list' => UNSORTED]);
        $response = json_decode($controller->store($request), true);
        $sorted = $response['sortedList'];
        $stringListOk = implode(',', SORTED);
        $stringList = implode(',', $sorted);
        $this->assertTrue($stringList == $stringListOk);
    }
}
