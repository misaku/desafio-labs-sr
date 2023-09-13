<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
