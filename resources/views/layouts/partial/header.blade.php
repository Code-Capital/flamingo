<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-0">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/logo.png') }} " alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active pe-4" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex gap-3">
                    @if(Auth::check())
                        {{-- <a class="btn btn-primary px-4" href="{{ route('dashboard') }}">Dashboard</a>--}}
                        {{-- <form method="POST" action="{{ route('logout') }}">--}}
                        {{--     @csrf--}}
                        {{--     <a class="btn btn-outline-primary px-4"--}}
                        {{--        onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>--}}
                        {{-- </form>--}}
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="dropdown">
                            <button class=" btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->full_name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
{{--                                    <a class="dropdown-item" href="#">Logout</a>--}}
                                </li>
                            </ul>
                        </div>
                    @else
                        <a class="btn btn-outline-primary px-4" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-primary px-4" href="{{ asset('register') }}">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
