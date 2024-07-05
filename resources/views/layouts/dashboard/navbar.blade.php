@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Storage; @endphp
<div class="hero">
    <div class="bg-primary">
        <a id="sidebar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    @php
        $user = Auth::user();
    @endphp
    <div class="px-2 px-md-3 px-lg-5 bg-white pb-4">

        <div class="d-flex align-items-center justify-content-between gap-4 pb-3">
            <div class="profile position-relative">
                <img class="position-absolute" src="{{ $user->avatar_url }}"
                     alt="profile image">
            </div>
            <div class="d-flex justify-content-between align-items-center flex-grow-1 pt-4">
                <div class="name">
                    <span class="d-block">{{ $user->full_name }}</span>
                    <span class="d-block pt-2">Visitor</span>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <div class="notifications position-relative">
                        <a class="text-decoration-none" href="{{ route('notifications.index') }}">
                            <img src="{{ asset('assets/bell.svg') }}" alt="notification bell">
                            <span class="position-absolute dot"></span>
                        </a>
                    </div>
                    @if( request()->routeIs('events.index') )
                        <a href="createEvent" class="btn btn-primary">Create Event</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
