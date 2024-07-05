@extends('layouts.dashboard')
@section('title', 'All notifications')
@section('styles')
@endsection
@section('content')
    <h1>Notifications</h1>

    <ul>
        @foreach($notifications as $notification)
            <li>
                {{ $notification->data['message'] }}
                <br>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
@endsection
@section('scripts')
@endsection
