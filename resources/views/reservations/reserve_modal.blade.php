<!-- Modal for a vehicle -->
<div class="modal fade" id="reserveModal{{ $vehicle->id }}" tabindex="-1" aria-labelledby="reserveModalLabel{{ $vehicle->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
        <div class="modal-header">
          <h5 class="modal-title" id="reserveModalLabel{{ $vehicle->id }}">Reserve Vehicle: {{ $vehicle->plate_no }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Reserved By</label>
            <input type="text" name="reserved_by" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Start Time</label>
              <input type="datetime-local" name="start_time" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>End Time</label>
              <input type="datetime-local" name="end_time" class="form-control" required>
            </div>
          </div>
          <div class="mb-3">
            <label>Purpose</label>
            <textarea name="purpose" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Confirm Reservation</button>
        </div>
      </form>
    </div>
  </div>
</div>
