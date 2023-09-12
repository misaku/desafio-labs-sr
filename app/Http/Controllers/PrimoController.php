<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $number = $request->get('number');
        $response = $this->model->isPrime($number);
        return json_encode($response);
    }
}
