@extends('layouts.app')
@section('title', 'Login')
@section('styles')
@endsection
@section('content')
    <div class="loginWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-lg-6 mx-auto px-0">
                        <div class="text-center pt-2">
                            <h2>Login</h2>
                            <p class="px-0 px-md-3 px-lg-5">
                                To embark on your journey, take the first step by signing in here
                            </p>
                        </div>
                        <div class="loginCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                            <div class="mt-3 mb-3">
                                @include('layouts.partial.show-error')
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Email') }}</label>
                                <input class="form-control form-control-lg" type="text" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="email">
                                @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-1">Password</label>
                                <input class="form-control form-control-lg" type="password" name="password"
                                       placeholder="**********">
                            </div>
                            @if (Route::has('password.request'))
                                <div class="text-end">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none link">
                                        {{ __('Forgot password?') }}
                                    </a>
                                </div>
                            @endif
                            <div>
                                <label class="formCheckBox d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" name="remember">
                                    <span class="mt-1">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                {{ __('Sign in') }}
                            </button>

                            <div class="linkText mt-3">
                                <span>Don’t have an account? <a class="text-decoration-none"
                                                                href="{{ route('register') }}">Create an account</a></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
