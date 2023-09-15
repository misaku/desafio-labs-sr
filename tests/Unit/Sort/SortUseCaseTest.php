<?php

namespace Tests\Unit\Sort;

use App\Http\UseCases\QuickSort;
use Tests\TestCase;

define('UNSORTED', [100, 2, 3, 5, 7, 11, 13, -3, -1, 0, 1, 4, 33, 22, 6, 8, 9, 10, 12]);
define('SORTED', [-3, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,  22, 33, 100]);

class SortUseCaseTest extends TestCase
{
    public function test_that_case_sorted_itens(): void
    {
        $qSort = new QuickSort(UNSORTED);
        $sorted = $qSort->execute()->expose()['sortedList'];
        $stringList = implode(',', $sorted);
        $stringListOk = implode(',', SORTED);
        $this->assertTrue($stringList == $stringListOk);
    }
}
