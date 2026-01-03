@extends('layouts.log2home')

@section('content')
<div class="container">
    <h4>Edit Vehicle Request</h4>

   <form method="POST" action="{{ route('vehicleslist.update', ['vehicleRequest' => $vehicleRequest->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Vehicle Model</label>
            <input type="text" name="vehicle_model" class="form-control"
                   value="{{ $vehicleRequest->vehicle_model }}" required>
        </div>

        <div class="mb-3">
            <label>Vehicle Type</label>
            <select name="vehicle_type" class="form-select" required>
                <option value="Truck" {{ $vehicleRequest->vehicle_type == 'Truck' ? 'selected' : '' }}>Truck</option>
                <option value="Van" {{ $vehicleRequest->vehicle_type == 'Van' ? 'selected' : '' }}>Van</option>
                <option value="Motorcycle" {{ $vehicleRequest->vehicle_type == 'Motorcycle' ? 'selected' : '' }}>Motorcycle</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control"
                   value="{{ $vehicleRequest->quantity }}" required>
        </div>

        <div class="mb-3">
            <label>Purpose</label>
            <textarea name="purpose" class="form-control" required>{{ $vehicleRequest->purpose }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Pending" {{ $vehicleRequest->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $vehicleRequest->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $vehicleRequest->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button class="btn btn-primary">Update Request</button>
        <a href="{{ route('vehicleslist.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
