<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drivertable;

class DashboardController extends Controller
{
    //
    public function index()
{
    $drivertables = Drivertable::all(); // fetch all drivers
    return view('dashboard.dashboard', compact('drivertables'));
}
}
