<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index() {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'license_no' => 'required|unique:drivers',
        ]);

        Driver::create($request->all());
        return back()->with('success', 'Driver added successfully!');
    }
}