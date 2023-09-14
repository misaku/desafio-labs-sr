<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrimoRequest;
use Illuminate\Http\Request;
use App\Models\Primo;

class PrimoController extends Controller
{
    private Primo $model;

    public function __construct()
    {
        $this->model = new Primo();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PrimoRequest $request)
    {
        $number = $request->input('number');
        $response = $this->model->isPrime($number);
        return json_encode($response);
    }
}
