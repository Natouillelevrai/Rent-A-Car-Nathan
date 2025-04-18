<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index() {
        return view("home", []);
    }

    public function allVehicules() {
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

        $vehicules_types = DB::table('vehicule_type')->get();
        $vehicules_fuels = [];

        foreach ($cars as $car) {
            $vehicules_fuels[] = $car->fuel_type;
        }

        $vehicules_fuels = array_unique($vehicules_fuels);

        $vehicules_transmissions = [];

        foreach ($cars as $car) {
            $vehicules_transmissions[] = $car->transmission;
        }

        $vehicules_transmissions = array_unique($vehicules_transmissions);

        return view("vehicules", [
            "cars" => $cars,
            "vehicules_types" => $vehicules_types,
            "vehicules_fuels" => $vehicules_fuels,
            "vehicules_transmissions" => $vehicules_transmissions
        ]);  
    }

    public function vehicule($id) {
        return view("vehicule", [
            'id' => $id
        ]);
    }

    public function reservation($id) {
        return view("reservation", [
            'id' => $id
        ]);
    }
}
