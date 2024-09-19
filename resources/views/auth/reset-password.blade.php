@extends('layouts.app')
@section('title', 'Reset Password')
@section('styles')
@endsection
@section('content')
    <div class="loginWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="col-lg-6 mx-auto px-0">
                        <div class="text-center pt-2">
                            <h2>{{ __('Reset') }} {{ __('Password') }}</h2>
                        </div>
                        <div class="loginCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                            <div class="mt-3 mb-3">
                                @include('layouts.partial.show-error')
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Email') }}</label>
                                <input class="form-control form-control-lg" type="text" name="email"
                                    value="{{ old('email') }}" placeholder="email">
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-1">{{ __('Password') }}</label>
                                <input class="form-control form-control-lg" type="password" name="password"
                                    placeholder="**********">
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-1">{{ __('Confirm') }} {{ __('Password') }}</label>
                                <input class="form-control form-control-lg" type="password" name="password_confirmation"
                                    placeholder="**********">
                                @error('password_confirmation')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                {{ __('Reset') }} {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
