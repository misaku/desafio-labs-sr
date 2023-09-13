<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionsController extends Controller
{
    protected Question $model;

    public function __construct()
    {
        $this->model = new Question();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->model->index();
        return json_encode($response);
    }
}
