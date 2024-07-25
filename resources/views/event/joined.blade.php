@extends('layouts.dashboard')
@section('title', 'Joined Events list')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <a class="btn btn-primary px-4" href="">Joined Events</a>
                                {{-- <a class="btn btn-outline-primary px-4" href="{{ route('events.create') }}">Create</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($events as $event)
                            <x-event-card :event="$event" :user="$user" :url="route('joined.events.show', $event->slug)" />
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <div class="paginator bg-light p-2">
                        {{ $events->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
