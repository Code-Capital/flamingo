@extends('layouts.app')
@section('title', 'Register')
@section('styles')
    <style>
        .select2-search__field {
            height: 32px !important;
        }
    </style>
@endsection
@section('content')
    <div class="registerWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="col-lg-6 mx-auto px-0">
                        <div class="text-center pt-2">
                            <h2>Register</h2>
                            <p class="px-0 px-md-3 px-lg-5">
                                To begin your journey, sign up here and unlock endless possibilities
                            </p>
                        </div>
                        <div class="registerCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                            <div class="mt-3 mb-3">
                                @include('layouts.partial.show-error')
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1"> {{ __('First Name') }} </label>
                                <input class="form-control form-control-lg" name="first_name" type="text"
                                    placeholder="John" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1"> {{ __('Last Name') }} </label>
                                <input class="form-control form-control-lg" name="last_name" type="text"
                                    placeholder="Doe" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Username') }}</label>
                                <input class="form-control form-control-lg" name="user_name" type="text"
                                    value="{{ old('user_name') }}" placeholder="i.e. John_Doe466" required>
                                @error('user_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Email') }}</label>
                                <input class="form-control form-control-lg" type="email" name="email"
                                    value="{{ old('email') }}" placeholder="i.e. john@mail.com" required>
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Password</label>
                                <input class="form-control form-control-lg" name="password" type="password"
                                    placeholder="**********" required>
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Password Confirmation</label>
                                <input class="form-control form-control-lg" name="password_confirmation" type="password"
                                    placeholder="**********" required>
                                @error('password_confirmation')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group mb-3 position-relative">
                                <label class="mb-1 required">{{ __('Interest') }} <span>(from 1 to 5)</span></label>
                                {{--                            <div class="position-absolute arrow"><img src="assets/icon18.svg"></div> --}}
                                <select class="form-select" name="interests[]" multiple required>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                    @empty
                                        <option value="">No interest found</option>
                                    @endforelse
                                </select>
                                @error('interests')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                {{ __('Register') }}
                            </button>
                            <div class="linkText mt-3">
                                <span>Already have an account? <a class="text-decoration-none"
                                        href="{{ route('login') }}">{{ __('Login') }}</a></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".form-select").select2({
                placeholder: "Select an interest",
                allowClear: false
            });
        })
    </script>
@endsection
