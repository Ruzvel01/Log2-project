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
             <div class="terms-condition" style="display: flex; align-items: center; gap: 8px; margin: 10px 0; font-size: 13px; text-align: left;">
            <input type="checkbox" id="loginTerms" name="terms" required style="width: 16px; height: 16px; cursor: pointer;">
            <label for="loginTerms">I agree to the <a href="javascript:void(0)" onclick="openModal()" style="color: #7494ec; text-decoration: none; font-weight: 600;">Terms & Conditions</a></label>
        </div>

            <div class="forgot-link">
                <a href="#">Forget Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
        
            <p>or login with social platform</p>
            
            <div class="social-icons">
                <a href="#"><i class='bx bxl-google-plus'></i></a>
                <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                <a href="#"><i class='bx bxl-github'></i></a>
            </div>
        
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

    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 style="margin-bottom: 10px; color: #333;">Terms and Conditions</h2>
            <div class="modal-body">
                <p><strong>1. Acceptance of Terms</strong><br>By logging in, you agree to follow our logistics service rules and regulations.</p>
                <p><strong>2. User Privacy</strong><br>We value your privacy. Your data is used strictly for logistics operations.</p>
                <p><strong>3. Responsibilities</strong><br>Users are responsible for all actions made under their account.</p>
            </div>
            <button type="button" class="btn" onclick="closeModal()" style="margin-top: 20px;">I Understand</button>
        </div>
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


function openModal() {
    document.getElementById("termsModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("termsModal").style.display = "none";
}

// Close modal if user clicks outside of the box
window.onclick = function(event) {
    const modal = document.getElementById("termsModal");
    if (event.target == modal) {
        closeModal();
    }
}

   </script>

@endsection
