<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>
 <link rel="stylesheet" href="{{ asset('css/log2home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vehiclelist/vehicle.css') }}">
      <link rel="stylesheet" href="{{ asset('css/vehicles/status.css') }}">
       <link rel="stylesheet" href="{{ asset('css/vrds/reservation.css') }}">
         <link rel="stylesheet" href="{{ asset('css/dispatch/dispatch.css') }}">
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <!-- Custom CSS -->

</head>

<body>
 

 
  <div class="grid-container">
    @include('partials.header')
    @include('partials.sidebar')
    
    <main class="main-container">
        <div class="page-header" id="pageHeader">
            <h1 id="pageTitle">Dashboard</h1>
            <p id="pageSubtitle">Overview of system activity</p>
        </div>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <span class="text-muted small">&copy; 2026 Admin Dashboard. All rights reserved.</span>
            <span class="text-muted small">v1.0.2</span>
        </div>
    </footer>
</div>

  <!-- Scripts -->
  <!-- ApexCharts -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&libraries=places"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


  <!-- Custom JS -->
 
   <script src="{{ asset('js/log2home.js') }}"></script>
    <script src="{{ asset('js/dispatch/dispatch.js') }}"></script>
     <script src="{{ asset('js/vehiclelist/vehicle.js') }}"></script>
   
</body>

</html>