<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/
    7.0.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
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
      <div class="form-box login">
        <form action="{{route('login')}}" method="POST" >
          @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username"placeholder="Username"required>
                <i class='bx bxs-user'></i>
            </div>
             <div class="input-box">
                <input type="password" name="password" placeholder="Password"required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="forgot-link">
                <a href="#">Forget Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <p>or login with social platform</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google-plus'></i></a>
                   <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
                      <a href="#"><i class='bx bxl-github' ></i></a>
                   
            </div>
        </form>
      </div>


       <div class="form-box register">
        <form action="{{route('register')}}" method="POST" >
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="username"placeholder="Username"required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="password" placeholder="Email"required>
               <i class='bx bxs-envelope' ></i>
            </div>
              <div class="input-box">
                <input type="password" name="password"placeholder="Password"required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
             <div class="input-box">
                <input type="password" name="password"placeholder="Confirm Password"required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="forgot-link">
                <a href="#">Forget Password?</a>
            </div>
            <button type="submit" class="btn">Register</button>
            <p>or Register with social platform</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google-plus google'></i></a>
                   <a href="#"><i class='bx bxl-facebook-circle facebook' ></i></a>
                      <a href="#"><i class='bx bxl-github github' ></i></a>
                   
            </div>
        </form>
      </div>
      <div class="toggle-box">
    <div class="toggle-panel toggle-left">
        <h1>Hello, Welcome!</h1>
          <h4>To Logistic 2 we're Glad you here</h4>
        <p>Don't have an account</p>
        <button class="btn register-btn">Register</button>
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
</body>

</html>