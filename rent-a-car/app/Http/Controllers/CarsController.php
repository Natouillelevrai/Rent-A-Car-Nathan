<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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

        return response()->json($car);
    }

    public function saveInDb(Request $request) {
        try {
            
            $validated = $request->validate([
                'email' => 'required|email',
                'vehicleId' => 'required|integer',
                'startDate' => 'required|date',
                'endDate' => 'required|date|after:startDate',
                'price' => 'required|numeric'
            ]);
    
            $post = DB::insert(
                "INSERT INTO `reservation`(`email`, `vehicule_id`, `start_date`, `end_date`, `created_at`, `status`, `total_price`) VALUES (?, ?, ?, ?, ?, ?, ?)",
                [
                    $validated["email"],
                    $validated["vehicleId"],
                    $validated["startDate"],
                    $validated["endDate"],
                    now(),
                    "Pending",
                    $validated["price"]
                ]
            );
    
            $car = DB::table('vehicule as v')
            ->select(
                'v.id',
                'v.brand',
                'v.model',
                'v.year',
                'v.price_per_day',
                'v.doors',
                'v.fuel_type',
                'v.air_conditioning',
                'v.seats',
                'v.transmission',
                DB::raw('MAX(vp.image_url) as img'),
                'vt.name as type'
            )
            ->join('vehicule_photo as vp', 'vp.vehicule_id', '=', 'v.id')
            ->join('vehicule_type as vt', 'vt.id', '=', 'v.vehicule_type_id')
            ->where('v.id', $validated['vehicleId'])
            ->groupBy('v.id', 'v.brand', 'v.model', 'v.year', 'v.price_per_day', 'v.doors', 'v.fuel_type', 'v.air_conditioning', 'v.seats', 'v.transmission', 'vt.name') // Ajout du GROUP BY
            ->first();

            Mail::raw('Merci pour votre réservation ! Détails : Vehicule louée : ' . $car->brand . ", " . $car->model . ', Du ' . $validated['startDate'] . ' au ' . $validated['endDate'] . ', Prix total: ' . $validated['price'] . '€', function($message) use ($validated) {
                $message->to($validated['email'])
                        ->subject('Confirmation de réservation');
            });
    
            return response()->json([
                'added' => true,
                'message' => 'Booking received successfully, confirmation email sent.',
                'data' => $validated
            ]);
        } 
        
        catch (\Exception $e) {
            return response()->json([
                'added' => false,
                'message' => 'Error processing the booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}