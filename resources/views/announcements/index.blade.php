@extends('layouts.dashboard')
@section('title', 'Announcements')
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
                                <div class="heading pb-4">{{ __('Announcements') }} </div>
                                <a class="btn btn-outline-primary px-4" href="{{ route('announcements.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($announcements as $announcement)
                            <div class="col-lg-6 mb-3">
                                <div class="announcementCard p-3 d-flex align-items-start gap-4">
                                    <img src="{{ asset($announcement->thumbnail_url) }}">
                                    <div class="content w-100">
                                        <div class="d-flex align-items-center">
                                            <span> {{ $announcement->formatted_created_at }}
                                                ({{ $announcement->getStatus() }})
                                            </span>
                                            <div class="ms-auto dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    ...
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('announcements.edit', $announcement->slug) }}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('announcements.destroy', $announcement->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Delete') }}</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h5 class="mb-1"> {{ $announcement->title }} </h5>
                                        <p class="mb-2"> {{ $announcement->body }} </p>
                                    </div>
                                </div>
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
