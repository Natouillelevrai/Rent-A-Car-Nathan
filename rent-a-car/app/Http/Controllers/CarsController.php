<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class carsController extends Controller
{
    function getAll() {
        $cars = DB::table('vehicule as v')
            ->select(
                'v.id',
                'v.brand',
                'v.model',
                DB::raw('MAX(vp.image_url) as img'),
                'v.year',
                'v.price_per_day',
                'v.doors',
                'v.fuel_type',
                'v.air_conditioning',
                'v.seats',
                'v.transmission',
                'vt.name as type',
                DB::raw("GROUP_CONCAT(e.name SEPARATOR ', ') as equipements")
            )

            ->join('vehicule_equipment as ve', 've.vehicule_id', '=', 'v.id')
            ->join('equipment as e', 've.equipment_id', '=', 'e.id')
            ->join('vehicule_type as vt', 'vt.id', '=', 'v.vehicule_type_id')
            ->join('vehicule_photo as vp', 'vp.vehicule_id', '=', 'v.id')
            ->groupBy('v.id');

        if (isset($_GET['type']) && $_GET['type'] != '') {
            $cars->where('vt.name', $_GET['type']);
        }

        if (isset($_GET['fuel_type']) && $_GET['fuel_type'] != '') {
            $cars->where('v.fuel_type', $_GET['fuel_type']);
        }

        if (isset($_GET['transmission']) && $_GET['transmission'] != '') {
            $cars->where('v.transmission', $_GET['transmission']);
        }

        if (isset($_GET['limit']) && $_GET['limit'] != '') {
            $cars->limit($_GET['limit']);
        }

        $cars = $cars->get();

        return response()->json($cars);
    }

    function getById($id) {
        $car = DB::table('vehicule as v')
        ->select(
            'v.id',
            'v.brand',
            'v.model',
            DB::raw('MAX(vp.image_url) as img'),
            'v.year',
            'v.price_per_day',
            'v.doors',
            'v.fuel_type',
            'v.air_conditioning',
            'v.seats',
            'v.transmission',
            'vt.name as type',
            DB::raw("GROUP_CONCAT(e.name SEPARATOR ', ') as equipements")
        )
        ->join('vehicule_equipment as ve', 've.vehicule_id', '=', 'v.id')
        ->join('equipment as e', 've.equipment_id', '=', 'e.id')
        ->join('vehicule_type as vt', 'vt.id', '=', 'v.vehicule_type_id')
        ->join('vehicule_photo as vp', 'vp.vehicule_id', '=', 'v.id')
        ->groupBy('v.id')
        ->where('v.id', $id)
        ->get();

        return response()->json($cars);
    }
}
