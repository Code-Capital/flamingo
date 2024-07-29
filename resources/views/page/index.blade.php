@extends('layouts.dashboard')
@section('title', 'Pages')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0 mb-3">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <h3 class="marketHeading mb-0">My Pages</h3>
                                <a class="btn btn-outline-primary px-4" href="{{ route('pages.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($pages as $page)
                            <div class="col-lg-6 mb-3">
                                <a href="shop" class="text-decoration-none">
                                    <div class="marketPlaceCard p-3 d-flex align-items-start gap-4">
                                        <img src="assets/galleryImage.png">
                                        <div class="content">
                                            <span> {{ $page->formatted_created_at }} </span>
                                            <h5 class="mb-1">{{ $page->name }}</h5>
                                            <p class="mb-2"> {{ $page->description }} </p>
                                            <div class="text mb-2">Owners</div>
                                            <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                @forelse ($page->users as $user)
                                                    <span class="px-2 py-1">{{ $user->full_name }}</span>
                                                @empty
                                                @endforelse
                                                <span class="px-2 py-1">Happiness</span>
                                                <span class="px-2 py-1">Worklife</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
