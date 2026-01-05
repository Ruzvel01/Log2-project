<div class="modal fade" id="editModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Plate Number</label>
                        <input type="text" name="plate_no" class="form-control" value="{{ $vehicle->plate_no }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                      <select name="status" class="form-select">
    <option value="Registered" {{ $vehicle->status == 'Registered' ? 'selected' : '' }}>Registered</option>
    <option value="Available" {{ $vehicle->status == 'Available' ? 'selected' : '' }}>Available</option>
    <option value="In-Use" {{ $vehicle->status == 'In-Use' ? 'selected' : '' }}>In-Use</option>
    <option value="Maintenance" {{ $vehicle->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
</select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Available" {{ $vehicle->status == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Maintenance" {{ $vehicle->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>