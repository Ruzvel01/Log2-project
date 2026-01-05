@extends('layouts.log2home')

@section('title', 'Dashboard')

@section('content')
 @if(session('success'))
<div class="toast toast-success show">
    <span>{{ session('success') }}</span>
</div>
@endif
<div class="dashboard-container">
    <div class="dashboard-card">
        <div class="card-icon user"><i class='bx bxs-user-circle'></i></div>
        <h3>Drivers</h3>
        <p id="users">0</p>
    </div>

    <div class="dashboard-card">
        <div class="card-icon truck"><i class='bx bxs-truck'></i></div>
        <h3>Total Vehicles</h3>
        <p id="orders">0</p>
    </div>

    <div class="dashboard-card">
        <div class="card-icon sales"><i class='bx bx-trending-up'></i></div>
        <h3>Reports</h3>
        <p id="sales">₱0</p>
    </div>

    <div class="dashboard-card">
        <div class="card-icon report"><i class='bx bxs-report'></i></div>
        <h3>Total Cost</h3>
        <p id="pending">0</p>
    </div>
</div>


  <!-- 📊 Charts Section -->
<div class="dashboard-charts">
  <div class="chart-card">
    <h3>Cost Anaylist</h3>
    <canvas id="salesChart"></canvas>
  </div>

  <div class="chart-card">
    <h3>Heavy and Light Materials</h3>
    <canvas id="ordersChart"></canvas>
  </div>
</div>



<div class="table-card ">
    <h3>Drivers Status</h3>
     <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Driver ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivertables  as $Drivertable)
            <tr>
                <td>#{{ $Drivertable->id }}</td>
                <td>{{ $Drivertable->name }}</td>
                <td>{{ $Drivertable->email }}</td>
                <td>
                    @if($Drivertable->is_active)
                        <span style="color:green;font-weight:bold;">Active</span>
                    @else
                        <span style="color:red;font-weight:bold;">Inactive</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>


@endsection

