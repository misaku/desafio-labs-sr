<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    public static function findAll($hr, $lat, $lng, $mts)
    {
        $query = DB::table('places')->select('*');

        if (!is_null($hr)) {
            $filterHr = "IF((opened<=? and closed>=?) or fullTime, 'aberto', 'fechado') as status";
            $query->selectRaw($filterHr, [$hr, $hr]);
        }

        if (is_null($lat) && is_null($lng) && is_null($mts)) {
            if (!is_null($hr)) {
                return $query->orderBy('status', 'asc')->get();
            }
            return $query->get();
        }

        $distanceSql = 'ST_Distance(point(lng,lat),point(?,?))';
        $distanceValue = [intval($lng), intval($lat)];
        $query->selectRaw($distanceSql . ' as distance', $distanceValue);

        $distanceSql = 'fullTime=true or ' . $distanceSql;
        if (!is_null($mts)) {
            $mts = intval($mts);
            $distanceSql = $distanceSql . ' <= ?';
            $distanceValue = array_merge($distanceValue, [$mts]);
        }

        $query->whereRaw($distanceSql, $distanceValue);
        $query->orderBy('distance', 'asc');

        if (!is_null($hr)) {
            $query->orderBy('status', 'asc');
        }
        return $query->get();
    }
}
