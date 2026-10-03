@extends('layouts.frontend')

@section('title', 'Login - TechZone Electronics')

@section('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 180px);
        background: linear-gradient(180deg, #f5f5f7 0%, #ffffff 100%);
        padding: 50px 15px 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .auth-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.06);
        padding: 42px 38px;
        width: 100%;
        max-width: 460px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .auth-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f0f2;
        color: #1d1d1f;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .auth-title {
        color: #1d1d1f;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }
    .auth-subtitle {
        color: #86868b;
        font-size: 14px;
        margin-bottom: 28px;
    }
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #1d1d1f;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
    }
    .custom-input-group {
        position: relative;
    }
    .custom-input-group .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #86868b;
        font-size: 16px;
        z-index: 5;
        pointer-events: none;
    }
    .custom-input-group .form-control {
        height: 50px;
        border-radius: 14px;
        border: 1.5px solid #e5e5e7;
        padding-left: 46px;
        padding-right: 46px;
        font-size: 14px;
        color: #1d1d1f;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .custom-input-group .form-control:focus {
        border-color: #000000;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08);
        background-color: #ffffff;
    }
    .custom-input-group .toggle-password-btn {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #86868b;
        cursor: pointer;
        padding: 6px 10px;
        font-size: 16px;
        z-index: 6;
        border-radius: 8px;
        transition: color 0.2s;
    }
    .custom-input-group .toggle-password-btn:hover {
        color: #1d1d1f;
    }
    .btn-auth-primary {
        background: #000000;
        color: #ffffff;
        border-radius: 30px;
        height: 50px;
        font-weight: 600;
        font-size: 15px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
    }
    .btn-auth-primary:hover {
        background: #2d2d2f;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
    }
    .btn-auth-secondary {
        border: 1.5px solid #d2d2d7;
        color: #1d1d1f;
        background: #ffffff;
        border-radius: 30px;
        height: 48px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-auth-secondary:hover {
        border-color: #1d1d1f;
        background: #f5f5f7;
        color: #1d1d1f;
        text-decoration: none;
    }
    .auth-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 24px 0;
        color: #86868b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .auth-divider::before, .auth-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e5e5e7;
    }
    .auth-divider span {
        padding: 0 12px;
    }
    .auth-features {
        margin-top: 26px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f2;
        display: flex;
        justify-content: space-between;
    }
    .feature-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #86868b;
    }
    .feature-item i {
        color: #1d1d1f;
        font-size: 14px;
    }
    .custom-control-label {
        font-size: 13px;
        color: #555558;
        cursor: pointer;
        padding-top: 2px;
    }
    .forgot-link {
        font-size: 13px;
        color: #0071e3;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }
    .forgot-link:hover {
        color: #005bb5;
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header Badge & Title --}}
        <div class="text-center">
            <span class="auth-header-badge">
                <span>⚡</span> TechZone Account
            </span>
            <h1 class="auth-title">Welcome back</h1>
            <p class="auth-subtitle">Sign in to manage your orders, cart, and account</p>
        </div>

        {{-- Status Notification --}}
        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 14px; font-size: 14px;">
                <i class="bi bi-check-circle-fill mr-2" style="font-size: 18px;"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        {{-- General Errors Alert --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4" role="alert" style="border-radius: 14px; font-size: 13px;">
                <div class="d-flex align-items-center font-weight-bold mb-1">
                    <i class="bi bi-exclamation-triangle-fill mr-2"></i> Please check the form errors
                </div>
                <ul class="mb-0 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Input --}}
            <div class="form-group mb-3">
                <label for="email">
                    <i class="bi bi-envelope mr-1 text-muted"></i> Email Address
                </label>
                <div class="custom-input-group">
                    <i class="bi bi-at input-icon"></i>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" 
                           placeholder="name@example.com" 
                           required 
                           autofocus 
                           autocomplete="username">
                </div>
                @error('email')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Password Input --}}
            <div class="form-group mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="mb-0">
                        <i class="bi bi-shield-lock mr-1 text-muted"></i> Password
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <div class="custom-input-group">
                    <i class="bi bi-key input-icon"></i>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Enter your password" 
                           required 
                           autocomplete="current-password">
                    <button type="button" class="toggle-password-btn" id="togglePasswordBtn" title="Show or hide password">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
                @error('password')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Keep me signed in</label>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-auth-primary btn-block">
                <span>Sign In</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        {{-- Divider --}}
        <div class="auth-divider">
            <span>New to TechZone?</span>
        </div>

        {{-- Create Account Link --}}
        <a href="{{ route('register') }}" class="btn btn-auth-secondary btn-block">
            <i class="bi bi-person-plus mr-2"></i> Create an Account
        </a>

        {{-- Features & Guarantees --}}
        <div class="auth-features">
            <div class="feature-item" title="Encrypted Connection">
                <i class="bi bi-shield-check"></i>
                <span>SSL Encrypted</span>
            </div>
            <div class="feature-item" title="100% Authentic Tech">
                <i class="bi bi-patch-check"></i>
                <span>Genuine Tech</span>
            </div>
            <div class="feature-item" title="Speedy Processing">
                <i class="bi bi-lightning-charge"></i>
                <span>Instant Access</span>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#togglePasswordBtn').on('click', function() {
            var passwordField = $('#password');
            var icon = $('#togglePasswordIcon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    });
</script>
@endsection
