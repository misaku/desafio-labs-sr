<?php

namespace Tests\Unit;

use App\Http\UseCases\QuickSort;
use App\Models\Primo as PrimoModel;
use App\Models\Sort;
use App\Http\Controllers\SortController;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

define('UNSORTED', [100, 2, 3, 5, 7, 11, 13, -3, -1, 0, 1, 4, 33, 22, 6, 8, 9, 10, 12]);
define('SORTED', [-3, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13,  22, 33, 100]);

class SortTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_case_sorted_itens(): void
    {
        $qSort = new QuickSort(UNSORTED);
        $sorted = $qSort->execute()->expose()['sortedList'];
        $stringList = implode(',', $sorted);
        $stringListOk = implode(',', SORTED);
        $this->assertTrue($stringList==$stringListOk);
    }
    public function test_that_model_sorted_itens(): void
    {
        $model = new Sort();
        $sorted = $model->execute(UNSORTED)['sortedList'];
        $stringListOk = implode(',', SORTED);
        $stringList = implode(',', $sorted);
        $this->assertTrue($stringList==$stringListOk);
    }

}
