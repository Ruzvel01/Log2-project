@extends('layouts.log2home')

@section('content')
<div class="container">
    <h4>Create Vehicle Request</h4>

    <form method="POST" action="{{ route('vehicleslist.store') }}">
        @csrf

        <div class="mb-3">
            <label>Vehicle Model</label>
            <input type="text" name="vehicle_model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vehicle Type</label>
            <select name="vehicle_type" class="form-select" required>
                <option value="">Select</option>
                <option>Truck</option>
                <option>Van</option>
                <option>Motorcycle</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Purpose</label>
            <textarea name="purpose" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success">Submit Request</button>
        <a href="{{ route('vehicleslist.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
