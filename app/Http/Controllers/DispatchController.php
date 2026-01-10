<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Dispatch;
use App\Models\Driver; // Siguraduhin na imported ito
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DispatchController extends Controller
{
public function index()
{
    $reservations = Reservation::with('vehicle')
        ->where('status', 'Reserved')
        ->whereDoesntHave('dispatch') // 👈 IMPORTANT
        ->get();

    $drivers = Driver::where('status', 'Available')->get(); 

    $activeDispatches = Dispatch::with(['vehicle', 'driver', 'reservation'])
        ->latest()
        ->take(10)
        ->get();

    return view('dispatch.index', compact('reservations', 'drivers', 'activeDispatches'));
}



   public function dispatchFromReservation(Request $request)
{
    $request->validate([
        'reservation_id'    => 'required|exists:reservations,id',
        'driver_id'         => 'required|exists:drivers,id',
        'start_location'    => 'required|string',
        'end_location'      => 'required|string',
        'dispatch_date'     => 'required|date',
        'dispatch_time'     => 'required',
        'estimated_arrival' => 'required',
    ]);

    try {
        $result = DB::transaction(function () use ($request) {
            $reservation = Reservation::with('vehicle')->findOrFail($request->reservation_id);
            
            // Hanapin ang vehicle record
            $vehicle = $reservation->vehicle;

            if ($reservation->status === 'Dispatched') {
                return ['type' => 'error', 'text' => 'Already dispatched.'];
            }

            // 1. Create Dispatch Record
            Dispatch::create([
                'reservation_id'    => $reservation->id,
                'vehicle_id'        => $vehicle->id,
                'driver_id'         => $request->driver_id,
                'start_location'    => $request->start_location,
                'end_location'      => $request->end_location,
                'dispatch_date'     => $request->dispatch_date,
                'dispatch_time'     => $request->dispatch_time,
                'estimated_arrival' => $request->estimated_arrival,
                'dispatched_at'     => now(),
            ]);

            // 2. Update Reservation
            $reservation->update(['status' => 'Dispatched']);

            // 3. Update Vehicle Status (DITO YUNG IMPORTANTE)
            // Siguraduhin na ang string na 'In-Use' ay tugma sa filter ng Monitoring page
            if ($vehicle) {
                $vehicle->status = 'In-Use';
                $vehicle->save();
            }

            // 4. Update Driver
            $driver = Driver::find($request->driver_id);
            if ($driver) {
                $driver->update(['status' => 'On-Trip']);
            }

            return ['type' => 'success', 'text' => 'Vehicle successfully dispatched and status updated to In-Use!'];
        });

        return redirect()->route('dispatch.index')->with($result['type'], $result['text']);

    } catch (\Exception $e) {
        \Log::error("Dispatch Error: " . $e->getMessage());
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}
}