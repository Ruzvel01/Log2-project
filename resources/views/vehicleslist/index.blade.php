@extends('layouts.log2home')
@section('title', 'Vehicle Management')

@section('content')

@if (session('success'))
<div id="successAlert" class="alert-success-custom">
    <span>{{ session('success') }}</span>
    <button onclick="closeAlert()">✖</button>
</div>
@endif

<div class="container">
    <h4 class="mb-3">Vehicle Management</h4>

    {{-- TABS --}}
    <ul class="nav nav-tabs mb-3 list" id="vehicleTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#vehicles">
                Vehicle List
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#requests">
                Vehicle Requests
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ================= TAB 1: VEHICLE LIST ================= --}}
        <div class="tab-pane fade show active" id="vehicles">

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Plate No</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->plate_no }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->type }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $vehicle->status }}</span>
                                    </td>
                                    <td>{{ $vehicle->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No registered vehicles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- ================= TAB 2: REQUESTS ================= --}}
        <div class="tab-pane fade" id="requests">

            {{-- FILTERS --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="text" name="vehicle_model" class="form-control"
                        placeholder="Vehicle Model" value="{{ request('vehicle_model') }}">
                </div>

                <div class="col-md-3">
                    <select name="vehicle_type" class="form-select">
                        <option value="">All Types</option>
                        <option value="Truck">Truck</option>
                        <option value="Van">Van</option>
                        <option value="Motorcycle">Motorcycle</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <a href="{{ route('vehicleslist.create') }}" class="btn btn-success mb-3">
                + New Request
            </a>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $row)
                                <tr>
                                    <td>{{ $row->vehicle_model }}</td>
                                    <td>{{ $row->vehicle_type }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->purpose }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $row->status }}</span>
                                    </td>
                                 <td>
    <div class="d-flex gap-1">
        {{-- EDIT BUTTON --}}
        <a href="{{ route('vehicleslist.edit', $row) }}" class="btn btn-sm btn-primary">Edit</a>

        {{-- DELETE BUTTON --}}
        <form action="{{ route('vehicleslist.destroy', $row) }}" method="POST" class="m-0">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this request?');">
                Delete
            </button>
        </form>
    </div>
</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
