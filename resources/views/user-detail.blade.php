@extends('layouts.dashboard')
@section('title', 'User Profile')
@section('content')
    <div class="container">
        <div class="profile-detail-info mt-5">
            <div class="row g-4">
                <div class="col-12 text-center">
                    @if ($user->avatar_url != '')
                        <img src="{{ $user->avatar_url }}" class="profile-image" alt="Profile Picture">
                    @else
                        <img src="{{ asset('assets/avatar.jpg') }}" class="profile-image" alt="Profile Picture">
                    @endif
                </div>
                {{-- <div class="col-12 d-flex align-items-center gap-4 justify-content-end">
                    <h6 class="fw-bold m-0 text-secondary">Account Status:</h6>
                    <span class="badge rounded-pill {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div> --}}
                <div class="col-md-6">
                    <h6 class="fw-bold">First Name:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->first_name }}">
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Last Name:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->last_name }}">
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">User Name:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->user_name }}">
                </div>
                {{-- <div class="col-md-6">
                    <h6 class="fw-bold">Email:</h6>
                    <input type="email" disabled class="form-control" value="{{ $user->email }}">
                </div> --}}
                <div class="col-md-6">
                    <h6 class="fw-bold">Gender:</h6>
                    <input type="email" disabled class="form-control" value="{{ $user->gender }}">
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Age:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->age }}">
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Country:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->country?->name }}">
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">County:</h6>
                    <input type="text" disabled class="form-control" value="{{ $user->county?->name }}">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
