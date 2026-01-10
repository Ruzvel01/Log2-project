@extends('layouts.log2home')
@section('title', 'Dispatch Center')

@section('content')




<div class="container-fluid">
    <h4 class="fw-bold mb-4">Dispatch Center</h4>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold text-primary"><i class='bx bx-list-ul'></i> Pending for Dispatch</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Vehicle</th>
                        <th>Reserved By</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $r)
                    <tr>
                        <td>
                            <strong>{{ $r->vehicle->plate_no }}</strong><br>
                            <small class="text-muted">{{ $r->vehicle->model }}</small>
                        </td>
                        <td>{{ $r->reserved_by }}</td>
                        <td>{{ $r->start_time }} → {{ $r->end_time }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm rounded-pill px-3" 
                                    onclick="initDispatchMap('{{ $r->id }}')"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#dispatchModal{{ $r->id }}">
                                Prepare Route
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="dispatchModal{{ $r->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('dispatch.store') }}">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{ $r->id }}">
                                
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title fw-bold">Dispatch Vehicle: {{ $r->vehicle->plate_no }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-info py-2 small mb-2 text-center">
                                            <i class='bx bx-search'></i> Use the search icon on the map to set <b>Start</b> and <b>End</b> points.
                                        </div>
                                        <div id="map{{ $r->id }}" class="map-container mb-3"></div>

                                        <div class="row g-3">
                                            <div class="col-12 row g-2 p-2 bg-light rounded border m-0 mb-3">
                                                <h6 class="fw-bold text-primary border-bottom pb-2">Step 2: Assign Details</h6>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Start Location</label>
                                                    <input type="text" name="start_location" id="start{{ $r->id }}" class="form-control" readonly required placeholder="Search on map...">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">End Location</label>
                                                    <input type="text" name="end_location" id="end{{ $r->id }}" class="form-control" readonly required placeholder="Search on map...">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Assign Driver</label>
                                                    <select name="driver_id" class="form-select" required>
                                                        <option value="">-- Select Available Driver --</option>
                                                        @foreach($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 row g-2 p-2 bg-light rounded border m-0">
                                                <h6 class="fw-bold text-primary border-bottom pb-2">Step 3: Schedule & Arrival</h6>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Dispatch Date</label>
                                                    <input type="date" name="dispatch_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold">Dispatch Time</label>
                                                    <input type="time" name="dispatch_time" class="form-control" value="{{ date('H:i') }}" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold">Estimated Arrival (Date & Time)</label>
                                                    <input type="datetime-local" name="estimated_arrival" class="form-control border-warning" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success px-5">Confirm Dispatch</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h5 class="fw-bold mb-3 mt-5">Recent Dispatch Logs</h5>
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Vehicle & Driver</th>
                        <th>Route</th>
                        <th>Dispatch Schedule</th>
                        <th>Estimated Arrival</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeDispatches as $dispatch)
                    <tr>
                        <td>
                            <span class="fw-bold text-primary">{{ $dispatch->vehicle->plate_no }}</span><br>
                            <small class="text-muted"><i class='bx bx-user'></i> {{ $dispatch->driver->name ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <div class="small">
                                <span class="text-success">●</span> {{ $dispatch->start_location }}<br>
                                <span class="text-danger">●</span> {{ $dispatch->end_location }}
                            </div>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($dispatch->dispatch_date)->format('M d, Y') }} | {{ $dispatch->dispatch_time }}
                        </td>
                        <td>
                            <span class="text-warning fw-bold">
                                {{ \Carbon\Carbon::parse($dispatch->estimated_arrival)->format('M d, g:i A') }}
                            </span>
                        </td>
                        <td><span class="badge bg-info">On-going</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No recent dispatch history.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection