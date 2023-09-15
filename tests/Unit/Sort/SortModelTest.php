<?php

namespace Tests\Unit\Sort;

use App\Models\Sort;
use PHPUnit\Framework\TestCase;

class SortModelTest extends TestCase
{
    public function test_that_model_sorted_itens(): void
    {
        $model = new Sort();
        $sorted = $model->execute(UNSORTED)['sortedList'];
        $stringListOk = implode(',', SORTED);
        $stringList = implode(',', $sorted);
        $this->assertTrue($stringList == $stringListOk);
    }
}
