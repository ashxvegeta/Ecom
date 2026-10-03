@extends('layouts.frontend')

@section('title', 'Register - TechZone Electronics')

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
        max-width: 500px;
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
    .password-hint {
        font-size: 12px;
        color: #86868b;
        margin-top: 4px;
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
        margin-top: 10px;
    }
    .btn-auth-primary:hover {
        background: #2d2d2f;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
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
    .login-prompt-link {
        color: #1d1d1f;
        font-weight: 600;
        text-decoration: underline;
        transition: color 0.2s;
    }
    .login-prompt-link:hover {
        color: #0071e3;
    }
    .terms-text {
        font-size: 12px;
        color: #86868b;
        line-height: 1.5;
        margin-top: 14px;
    }
    .terms-text a {
        color: #1d1d1f;
        text-decoration: underline;
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
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header Badge & Title --}}
        <div class="text-center">
            <span class="auth-header-badge">
                <span>⚡</span> Join TechZone
            </span>
            <h1 class="auth-title">Create your account</h1>
            <p class="auth-subtitle">Unlock member perks, order tracking, and express checkout</p>
        </div>

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

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Full Name --}}
            <div class="form-group mb-3">
                <label for="name">
                    <i class="bi bi-person mr-1 text-muted"></i> Full Name
                </label>
                <div class="custom-input-group">
                    <i class="bi bi-person input-icon"></i>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" 
                           placeholder="John Doe" 
                           required 
                           autofocus 
                           autocomplete="name">
                </div>
                @error('name')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Email Address --}}
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
                           autocomplete="username">
                </div>
                @error('email')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group mb-3">
                <label for="password">
                    <i class="bi bi-shield-lock mr-1 text-muted"></i> Password
                </label>
                <div class="custom-input-group">
                    <i class="bi bi-key input-icon"></i>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Create a strong password" 
                           required 
                           autocomplete="new-password">
                    <button type="button" class="toggle-password-btn" id="togglePasswordBtn" title="Show or hide password">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
                <div class="password-hint">
                    <i class="bi bi-info-circle mr-1"></i> Minimum 8 characters with letters & numbers.
                </div>
                @error('password')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group mb-3">
                <label for="password_confirmation">
                    <i class="bi bi-check2-circle mr-1 text-muted"></i> Confirm Password
                </label>
                <div class="custom-input-group">
                    <i class="bi bi-shield-check input-icon"></i>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                           placeholder="Repeat your password" 
                           required 
                           autocomplete="new-password">
                    <button type="button" class="toggle-password-btn" id="toggleConfirmPasswordBtn" title="Show or hide password">
                        <i class="bi bi-eye" id="toggleConfirmPasswordIcon"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <small class="text-danger mt-1 d-block font-weight-medium">
                        <i class="bi bi-x-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Terms text --}}
            <p class="terms-text text-center">
                By creating an account, you agree to TechZone's 
                <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
            </p>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-auth-primary btn-block">
                <span>Create Account</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>

        {{-- Divider --}}
        <div class="auth-divider">
            <span>Already have an account?</span>
        </div>

        {{-- Log In Prompt --}}
        <div class="text-center">
            <p class="mb-0" style="font-size: 14px; color: #555558;">
                Have a TechZone account? 
                <a href="{{ route('login') }}" class="login-prompt-link">
                    Sign in here <i class="bi bi-arrow-right-short"></i>
                </a>
            </p>
        </div>

        {{-- Features & Guarantees --}}
        <div class="auth-features">
            <div class="feature-item" title="Official Warranty on all products">
                <i class="bi bi-shield-check"></i>
                <span>1-Yr Warranty</span>
            </div>
            <div class="feature-item" title="Priority customer support">
                <i class="bi bi-headset"></i>
                <span>24/7 Support</span>
            </div>
            <div class="feature-item" title="Fast delivery on all orders">
                <i class="bi bi-truck"></i>
                <span>Fast Delivery</span>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Toggle Main Password
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

        // Toggle Confirm Password
        $('#toggleConfirmPasswordBtn').on('click', function() {
            var passwordField = $('#password_confirmation');
            var icon = $('#toggleConfirmPasswordIcon');
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
