<?php

namespace App\Models;

use App\Http\UseCases\QuickSort;

class Sort
{
    public function execute(array $list)
    {
        return (new QuickSort($list))->execute()->expose();
    }
}
