<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\Models\Vehicle;
class InsurerController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->role == 'client') {
            $vehicles = Vehicle::join('clients', 'client_id', '=', 'clients.id')
                ->select(['vehicles.id', 'brand', 'model', 'license_plate', 'fuel_type'])
                ->where('client_id', auth()->user()->client->id)
                ->orderBy('vehicles.updated_at')
                ->simplePaginate(5);
        } else {
            $vehicles = Vehicle::latest()
                ->select(['id', 'status', 'brand', 'model', 'license_plate', 'fuel_type'])
                ->simplePaginate(5);
        }

        return view('insurer.index', [
            'vehicles' => $vehicles
        ]);
    }
}
