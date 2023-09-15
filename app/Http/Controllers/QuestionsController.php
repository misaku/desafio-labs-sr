<?php

namespace App\Http\Controllers;

use App\Models\Question;
use OpenApi\Annotations as OA;

class QuestionsController extends Controller
{
    protected Question $model;

    public function __construct()
    {
        $this->model = new Question();
    }

    /**
     * @OA\Get(
     *     path="/api/question",
     *     summary="show questions and responses",
     *
     *     tags={"Questions"},
     *
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index()
    {
        $response = $this->model->index();

        return json_encode($response);
    }
}
