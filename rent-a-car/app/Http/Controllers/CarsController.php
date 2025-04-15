<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class carsController extends Controller
{
    public function index() {
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
        ->groupBy('v.id')
        ->get();

        return view("home", [
            "cars" => $cars
        ]);
    }
}
