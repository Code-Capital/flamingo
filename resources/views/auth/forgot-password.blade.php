@extends('layouts.app')
@section('title', 'Forget Password')
@section('styles')
@endsection
@section('content')
    <div class="loginWrapper py-5">
        <div class="container">
            <!-- Session Status -->
            <div class="row mx-0">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="col-lg-6 mx-auto px-0">
                        <div class="text-center pt-2">
                            <h2>Forget Password</h2>
                        </div>
                        <div class="loginCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                            <div class="mt-3 mb-3">
                                @if(session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 text-muted small">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </label>
                                <input class="form-control form-control-lg mt-3" type="text" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Please enter email">
                                @error('email')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{--
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
--}}
