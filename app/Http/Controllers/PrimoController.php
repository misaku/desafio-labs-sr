<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrimoRequest;
use App\Models\Primo;
use OpenApi\Annotations as OA;

class PrimoController extends Controller
{
    private Primo $model;

    public function __construct()
    {
        $this->model = new Primo();
    }

    /**
     * @OA\Post(
     *     path="/api/primo",
     *     summary="Check if is Primo",
     *     security={{"bearerAuth":{}}},
     *
     *     tags={"Primo"},
     *
     *     @OA\RequestBody(
     *
     *           @OA\JsonContent(
     *              required={"number"},
     *
     *              @OA\Property(
     *                  property="number",
     *                  type="integer|array",
     *                  example="1")
     *          ),
     *      ),
     *
     *     @OA\Response(response="200", description="successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store(PrimoRequest $request)
    {
        $number = $request->input('number');
        $response = $this->model->isPrime($number);

        return json_encode($response);
    }
}
