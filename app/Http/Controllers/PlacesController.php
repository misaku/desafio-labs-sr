<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PlacesController extends Controller
{
    private function transformerPlace($list){
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
            if (!is_null($value->opened) && !is_null($value->closed)) {
                $baseRow['opened'] = $value->opened;
                $baseRow['closed'] = $value->closed;
            }
            $response[] = $baseRow;
        }
        return $response;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $lat = request()->get('x');
        $lng = request()->get('y');
        $mts = request()->get('mts');
        $hr = request()->get('hr');


        $result = Place::findAll($hr, $lat, $lng, $mts);
        return $this->transformerPlace($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $place = new Place();
        $place->setAttribute('name',  $request->get('name'));
        $place->setAttribute('lat',  $request->get('x'));
        $place->setAttribute('lng',  $request->get('y'));
        $opened = $request->get('opened');
        $closed = $request->get('closed');
        if(!is_null($opened)&&!is_null($closed)){
            $place->setAttribute('opened',$opened);
            $place->setAttribute('closed',$closed);
        } else {
            $place->setAttribute('fullTime', true);
        }
        $place->save();
        return response()->noContent(Response::HTTP_CREATED);
    }
}
