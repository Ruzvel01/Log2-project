<?php

namespace App\Http\Controllers;

use App\Models\VehicleRequest;
use Illuminate\Http\Request;

class VehicleRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = VehicleRequest::query();

        if ($request->vehicle_model) {
            $query->where('vehicle_model', 'like', '%' . $request->vehicle_model . '%');
        }

        if ($request->vehicle_type) {
            $query->where('vehicle_type', $request->vehicle_type);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->get();

        return view('vehicleslist.index', compact('requests'));
    }

    public function create()
    {
        return view('vehicleslist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_model' => 'required',
            'vehicle_type' => 'required',
            'quantity' => 'required|integer|min:1',
            'purpose' => 'required',
        ]);

        VehicleRequest::create($request->all());

        return redirect()->route('vehicleslist.index')
            ->with('success', 'Vehicle request created successfully.');
    }

    public function edit(VehicleRequest $vehicleRequest)
    {
        return view('vehicleslist.edit', compact('vehicleRequest'));
    }

    public function update(Request $request, VehicleRequest $vehicleRequest)
    {
        $request->validate([
            'vehicle_model' => 'required',
            'vehicle_type' => 'required',
            'quantity' => 'required|integer|min:1',
            'purpose' => 'required',
            'status' => 'required',
        ]);

        $vehicleRequest->update($request->all());

        return redirect()->route('vehicleslist.index')
            ->with('success', 'Vehicle request updated successfully.');
    }

    
    public function destroy(VehicleRequest $vehicleRequest)
    {
        $vehicleRequest->delete();

        return redirect()->route('vehicleslist.index')
            ->with('success', 'Vehicle request deleted successfully.');
    }
}
