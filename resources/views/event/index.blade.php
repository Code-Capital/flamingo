@extends('layouts.dashboard')
@section('title', 'Events list')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <a class="btn btn-primary px-4" href="javascript:void(0)">{{ __('My events') }}</a>
                                @if ($remianingEventCount > 0)
                                    <a class="btn btn-outline-primary px-4" href="{{ route('events.create') }}">Create</a>
                                @else
                                    <a class="btn btn-outline-primary px-4" href="{{ route('pricing') }}">Please
                                        Subscribe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($events as $event)
                            <x-event-card :event="$event" :user="$user" />
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <div class="paginator p-2">
                        {{ $events->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('event.partials.scripts')
@endsection
