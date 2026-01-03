@extends('layouts.log2home')
@section('title', 'Vehicle Management')

@section('content')

@if (session('success'))
<div id="successAlert" class="alert-success-custom">
    <span>{{ session('success') }}</span>
    <button onclick="closeAlert()">✖</button>
</div>
@endif

<div class="container mt-5">
    <h2 class="mb-4">Vehicle Fleet Status</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h6>Total Vehicles</h6>
                    <h3>{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h6>Available</h6>
                    <h3>{{ $stats['available'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h6>On Trip</h6>
                    <h3>{{ $stats['on_trip'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h6>Maintenance</h6>
                    <h3>{{ $stats['maintenance'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-white"><strong>Vehicle List</strong></div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Plate Number</th>
                        <th>Status</th>
                        <th>Driver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->name }}</td>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>
                            @if($vehicle->status == 'Available')
                                <span class="badge bg-success">Available</span>
                            @elseif($vehicle->status == 'On Trip')
                                <span class="badge bg-warning text-dark">On Trip</span>
                            @else
                                <span class="badge bg-danger">Maintenance</span>
                            @endif
                        </td>
                        <td>{{ $vehicle->driver_name ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
