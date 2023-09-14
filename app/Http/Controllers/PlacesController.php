<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesGetRequest;
use App\Http\Requests\PlacesPostRequest;
use App\Models\Place;
use Symfony\Component\HttpFoundation\Response;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
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
                $baseRow['distance'] = number_format($value->distance, 2, ',', '') . 'm';
            }
            if (!is_null($value->opened) && !is_null($value->closed)) {
                $baseRow['opened'] = $value->opened;
                $baseRow['closed'] = $value->closed;
            }
            $response[] = $baseRow;
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlacesPostRequest $request)
    {
        $place = new Place();
        $place->setAttribute('name', $request->input('name'));
        $place->setAttribute('lat', $request->input('x'));
        $place->setAttribute('lng', $request->input('y'));
        $opened = $request->input('opened');
        $closed = $request->input('closed');
        if (!is_null($opened) && !is_null($closed)) {
            $place->setAttribute('opened', $opened);
            $place->setAttribute('closed', $closed);
        } else {
            $place->setAttribute('fullTime', true);
        }
        $place->save();
        return response()->noContent(Response::HTTP_CREATED);
    }
}
