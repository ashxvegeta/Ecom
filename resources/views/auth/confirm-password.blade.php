@extends('layouts.frontend')

@section('title', 'Confirm Password - TechZone Electronics')

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
        font-size: 26px;
        font-weight: 700;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }
    .auth-subtitle {
        color: #86868b;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 26px;
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
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header Badge & Title --}}
        <div class="text-center">
            <span class="auth-header-badge">
                <i class="bi bi-shield-check"></i> Security Check
            </span>
            <h1 class="auth-title">Confirm password</h1>
            <p class="auth-subtitle">
                This is a secure area of TechZone. Please confirm your password before continuing.
            </p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-group mb-4">
                <label for="password">
                    <i class="bi bi-shield-lock mr-1 text-muted"></i> Password
                </label>
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

            <button type="submit" class="btn btn-auth-primary btn-block">
                <span>Confirm Password</span>
                <i class="bi bi-check-lg"></i>
            </button>
        </form>

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
