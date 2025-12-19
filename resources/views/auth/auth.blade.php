@extends('layouts.app')

@section('title', 'Login / Register')

@section('content')

<!-- Toast Notifications -->
@if(session('success'))
<div class="toast toast-success">
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="toast toast-error">
    <span>{{ session('error') }}</span>
</div>
@endif

@if($errors->any())
<div class="toast toast-error">
    <span>{{ $errors->first() }}</span>
</div>
@endif




    <div class="form-box login">
        <form action="{{route('auth.login')}}" method="POST">
            @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="forgot-link">
                <a href="#">Forget Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <!--
            <p>or login with social platform</p>
            
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google-plus'></i></a>
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-github'></i></a>
            </div>
            -->
        </form>
    </div>

    <!-- Register Form -->
    <div class="form-box register">
        <form action="{{route('auth.register')}}" method="POST">
            @csrf
            <h1>Register</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Register</button>
            <p>or register with social platform</p>
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google-plus'></i></a>
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-github'></i></a>
            </div>
        </form>
    </div>

   <script>
    document.addEventListener("DOMContentLoaded", () => {
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        // Slide down
        toast.classList.add('show');

        // Slide back up after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
        }, 3000);
    });
});

   </script>

@endsection
