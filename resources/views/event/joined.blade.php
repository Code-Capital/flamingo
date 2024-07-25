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
                            <div class="col-lg-6 mb-3">
                                <div class="announcementCard p-3 d-flex align-items-start gap-4">
                                    <img src="{{ $event->thumbnail_url }}">
                                    <div class="content w-100">
                                        <div class="d-flex align-items-center">
                                            <span> {{ $event->formatted_created_at }}</span>
                                        </div>
                                        <a href="{{ route('joined.events.show', $event->slug) }}" class="text-decoration-none">
                                            <h5 class="mb-1"> {{ $event->title }} </h5>
                                            <p class="mb-2"> {{ limitString($event->description, 50) }} </p>
                                            <div class="text mb-2"># Interests</div>
                                            <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                @forelse ($event->interests as $interest)
                                                    <span class="px-2 py-1">{{ $interest->name }}</span>
                                                @empty
                                                    <span class="px-2 py-1">No interests</span>
                                                @endforelse
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
