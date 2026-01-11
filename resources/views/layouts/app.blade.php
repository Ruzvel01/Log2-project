<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('image/imarket1.png') }}">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/
    7.0.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Logistic ||</title>
</head>
<body>
<div class="notes-box">
    <ul>
        <h1>Welcome to the Logistics Management System</h1>
        <li>Please log in to access real-time tracking, fleet monitoring, and delivery operations</li>
        <h1>Employee Login Portal</h1>
        <li>Enter your credentials to manage shipments, routes, and daily logistics operations</li>
    </ul>
</div>

 <div class="container">

 @yield('content')

      <div class="toggle-box">
    <div class="toggle-panel toggle-left">
        <h1>Hello, Welcome!</h1>
          <p>To Logistic 2 we're Glad you here</p>
          <!--
        <p>Don't have an account</p>
        
        <button class="btn register-btn">Register</button>
        -->
    </div>

     <div class="toggle-panel toggle-right">
        <h1>Welcome Back lilay!</h1>
          <h4>Naol Masipag</h4>
        <p>Already Have an account?</p>
        <button class="btn login-btn">Login</button>
    </div>
      </div>
          
 </div>

 <script src="{{ asset('js/login.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>