@extends('layouts.frontend')

@section('title', 'Verify Email - TechZone Electronics')

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
        max-width: 480px;
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
        margin-bottom: 24px;
    }
    .btn-auth-primary {
        background: #000000;
        color: #ffffff;
        border-radius: 30px;
        height: 48px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 24px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
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
    <div class="auth-card text-center">

        <span class="auth-header-badge">
            <i class="bi bi-envelope-check"></i> Email Verification
        </span>
        <h1 class="auth-title">Verify your email</h1>
        <p class="auth-subtitle">
            Thanks for joining TechZone! Before getting started, please check your inbox and verify your email address by clicking on the link we just sent.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success d-flex align-items-center mb-4 text-left" role="alert" style="border-radius: 14px; font-size: 13px;">
                <i class="bi bi-check-circle-fill mr-2" style="font-size: 16px;"></i>
                <div>A new verification link has been sent to your email address.</div>
            </div>
        @endif

        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 mt-4">
            <form method="POST" action="{{ route('verification.send') }}" class="mb-2 mb-sm-0 w-100">
                @csrf
                <button type="submit" class="btn btn-auth-primary w-100">
                    <i class="bi bi-arrow-repeat mr-1"></i> Resend Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-100 mt-2 mt-sm-0">
                @csrf
                <button type="submit" class="btn btn-outline-secondary w-100" style="border-radius: 30px; height: 48px; font-size: 14px;">
                    Log Out
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
