<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Sort;
use OpenApi\Annotations as OA;

class SortController extends Controller
{
    private Sort $model;

    public function __construct()
    {
        $this->model = new Sort();
    }

    /**
     * @OA\Post(
     *     path="/api/sort",
     *     summary="sort lists",
     *          security={{"bearerAuth":{}}},
     *
     *          @OA\RequestBody(
     *
     *            @OA\JsonContent(
     *               required={"list"},
     *
     *               @OA\Property(
     *                   property="list",
     *                   type="array",
     *
     *                  @OA\Items(type="integer"),
     *                  example={30, 1, 50, 2, 22, 3}
     *                  )
     *           ),
     *       ),
     *
     *      @OA\Response(response="200", description="successful"),
     *      @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store(SortRequest $request)
    {
        return json_encode($this->model->execute($request->input('list')));
    }
}
