@extends('layouts.log2home')

@section('title', 'User Settings')

@section('content')

<style>
    :root {
        --primary-color: #4f46e5;
        --bg-color: #f9fafb;
        --card-bg: #ffffff;
        --text-main: #111827;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --success: #10b981;
        --error: #ef4444;
    }

    /* Ginawang mas malapad ang container */
    .settings-wrapper {
        max-width: 1200px; 
        margin: 2rem auto;
        padding: 0 1.5rem;
        font-family: 'Inter', sans-serif;
    }

    .settings-header {
        margin-bottom: 2rem;
    }

    .settings-header h1 {
        font-size: 1.875rem;
        color: var(--text-main);
        font-weight: 700;
    }

    /* Eto yung magpapagawa ng Landscape layout */
    .settings-grid {
        display: flex;
        flex-direction: row;
        gap: 2rem;
        align-items: flex-start;
    }

    .section-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        flex: 1; /* Pantay ang laki ng dalawang card */
        min-height: 450px; /* Para pantay ang height kahit maikli content */
    }

    .section-card h2 {
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        color: var(--text-main);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.75rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .profile-preview {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .profile-preview img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--border-color);
    }

    .btn-update {
        background-color: var(--primary-color);
        color: white;
        padding: 0.625rem 1.25rem;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s;
        width: 100%; /* Ginawang full width ang button para sa landscape look */
        margin-top: 1rem;
    }

    .btn-update:hover {
        opacity: 0.9;
    }

    /* Toast Notifications */
    .toast {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        color: white;
        font-weight: 500;
    }
    .toast-success { background-color: var(--success); }
    .toast-error { background-color: var(--error); }

    /* Responsive: Magiging vertical ulit kapag mobile na ang screen */
    @media (max-width: 768px) {
        .settings-grid {
            flex-direction: column;
        }
        .section-card {
            width: 100%;
            min-height: auto;
        }
    }
</style>

<div class="settings-wrapper">
    <div class="settings-header">
        <h1>Account Settings</h1>
        <p style="color: var(--text-muted)">Manage your profile information and security.</p>
    </div>

    @if(session('success'))
    <div class="toast toast-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="toast toast-error">{{ session('error') }}</div>
    @endif

    <div class="settings-grid">
        <div class="section-card">
            <h2>Profile Information</h2>
            <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="profile-preview">
                    <img src="{{ $user->profile_picture ? asset('storage/profile/'.$user->profile_picture) : asset('image/default-avatar.png') }}" alt="Avatar">
                    <div class="form-group">
                        <label>Change Photo</label>
                        <input type="file" name="profile_picture" class="form-control" style="border:none; padding:0;">
                    </div>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <button type="submit" class="btn-update">Save Changes</button>
            </form>
        </div>

        <div class="section-card">
            <h2>Security</h2>
            <form action="{{ route('settings.password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-update">Update Password</button>
            </form>
        </div>
    </div>
</div>

@endsection