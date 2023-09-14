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

        self::addStatusColumn($query, $hr);

        if (self::isNotFilter($lat, $lng, $mts)) {
            return self::doQuery($query, $hr, $lat, $lng, $mts);
        }

        self::buildDistance($query, $lng, $lat, $mts);

        return self::doQuery($query, $hr, $lat, $lng, $mts);
    }

    private static function addStatusColumn($query, $hr)
    {
        if (!is_null($hr)) {
            $filterHr = "IF((opened<=? and closed>=?) or fullTime, 'aberto', 'fechado') as status";
            $query->selectRaw($filterHr, [$hr, $hr]);
        }
    }

    private static function isNotFilter($lat, $lng, $mts)
    {
        return (is_null($lat) && is_null($lng) && is_null($mts));
    }

    private static function doQuery($query, $hr, $lat, $lng, $mts)
    {
        if (!is_null($hr)) {
            $query->orderBy('status', 'asc');
        }
        return $query->get();
    }

    private static function buildDistance($query, $lng, $lat, $mts)
    {
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
    }
}
