@extends('layouts.app')

@section('content')
<div class="otp-full-wrapper">
    <div class="otp-card-v2">
        <form action="{{ route('auth.verifyOtp') }}" method="POST">
            @csrf
            <h1>Verification</h1>
            <p class="subtitle">We sent a 6-digit code to your email.</p>

            <input type="hidden" name="user_id" value="{{ $userId }}">
            
            <div class="otp-input-group">
                <input type="text" name="otp" placeholder="000000" maxlength="6" required autofocus autocomplete="off">
            </div>

            <button type="submit" class="btn-verify">Verify Account</button>
        </form>

        <div class="resend-section">
            <p id="timer-text">Resend code in <span id="countdown">60</span>s</p>
            
            <form action="{{ route('auth.resendOtp') }}" method="POST" id="resend-form" style="display: none;">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userId }}">
                <p>Didn't get the code? 
                    <button type="submit" class="resend-link">Resend Code</button>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    let timeLeft = 60;
    const countdownDisplay = document.getElementById('countdown');
    const timerText = document.getElementById('timer-text');
    const resendForm = document.getElementById('resend-form');

    const timer = setInterval(() => {
        timeLeft--;
        if(countdownDisplay) countdownDisplay.innerText = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timer);
            if(timerText) timerText.style.display = 'none';
            if(resendForm) resendForm.style.display = 'block';
        }
    }, 1000);
</script>
@endsection