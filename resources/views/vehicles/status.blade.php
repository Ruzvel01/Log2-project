@extends('layouts.log2home')
@section('title', 'Vehicle Status')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark m-0">Vehicle Monitoring Status</h4>
            <p class="text-muted small mb-0">{{ now()->format('l, F d, Y') }}</p>
        </div>
        <button onclick="window.location.reload()" class="btn btn-light btn-sm shadow-sm">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
    </div>

    {{-- CARD BOXES SECTION --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-total h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-light text-secondary me-3">
                     <i class='bx bxs-truck'></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Units</h6>
                        <h2 class="fw-bold m-0">{{ $counts['total'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-available h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                       <i class='bx bx-check' ></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Active</h6>
                        <h2 class="fw-bold m-0 text-success">{{ $counts['active'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-inuse h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                      <i class='bx bx-handicap' ></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">In-Use</h6>
                        <h2 class="fw-bold m-0 text-primary">{{ $counts['in_use'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm status-card border-maintenance h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">
                       <i class='bx bxs-car-mechanic' ></i>
                    </div>
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold mb-1">Maintenance</h6>
                        <h2 class="fw-bold m-0 text-danger">{{ $counts['maintenance'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-4">
            <form action="{{ route('vehicles.status') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Search Plate / Model</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Enter plate or model..." value="{{ request('search') }}">
                    </div>
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
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="In-Use" {{ request('status') == 'In-Use' ? 'selected' : '' }}>In-Use</option>
                        <option value="Maintenance" {{ request('status') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                    <a href="{{ route('vehicles.status') }}" class="btn btn-light px-3">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="head">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small text-muted">Plate No</th>
                        <th class="py-3 text-uppercase small text-muted">Model</th>
                        <th class="py-3 text-uppercase small text-muted">Type</th>
                        <th class="py-3 text-uppercase small text-muted">Status</th>
                        <th class="py-3 text-uppercase small text-muted">Last Activity</th>
                        <th class="py-3 text-uppercase small text-muted">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allVehicles as $v)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">{{ $v->plate_no }}</td>
                        <td>{{ $v->model }}</td>
                        <td><span class="badge bg-light text-dark fw-normal">{{ $v->type }}</span></td>
                        <td>
                            @php
                                $statusClass = match($v->status) {
                                    'Active' => 'badge-available',
                                    'In-Use' => 'badge-inuse',
                                    'Maintenance' => 'badge-maintenance',
                                    default => 'bg-secondary text-white'
                                };
                            @endphp
                            <span class="status-badge-pill {{ $statusClass }}">
                                {{ $v->status }}
                            </span>
                        </td>
                        <td class="text-muted small">
                            <i class="bi bi-clock-history me-1"></i> {{ $v->updated_at->diffForHumans() }}
                        </td>
                        <td>
                          @if($v->status == 'Active')
        <a href="{{ route('reservations.reserve', $v->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            Reserve
        </a>
    @else
        <span class="text-muted small">Locked</span>
    @endif

                               {{-- SHOW / DISPATCH --}}
    <button
        type="button"
        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
        data-bs-toggle="modal"
        data-bs-target="#showVehicle{{ $v->id }}"
    >
        <i class='bx bx-show'></i>
    </button>
                        </td>
                    </tr>
<!-- SHOW VEHICLE MODAL -->
<div class="modal fade" id="showVehicle{{ $v->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-car me-1"></i> Vehicle Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Plate No:</strong> {{ $v->plate_no }}
                    </li>
                    <li class="list-group-item">
                        <strong>Model:</strong> {{ $v->model }}
                    </li>
                    <li class="list-group-item">
                        <strong>Type:</strong> {{ $v->type }}
                    </li>
                    <li class="list-group-item">
                        <strong>Status:</strong>
                        <span class="badge bg-success">{{ $v->status }}</span>
                    </li>
                </ul>
            </div>

            <div class="modal-footer">
                {{-- DISPATCH --}}
                <form action="{{ route('dispatch.inuse', $v->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-transfer"></i> Dispatch (In-Use)
                    </button>
                </form>

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>




                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No records found matching your filters.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3 ps-4">
            <a href="{{ route('vehicleslist.index') }}" class="text-decoration-none text-secondary small">
                <i class="bi bi-arrow-left me-1"></i> Back to Management
            </a>
        </div>
    </div>
</div>
@endsection