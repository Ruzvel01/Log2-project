@extends('layouts.log2home')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-card card-drivers">
        <div class="card-info">
            <h3>Total Drivers</h3>
            <p>{{ $drivertables->count() }}</p>
        </div>
        <div class="card-icon"><i class='bx bxs-user-circle'></i></div>
    </div>

    <div class="dashboard-card card-vehicles">
        <div class="card-info">
            <h3>Total Vehicles</h3>
            <p id="orders">{{ $totalVehicles }}</p>
        </div>
        <div class="card-icon"><i class='bx bxs-truck'></i></div>
    </div>

    <div class="dashboard-card card-reports">
        <div class="card-info">
            <h3>Monthly Reports</h3>
            <p>₱0</p>
        </div>
        <div class="card-icon"><i class='bx bx-trending-up'></i></div>
    </div>

    <div class="dashboard-card card-cost">
        <div class="card-info">
            <h3>Overall Cost</h3>
            <p>₱0</p>
        </div>
        <div class="card-icon"><i class='bx bxs-report'></i></div>
    </div>
</div>

<div class="main-dashboard-grid">
    <div class="charts-section">
        <div class="chart-card shadow-sm">
            <h3>Cost Analysis</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="chart-card shadow-sm">
            <h3>Material Distribution</h3>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <div class="driver-status-section shadow-sm">
        <div class="section-header">
            <h3>Driver Status</h3>
            <a href="#" class="view-all-link">View All</a>
        </div>
        
        <div class="driver-grid">
            @forelse($drivertables as $Drivertable)
            <div class="driver-item-card">
                <div class="driver-avatar-wrapper">
                    <div class="driver-avatar-circle">
                        <i class='bx bxs-user'></i>
                    </div>
                    <span class="status-dot {{ $Drivertable->is_active ? 'online' : 'offline' }}"></span>
                </div>
                <div class="driver-details">
                    <h4>{{ $Drivertable->name }}</h4>
                    <small>ID: #{{ $Drivertable->id }}</small>
                </div>
                <div class="status-badge {{ $Drivertable->is_active ? 'active' : 'idle' }}">
                    {{ $Drivertable->is_active ? 'Active' : 'Idle' }}
                </div>
            </div>
            @empty
            <div class="no-drivers">
                <i class='bx bx-info-circle'></i>
                <p>No drivers found.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection