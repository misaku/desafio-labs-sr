<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesGetRequest;
use App\Http\Requests\PlacesPostRequest;
use App\Models\Place;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class PlacesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/places",
     *     summary="list places",
     *
     *          @OA\Parameter(
     *          name="x",
     *          in="query",
     *          required=false,
     *          description="Valor de X",
     *
     *          @OA\Schema(type="integer")
     *      ),
     *
     *      @OA\Parameter(
     *          name="y",
     *          in="query",
     *          required=false,
     *          description="Valor de Y",
     *
     *          @OA\Schema(type="integer")
     *      ),
     *
     *      @OA\Parameter(
     *          name="mts",
     *          in="query",
     *          required=false,
     *          description="Valor de MTS",
     *
     *          @OA\Schema(type="integer")
     *      ),
     *
     *      @OA\Parameter(
     *          name="hr",
     *          in="query",
     *          required=false,
     *          description="Valor de HR",
     *
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(PlacesGetRequest $request)
    {

        $lat = $request->get('x');
        $lng = $request->get('y');
        $mts = $request->get('mts');
        $hr = $request->get('hr');

        $result = Place::findAll($hr, $lat, $lng, $mts);

        return $this->transformerPlace($result);
    }

    private function transformerPlace($list)
    {
        $response = [];
        foreach ($list as $value) {
            $baseRow = [];
            $baseRow['id'] = $value->id;
            $baseRow['name'] = $value->name;
            if (isset($value->status)) {
                $baseRow['status'] = $value->status;
            }
            if (isset($value->distance)) {
                $baseRow['distance'] = number_format($value->distance, 2, ',', '').'m';
            }
            if (! is_null($value->opened) && ! is_null($value->closed)) {
                $baseRow['opened'] = $value->opened;
                $baseRow['closed'] = $value->closed;
            }
            $response[] = $baseRow;
        }

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/places",
     *     summary="create places",
     *          security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *
     *           @OA\JsonContent(
     *              required={"name", "x", "y"},
     *
     *              @OA\Property(property="name", type="string", example="usuario"),
     *              @OA\Property(property="x", type="integer", example="1"),
     *              @OA\Property(property="y", type="integer", example="1"),
     *              @OA\Property(property="opened", type="string", format="hours", example="01:00"),
     *              @OA\Property(property="closed", type="string", format="hours", example="18:00")
     *          ),
     *      ),
     *
     *     @OA\Response(response="201", description="successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function store(PlacesPostRequest $request)
    {
        $place = new Place();
        $place->setAttribute('name', $request->input('name'));
        $place->setAttribute('lat', $request->input('x'));
        $place->setAttribute('lng', $request->input('y'));
        $opened = $request->input('opened');
        $closed = $request->input('closed');
        if (! is_null($opened) && ! is_null($closed)) {
            $place->setAttribute('opened', $opened);
            $place->setAttribute('closed', $closed);
        } else {
            $place->setAttribute('fullTime', true);
        }
        $place->save();

        return response()->noContent(Response::HTTP_CREATED);
    }
}
