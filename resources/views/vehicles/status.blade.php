@extends('layouts.log2home')
@section('title', 'Vehicle Status')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark m-0">Vehicle Monitoring Status</h4>
        <span class="text-muted small">{{ now()->format('l, F d, Y') }}</span>
    </div>

    {{-- CARD BOXES SECTION --}}
    {{-- CARD BOXES SECTION --}}
    <div class="row g-4 mb-4"> {{-- Nagdagdag ng g-4 para sa spacing --}}
        <div class="col-sm-6 col-md-3"> {{-- col-sm-6 para maging dalawa sa tablet --}}
            <div class="card shadow-sm status-card border-total h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold">Total Units</h6>
                    <h2 class="fw-bold m-0">{{ $counts['total'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-available h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold text-success">Available</h6>
                    <h2 class="fw-bold m-0 text-success">{{ $counts['available'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-inuse h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold text-primary">In-Use</h6>
                    <h2 class="fw-bold m-0 text-primary">{{ $counts['in_use'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-maintenance h-100">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold text-danger">Maintenance</h6>
                    <h2 class="fw-bold m-0 text-danger">{{ $counts['maintenance'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form action="{{ route('vehicles.status') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Search Plate / Model</label>
                    <input type="text" name="search" class="form-control" placeholder="Enter plate or model..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Vehicle Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Van" {{ request('type') == 'Van' ? 'selected' : '' }}>Van</option>
                        <option value="Truck" {{ request('type') == 'Truck' ? 'selected' : '' }}>Truck</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="In-Use" {{ request('status') == 'In-Use' ? 'selected' : '' }}>In-Use</option>
                        <option value="Maintenance" {{ request('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('vehicles.status') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Plate No</th>
                            <th>Model</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Last Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allVehicles as $v)
                        <tr>
                            <td class="ps-4 text-dark fw-bold">{{ $v->plate_no }}</td>
                            <td>{{ $v->model }}</td>
                            <td><span class="text-muted">{{ $v->type }}</span></td>
                            <td>
                                @php
                                    $statusClass = '';
                                    if($v->status == 'Available') $statusClass = 'badge-available';
                                    elseif($v->status == 'In-Use') $statusClass = 'badge-inuse';
                                    elseif($v->status == 'Maintenance') $statusClass = 'badge-maintenance';
                                @endphp
                                <span class="status-badge-pill {{ $statusClass }}">
                                    {{ $v->status }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                <i class="bi bi-clock-history me-1"></i> {{ $v->updated_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                No records found matching your filters.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            <a href="{{ route('vehicleslist.index') }}" class="btn btn-link text-decoration-none text-secondary p-0">
                <i class="bi bi-arrow-left"></i> Return to Vehicle Management
            </a>
        </div>
    </div>
</div>
@endsection