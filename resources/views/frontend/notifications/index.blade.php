@extends('layouts.frontend')

@section('title', 'Home - TechZone Electronics')

@section('content')

<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">Notifications</h2>
    </div>
</section>

<section style="padding: 40px 0; background: #ffffff; min-height: 60vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @forelse($notifications as $notification)
                <div class="p-4 mb-3 bg-white shadow-sm" style="border-radius: 16px; border-left: 4px solid {{ $notification->read_at ? '#e5e5e5' : '#007bff' }};">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="mb-1" style="color: #1d1d1f; font-size: 15px;">
                                {{ $notification->data['message'] }}
                            </p>
                            <small style="color: #86868b;">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        @if(!$notification->read_at)
                            <span class="badge badge-primary" style="border-radius: 20px;">New</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div style="font-size: 60px;">🔔</div>
                    <h5 class="mt-3" style="color: #1d1d1f;">No notifications yet</h5>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</section>

@endsection