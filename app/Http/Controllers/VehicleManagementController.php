<?php



namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;

class VehicleManagementController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    // Lahat ng requests
    $requests = VehicleRequest::latest()->get();

    // Table 1: Registered Vehicles (Lahat o yung mga 'Registered' lang)
    $vehicles = Vehicle::query()
        ->when($search, function($query, $search) {
            return $query->where('plate_no', 'LIKE', "%{$search}%")
                         ->orWhere('model', 'LIKE', "%{$search}%");
        })
        ->latest()
        ->get();

    // Table 2: Submited to Status Monitoring
    // Sinasala lang natin yung mga active na sa monitoring
    $monitoringVehicles = Vehicle::whereIn('status', ['Available', 'In-Use', 'Maintenance'])
        ->latest()
        ->get();

    return view('vehicleslist.index', compact('requests', 'vehicles', 'monitoringVehicles'));
}

 public function store(Request $request)
{
    $validated = $request->validate([
        'plate_no' => 'required|unique:vehicles,plate_no',
        'model'    => 'required|string',
        'type'     => 'required',
        // 'status' is required but we will force it to be 'Registered' initially
    ]);

    // Force the status to 'Registered' so it won't show in the Status Index yet
    $validated['status'] = 'Registered'; 

    Vehicle::create($validated);

    return redirect()->back()->with('success', 'Vehicle registered! View it to submit to monitoring.');
}
    // Update Vehicle
public function update(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);
    
    $validated = $request->validate([
       'plate_no' => 'required|unique:vehicles,plate_no',
        'model'    => 'required|string',
        'type'     => 'required',
        'status'   => 'required',
        // New validations
        'engine_no'  => 'nullable|string',
        'chassis_no' => 'nullable|string',
        'color'      => 'nullable|string',
        'fuel_type'  => 'nullable|string',
        'transmission' => 'nullable|string',
    ]);

    $vehicle->update($validated);

    return redirect()->back()->with('success', 'Vehicle updated successfully!');
}

// Delete Vehicle
public function destroy($id)
{
    $vehicle = Vehicle::findOrFail($id);
    $vehicle->delete();

    return redirect()->back()->with('success', 'Vehicle deleted successfully!');
}

public function statusIndex(Request $request)
{
    // Simulan ang query para sa mga active vehicles lang
    $query = Vehicle::whereIn('status', ['Available', 'In-Use', 'Maintenance']);

    // FILTER: Search Plate or Model
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('plate_no', 'like', '%' . $request->search . '%')
              ->orWhere('model', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER: Vehicle Type
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // FILTER: Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Kunin ang filtered results
    $allVehicles = $query->latest('updated_at')->get();

    // Bilangin ang bawat status para sa mga Card Boxes (Overall stats ito)
    $counts = [
        'available'   => Vehicle::where('status', 'Available')->count(),
        'in_use'      => Vehicle::where('status', 'In-Use')->count(),
        'maintenance' => Vehicle::where('status', 'Maintenance')->count(),
        'total'       => Vehicle::whereIn('status', ['Available', 'In-Use', 'Maintenance'])->count(),
    ];
    
    return view('vehicles.status', compact('allVehicles', 'counts'));
}
public function setAvailable($id)
{
    $vehicle = Vehicle::findOrFail($id);
    
    // Pagka-submit, gawin nating 'Available' ang status sa database
    $vehicle->status = 'Available'; 
    $vehicle->save();

    return redirect()->back()->with('success', 'Vehicle submitted to monitoring!');
}


}