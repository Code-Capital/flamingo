@extends('layouts.dashboard')
@section('title', 'Notifications')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="notification">
                        <div class="d-flex align-items-center justify-content-between pb-4 ">
                            <button class="btn btn-primary">Notifications</button>
                            <a href={{ route('read.all.notification') }} class="btn btn-outline-primary">Mark all as read</a>
                        </div>
                        @forelse($allNotifications as $notification)
                            @php
                                $user = $notification->notifiable; // This fetches the user or notifiable entity
                            @endphp
                            @php
                                $dataArray = !is_array($notification->data)
                                    ? json_decode($notification->data, true)
                                    : $notification->data;
                                $creatorUser = \App\Models\User::find($dataArray['user_id']);
                            @endphp
                            <div class="d-flex align-items-center justify-content-between singleMessage py-4 border px-4">
                                <div class="d-flex align-items-start gap-3 ">
                                    <img class="rounded-circle" src="{{ $user->avatar_url }} " alt="profile image">
                                    <p class="mb-0">{!! $dataArray['message'] ?? '' !!}</p>
                                </div>
                                @if (empty($notification->read_at))
                                    <a class="text-decoration-none"
                                        href="{{ route('notification.read', $notification->id) }}">
                                        <img src="{{ asset('assets/cross.svg') }}" alt="Cross image">
                                    </a>
                                @endif
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
