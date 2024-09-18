@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if (Request::routeIs('messages'))
    {{-- <div class="bg-primary ps-3 py-3">
        <a id="sidebar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div> --}}
    <div class="bg-primary py-3 d-flex justify-content-between align-items-center">
        <a id="sidebar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </a>

        <!-- Logout Dropdown -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="logoutDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                Logout
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="logoutDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@else
    <div class="hero">
        {{-- <div class="bg-primary">
            <a id="sidebar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div> --}}
        <div class="bg-primary py-3 d-flex justify-content-between align-items-center">
            <a id="sidebar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </a>

            <!-- Logout Dropdown -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="logoutDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="logoutDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @php
            $loginUser = $loginUser ?? Auth::user();
        @endphp
        <div class="px-2 px-md-3 px-lg-5 bg-white pb-4">

            <div class="d-flex align-items-center justify-content-between gap-4 pb-3">
                <div class="profile position-relative">
                    <img class="position-absolute" src="{{ $loginUser->avatar_url }}" alt="profile image">
                </div>
                <div class="d-flex justify-content-between align-items-center flex-grow-1 pt-4">
                    <div class="name">
                        <span class="d-block">{{ $loginUser->user_name }}</span>
                        <span> {{ $loginUser->desingation }}</span>
                        {{-- <span class="d-block"> <a href="javascript:void(0)" class="text-danger fw-bold"> Report Profile</a></span> --}}
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="notifications position-relative">
                            <a class="text-decoration-none" href="{{ route('notifications.index') }}">
                                <img src="{{ asset('assets/bell.svg') }}" alt="notification bell">
                                <span class="position-absolute dot"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
