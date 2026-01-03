<?php



namespace App\Http\Controllers;
use App\Models\Vehicle;
use App\Models\VehicleRequest;

class VehicleManagementController extends Controller
{
    public function index()
    {
        $requests = VehicleRequest::latest()->get();
        $vehicles = Vehicle::latest()->get();

        return view('vehicleslist.index', compact('requests', 'vehicles'));
    }
}