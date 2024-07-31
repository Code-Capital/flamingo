@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if (request()->is('messages'))
    <div class="bg-primary ps-3 py-3">
        <a id="sidebar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
@else
    <div class="hero">
        <div class="bg-primary">
            <a id="sidebar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        @php
            $loginUser = Auth::user();
        @endphp
        <div class="px-2 px-md-3 px-lg-5 bg-white pb-4">

            <div class="d-flex align-items-center justify-content-between gap-4 pb-3">
                <div class="profile position-relative">
                    <img class="position-absolute" src="{{ $loginUser->avatar_url }}" alt="profile image">
                </div>
                <div class="d-flex justify-content-between align-items-center flex-grow-1 pt-4">
                    <div class="name">
                        <span class="d-block">{{ $loginUser->full_name }} ({{ $loginUser->user_name }}) </span>
                        <span class="d-block pt-2"> {{ $loginUser->desingation }}</span>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="notifications position-relative">
                            <a class="text-decoration-none" href="{{ route('notifications.index') }}">
                                <img src="{{ asset('assets/bell.svg') }}" alt="notification bell">
                                <span class="position-absolute dot"></span>
                            </a>
                        </div>
                        {{-- @if (request()->routeIs('events.index')) --}}
                        {{--     <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a> --}}
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
