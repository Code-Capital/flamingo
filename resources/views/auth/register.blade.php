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
                                <label class="mb-1"> {{ __('First name') }} </label>
                                <input class="form-control form-control-lg" name="first_name" type="text"
                                    placeholder="John" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1"> {{ __('Last name') }} </label>
                                <input class="form-control form-control-lg" name="last_name" type="text"
                                    placeholder="Doe" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('User name') }}</label>
                                <input class="form-control form-control-lg" name="user_name" type="text"
                                    value="{{ old('user_name') }}" placeholder="i.e. John_Doe466" required>
                                @error('user_name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1"> {{ __('Age') }} </label>
                                <input class="form-control form-control-lg" name="age" type="number" placeholder="18"
                                    value="{{ old('age') }}" required>
                                @error('age')
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
                            {{-- <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Profile type') }}</label>
                                <select name="is_private" id="is_private" class="form-control form-select">
                                    <option value="">{{ __('Please select profile type') }}</option>
                                    <option value="0">{{ __('Public') }}</option>
                                    <option value="1">{{ __('Private') }}</option>
                                </select>
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Gender') }}</label>
                                <select name="gender" id="gender" class="form-control form-select">
                                    <option value="">{{ __('Please select gender') }}</option>
                                    <option value="male">{{ __('Male') }}</option>
                                    <option value="female">{{ __('Female') }}</option>
                                    <option value="other">{{ __('Other') }}</option>
                                </select>
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Password') }}</label>
                                <input class="form-control form-control-lg" name="password" type="password"
                                    placeholder="**********" required>
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">{{ __('Password') }} {{ __(' Confirmation') }} </label>
                                <input class="form-control form-control-lg" name="password_confirmation" type="password"
                                    placeholder="**********" required>
                                @error('password_confirmation')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label class="mb-1 required">{{ __('Interests') }} <span>(from 1 to 5)</span></label>
                                <select class="form-select" name="interests[]" id="interests" multiple required>
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

                            <div class="form-group mb-3 position-relative">
                                <label class="mb-1 required">{{ __('Country') }}</label>
                                <select class="form-select form-control" name="country_id" required>
                                    <option value="">{{ __('Please select country') }} </option>
                                    @forelse($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @empty
                                        <option value="">{{ __('No country found') }}</option>
                                    @endforelse
                                </select>
                                @error('country_id')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label class="mb-1 required">{{ __('County') }}</label>
                                <select class="form-select form-control" name="county_id" required>
                                    <option value="">{{ __('Please select county') }} </option>
                                    @forelse($counties as $county)
                                        <option value="{{ $county->id }}">{{ $county->name }}</option>
                                    @empty
                                        <option value="">{{ __('No county found') }}</option>
                                    @endforelse
                                </select>
                                @error('county_id')
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
            $("#interests").select2({
                placeholder: "Select an interest",
                allowClear: false
            });
        })
    </script>
@endsection
