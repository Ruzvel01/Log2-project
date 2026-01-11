<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginOtpMail;
use Carbon\Carbon;
use App\Models\LoginOtp;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    // Step 1: Attempt login and send OTP
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::validate($credentials)) {
            return redirect()->back()->with('error', 'Incorrect username or password.');
        }

        $user = User::where('username', $request->username)->first();

        // Generate OTP
        $otp = rand(100000, 999999);

        LoginOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]
        );

      Mail::to($user->email)->send(new \App\Mail\LoginOtpMail($otp, $user->username));

        // Redirect to OTP form
        return redirect()->route('auth.showOtpForm', ['user' => $user->id])
                         ->with('success', 'OTP sent to your Gmail. Please enter it to complete login.');
    }
public function register(Request $request)
{
    // I-validate ang input
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:6',
    ]);

    // I-save ang user sa database
    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->back()->with('success', 'Registration successful! You can now login.');
}
// Idagdag ito sa loob ng AuthController class
public function logout(Request $request)
{
    Auth::logout();

    // I-clear ang session para safe
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been logged out.');
}
 public function showAuthForm() {
        return view('auth.auth'); // your combined login/register Blade
    }
    // Step 2: Show OTP form
    public function showOtpForm(Request $request)
    {
        $userId = $request->query('user');
        return view('auth.login-otp', compact('userId'));
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|digits:6',
        ]);

        $loginOtp = LoginOtp::where('user_id', $request->user_id)
                            ->where('otp', $request->otp)
                            ->where('expires_at', '>', Carbon::now())
                            ->first();

        if (!$loginOtp) {
            return redirect()->back()->with('error', 'Invalid or expired OTP.');
        }

        // Log in the user
        $user = User::find($request->user_id);
        Auth::login($user);
        $request->session()->regenerate();

        // Delete OTP
        $loginOtp->delete();

        return redirect('/dashboard')->with('success', 'Logged in successfully!');
    }

    // Idagdag ito sa loob ng AuthController class

public function resendOtp(Request $request)
{
    $request->validate(['user_id' => 'required|exists:users,id']);
    
    $user = User::find($request->user_id);
    $otp = rand(100000, 999999);

    // Update ang existing o gawa bago
    LoginOtp::updateOrCreate(
        ['user_id' => $user->id],
        [
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]
    );

    // I-send ulit ang email
    Mail::to($user->email)->send(new \App\Mail\LoginOtpMail($otp, $user->username));

    return redirect()->back()->with('success', 'A new OTP has been sent to your email.');
}



public function showSettings()
{
    
    $user = Auth::user();
    return view('auth.settings', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'username' => 'required|string|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('profile_picture')) {
        // Delete old picture
        if ($user->profile_picture && Storage::exists('public/profile/' . $user->profile_picture)) {
            Storage::delete('public/profile/' . $user->profile_picture);
        }

        $image = $request->file('profile_picture');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('profile', $imageName, 'public');


        $user->profile_picture = $imageName;
    }

    $user->username = $request->username;
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Current password is incorrect.');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
}
}