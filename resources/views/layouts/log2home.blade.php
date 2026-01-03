<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>
 <link rel="stylesheet" href="{{ asset('css/log2home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vehiclelist/vehicle.css') }}">
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->

</head>

<body>
 

 
  <div class="grid-container">

   
    @include('partials.header')


  
       {{-- SIDEBAR --}}
    @include('partials.sidebar')
  

   
    <main class="main-container">
      <div class="breadcrumb" id="breadcrumb">
    Dashboard
</div>
     @yield('content')
    </main>
    

  </div>

  <!-- Scripts -->
  <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
  <!-- Custom JS -->
 >
   <script src="{{ asset('js/log2home.js') }}"></script>
     <script src="{{ asset('js/vehiclelist/vehicle.js') }}"></script>
   
</body>

</html>