@extends('layouts.log2home')
@section('title', 'Reservations')

@section('content')


<div class="container-fluid reservation-container">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4><i class="fas fa-car me-2 text-primary"></i> Active Vehicles for Reservation</h4>
            <span class="badge bg-soft-primary text-primary">{{ count($activeVehicles) }} Available</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Plate No</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeVehicles as $vehicle)
                    <tr>
                        <td class="fw-bold text-dark">{{ $vehicle->plate_no }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td><span class="text-muted">{{ $vehicle->type }}</span></td>
                        <td>
                            <span class="badge bg-success badge-status">
                                {{ $vehicle->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-primary btn-reserve" data-bs-toggle="modal" data-bs-target="#reserveModal{{ $vehicle->id }}">
                                <i class="fas fa-calendar-plus me-1"></i> Reserve
                            </button>
                            @include('reservations.reserve_modal', ['vehicle' => $vehicle])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-car-side fa-3x mb-3 d-block opacity-25"></i>
                            No active vehicles available at the moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        {{-- FILTER SECTION FOR RECENT RESERVATIONS --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('reservations.index') }}" class="row g-3">

            {{-- Search by plate/model --}}
            <div class="col-md-4">
                <label class="form-label small">Search Vehicle</label>
                <input type="text" name="search" class="form-control" placeholder="Plate or model" value="{{ request('search') }}">
            </div>

            {{-- Status --}}
            <div class="col-md-3">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="Reserved" {{ request('status') == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="Dispatched" {{ request('status') == 'Dispatched' ? 'selected' : '' }}>Dispatched</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            {{-- From date --}}
            <div class="col-md-2">
                <label class="form-label small">From</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>

            {{-- To date --}}
            <div class="col-md-2">
                <label class="form-label small">To</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>

            {{-- Filter button --}}
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                 <i class='bx bx-filter-alt'></i>
                </button>
            </div>

        </form>
    </div>
</div>

        <div class="card-header">
            <h4><i class="fas fa-list-alt me-2 text-primary"></i> Recent Reservations</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Reserved By</th>
                        <th>Schedule</th>
                        <th>Purpose</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $r->vehicle->model }}</div>
                                <small class="text-muted">{{ $r->vehicle->plate_no }}</small>
                            </td>
                            <td>{{ $r->reserved_by }}</td>
                            <td>
                                <div class="small"><strong>From:</strong> {{ \Carbon\Carbon::parse($r->start_time)->format('M d, g:i A') }}</div>
                                <div class="small"><strong>To:</strong> {{ \Carbon\Carbon::parse($r->end_time)->format('M d, g:i A') }}</div>
                            </td>
                            <td><span class="text-truncate d-inline-block" style="max-width: 150px;">{{ $r->purpose }}</span></td>
                            <td>
                               <span class="badge bg-warning text-dark badge-status">
    {{ $r->status }}
</span>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No reservations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection