<?php

namespace App\Http\Controllers;

use App\Models\Vehiclestatus;
use Illuminate\Http\Request;

class VehicleStatusController extends Controller
{
    public function index()
    {
        $vehicles = Vehiclestatus::all();
        
        // Data para sa mga Card Boxes
        $stats = [
            'total' => $vehicles->count(),
            'active' => $vehicles->where('status', 'Active')->count(),
            'on_trip' => $vehicles->where('status', 'On Trip')->count(),
            'maintenance' => $vehicles->where('status', 'Maintenance')->count(),
        ];

        return view('vehiclestatus.index', compact('vehicles', 'stats'));
    }
}