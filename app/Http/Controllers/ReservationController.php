<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;

class ReservationController extends Controller
{
   public function index(Request $request)
{
   $activeVehicles = Vehicle::where('status', 'Active')
    ->whereDoesntHave('reservations', function ($q) {
        $q->whereIn('status', ['Reserved', 'Dispatched']);
    })
    ->get();

    // Reservation query
    $query = Reservation::with('vehicle');

    // 🔍 Search (plate / model)
    if ($request->filled('search')) {
        $query->whereHas('vehicle', function ($q) use ($request) {
            $q->where('plate_no', 'like', '%' . $request->search . '%')
              ->orWhere('model', 'like', '%' . $request->search . '%');
        });
    }

    // 📌 Status filter
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // 📅 Date range
    if ($request->filled('from')) {
        $query->whereDate('start_time', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('end_time', '<=', $request->to);
    }

    $reservations = $query->latest()->get();

    return view('reservations.index', compact('activeVehicles', 'reservations'));
}


    public function reserve(Vehicle $vehicle)
    {
        if ($vehicle->status !== 'Active') {
            return back()->with('error', 'Vehicle is not available');
        }

        Reservation::create([
            'vehicle_id' => $vehicle->id,
            'reserved_by' => auth()->user()->name ?? 'Admin',
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'purpose' => 'Reserved via system',
            'status' => 'Reserved', // 👈 reservation status
        ]);

        // ❌ NO vehicle status update
        return back()->with('success', 'Vehicle reserved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'reserved_by' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Reservation::create([
            ...$request->all(),
            'status' => 'Reserved'
        ]);

        // ❌ NO vehicle status update
        return back()->with('success', 'Vehicle reserved successfully');
    }
}

