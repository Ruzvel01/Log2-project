@extends('layouts.log2home')
@section('title', 'Vehicle Management')

@section('content')

@if (session('success'))
<div id="successAlert" class="alert-success-custom">
    <span>{{ session('success') }}</span>
    <button onclick="closeAlert()">✖</button>
</div>
@endif

<div class="container-fuild">
    <h4 class="mb-3">Vehicle Management</h4>

    {{-- TABS --}}
   <ul class="nav nav-tabs mb-3 list" id="vehicleTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link {{ !request('vehicle_model') && !request('status') && !request('vehicle_type') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#vehicles">
            Vehicle List
        </button>
    </li>
    <li class="nav-item">
        {{-- Kapag may filter data sa URL, automatic magiging 'active' itong tab na ito --}}
        <button class="nav-link {{ request('vehicle_model') || request('status') || request('vehicle_type') ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#requests">
            Vehicle Requests
        </button>
    </li>
</ul>

    <div class="tab-content">

        {{-- ================= TAB 1: VEHICLE LIST ================= --}}
        
        <div class="tab-pane fade {{ !request('vehicle_model') && !request('status') && !request('vehicle_type') ? 'show active' : '' }}" id="vehicles">
    
    {{-- ETO YUNG UNANG CARD (MASTER LIST) --}}
    <div class="card mb-4">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <form action="{{ route('vehicles.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Search Plate No or Model..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                        @if(request('search'))
                            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerVehicleModal">
                        + Add
                    </button>
                </div>
            </div>
        </div>

       <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold text-dark m-0">Registered Vehicles Master List</h6>
        <span class="badge bg-light text-dark border">{{ count($vehicles) }} Total Vehicles</span>
    </div>

    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>Vehicle Details</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date Registered</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-car-front-fill text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $vehicle->plate_no }}</div>
                                    <small class="text-muted">{{ $vehicle->model }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary small fw-bold">{{ $vehicle->type }}</span>
                        </td>
                        <td>
                            @if($vehicle->monitoring_status == 'Not-Submitted')
                                <span class="badge badge-soft-secondary">Registered</span>
                            @elseif($vehicle->monitoring_status == 'Submitted')
                                <span class="badge badge-soft-info">Submitted</span>
                            @else
                                <span class="badge badge-soft-success">{{ $vehicle->status }}</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $vehicle->created_at->format('M d, Y') }}
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn-sm btn-light btn-action" title="View" data-bs-toggle="modal" data-bs-target="#viewModal{{ $vehicle->id }}">
                                   <i class='bx bx-show'></i>
                                </button>
                                <button class="btn btn-sm btn-light btn-action" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $vehicle->id }}">
                                    <i class='bx bx-edit' ></i>
                                </button>
                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Are You Sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light btn-action" title="Delete">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                          <img src="{{ asset('image/van.png') }}" width="50" class="mb-3 opacity-50">
                            <p class="text-muted">No registered vehicles found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>

    {{-- ETO YUNG PAGITAN --}}
    <hr class="my-5">

    {{-- ETO YUNG PANGALAWANG CARD (LIVE STATUS MONITORING) --}}
   <div class="card shadow-sm border-0 mb-5" style="border-radius: 12px; overflow: hidden;">
    <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center border-0">
        <h6 class="m-0 fw-bold">
            <i class="bi bi-activity text-success me-2"></i>Submitted Vehicles For Status Monitoring
        </h6>
        <a href="{{ route('vehicles.status') }}" class="btn btn-sm btn-outline-light rounded-pill px-3" style="font-size: 11px;">
            Open Status Dashboard
        </a>
    </div>
    
    <div class="card-body bg-white p-0"> {{-- Ginawang white at p-0 para saktong sakto ang table --}}
        <div class="table-responsive no-scroll-table"> {{-- Idinagdag ang no-scroll class --}}
            <table class="table table-custom-flat table-hover align-middle mb-0">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="ps-4 border-0 text-muted small uppercase" style="font-weight: 700; font-size: 11px;">Plate No</th>
                        <th class="border-0 text-muted small" style="font-weight: 700; font-size: 11px;">Model</th>
                        <th class="border-0 text-muted small" style="font-weight: 700; font-size: 11px;">Current Status</th>
                        <th class="border-0 text-center text-muted small" style="font-weight: 700; font-size: 11px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($monitoringVehicles as $mv)
                        @php
                            $statusStyle = 'status-available';
                            if($mv->status == 'In-Use') $statusStyle = 'status-inuse';
                            if($mv->status == 'Maintenance') $statusStyle = 'status-maintenance';
                        @endphp
                        <tr>
                            <td class="ps-4 fw-bold text-dark">{{ $mv->plate_no }}</td>
                            <td class="text-secondary">{{ $mv->model }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
            Submitted
        </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-quickview" data-bs-toggle="modal" data-bs-target="#viewModal{{ $mv->id }}">
                                    Quick View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox d-block mb-2 fs-3"></i>
                                Walang sasakyan sa status monitoring.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

      

        {{-- ================= TAB 2: REQUESTS ================= --}}
        <div class="tab-pane fade {{ request('vehicle_model') || request('status') || request('vehicle_type') ? 'show active' : '' }}" id="requests">
            {{-- Ang iyong existing code para sa requests filters at table... --}}
            <form method="GET" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="text" name="vehicle_model" class="form-control" placeholder="Vehicle Model" value="{{ request('vehicle_model') }}">
                </div>
                <div class="col-md-3">
                   <select name="type" class="form-select" required>
    <option value="Van">Van</option>
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
                                            <a href="{{ route('vehicleslist.edit', $row) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('vehicleslist.destroy', $row) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this request?');">
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

<div class="modal fade" id="registerVehicleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Register New Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plate Number</label>
                        <input type="text" name="plate_no" class="form-control" required placeholder="ABC-1234">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" required placeholder="Toyota Vios">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Engine Number</label>
                            <input type="text" name="engine_no" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chassis Number</label>
                            <input type="text" name="chassis_no" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Color</label>
                            <input type="text" name="color" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fuel Type</label>
                            <select name="fuel_type" class="form-select">
                                <option value="Gasoline">Gasoline</option>
                                <option value="Diesel">Diesel</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vehicle Type</label>
                       <select name="type" class="form-select" required>
    <option value="Van">Van</option>
</select>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Initial Status</label>
                        <select name="status" class="form-select">
                            <option value="Available">Available</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($vehicles as $vehicle)
        @include('vehicleslist.modals.view')
        @include('vehicleslist.modals.edit')
    @endforeach
@endsection