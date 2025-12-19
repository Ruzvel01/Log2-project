<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>
 <link rel="stylesheet" href="{{ asset('css/log2home.css') }}">
  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- Custom CSS -->

</head>

<body>
  @if(session('success'))
<div class="toast toast-success show">
    <span>{{ session('success') }}</span>
</div>
@endif
  <div class="grid-container">

    <!-- Header -->
    @include('partials.header')
    <!-- End Header -->

    <!-- Sidebar -->
       {{-- SIDEBAR --}}
    @include('partials.sidebar')
    <!-- End Sidebar -->

    <!-- Main -->
    <main class="main-container">
     @yield('content')
    </main>
    <!-- End Main -->

  </div>

  <!-- Scripts -->
  <!-- ApexCharts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
  <!-- Custom JS -->
   <script src="{{ asset('js/log2home.js') }}"></script>
   
</body>

</html>