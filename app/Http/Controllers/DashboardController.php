<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drivertable;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    //
public function index()
    {
        // Kunin lahat ng drivers
        $drivertables = Drivertable::all(); 
        
        // Bilangin lahat ng registered vehicles sa table
        $totalVehicles = Vehicle::count(); 

        // Ipasa ang $totalVehicles sa compact
        return view('dashboard.dashboard', compact('drivertables', 'totalVehicles'));
    }
}
