<?php

namespace App\Http\Controllers;

use App\Models\Sort;
use Illuminate\Http\Request;

class SortController extends Controller
{
    private Sort $model;

    public function __construct()
    {
        $this->model = new Sort();
    }
    public function store(Request $request)
    {
       return json_encode($this->model->execute($request->get('list')));
    }
}
