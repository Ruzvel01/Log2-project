<div class="modal fade" id="viewModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Vehicle Details: {{ $vehicle->plate_no }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-sm table-borderless">
                    <tr><th width="40%">Plate Number:</th><td>{{ $vehicle->plate_no }}</td></tr>
                    <tr><th>Model:</th><td>{{ $vehicle->model }}</td></tr>
                    <tr><th>Type:</th><td>{{ $vehicle->type }}</td></tr>
                    <tr><th>Status:</th><td><span class="badge bg-success">{{ $vehicle->status }}</span></td></tr>
                    <hr>
                    <tr><th>Engine No:</th><td>{{ $vehicle->engine_no ?? 'N/A' }}</td></tr>
                    <tr><th>Chassis No:</th><td>{{ $vehicle->chassis_no ?? 'N/A' }}</td></tr>
                    <tr><th>Color:</th><td>{{ $vehicle->color ?? 'N/A' }}</td></tr>
                    <tr><th>Fuel Type:</th><td>{{ $vehicle->fuel_type ?? 'N/A' }}</td></tr>
                    <tr><th>Transmission:</th><td>{{ $vehicle->transmission ?? 'N/A' }}</td></tr>
                    <tr><th>Date Added:</th><td>{{ $vehicle->created_at->format('F d, Y') }}</td></tr>
                </table>
                </div>
            </div>
           <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    
    @if($vehicle->status === 'Registered')
        <form action="{{ route('vehicles.setAvailable', $vehicle->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Submit to Status Monitoring</button>
        </form>
    @endif
</div>
        </div>
    </div>
</div>