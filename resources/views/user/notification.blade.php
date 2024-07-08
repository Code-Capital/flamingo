@extends('layouts.dashboard')
@section('title', 'Notifications')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="notification">
                        <div class="d-flex align-items-center justify-content-between pb-4 ">
                            <button class="btn btn-primary">Notifications</button>
                            <button class="btn btn-outline-primary">Mark all as read</button>
                        </div>
                        @forelse($allNotifications as $notification)
                            <div class="d-flex align-items-center justify-content-between singleMessage py-4 border px-4">
                                <div class="d-flex align-items-start gap-3 ">
                                    <img class="rounded-circle" src="{{ asset('assets/profile.png') }} ">
                                    @php
                                        $dataArray = json_decode($notification->data, true);
                                    @endphp
                                    <p class="mb-0">{{ $dataArray['message'] ?? '' }}</p>
                                </div>
                                @if(empty($notification->read_at))
                                    <a class="text-decoration-none" href="javasctipt:void(0)">
                                        <img src="{{ asset('assets/cross.svg') }}" alt="Cross image">
                                    </a>
                                @endif
                            </div>
                        @empty
                            <x-no-data-found/>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
