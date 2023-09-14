<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Sort;

class SortController extends Controller
{
    private Sort $model;

    public function __construct()
    {
        $this->model = new Sort();
    }

    public function store(SortRequest $request)
    {
        return json_encode($this->model->execute($request->input('list')));
    }
}
