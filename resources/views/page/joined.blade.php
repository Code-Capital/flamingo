@extends('layouts.dashboard')
@section('title', 'Joined Pages')
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
                                <h3 class="marketHeading mb-0">Marketplace</h3>
                                <a class="btn btn-outline-primary px-4" href="createEvent">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($pages as $page)
                            <div class="col-lg-6 mb-3">
                                <a href="" class="text-decoration-none">
                                    <div class="marketPlaceCard p-3 d-flex align-items-start gap-4">
                                        <img src=" {{ $page->profile_image_url }} ">
                                        <div class="content w-100">
                                            <div class="d-flex align-items-center">
                                                <span>Starts from :{{ $page->formatted_start_date }} To:
                                                    {{ $page->formatted_end_date }} </span>
                                                @if ($user && $page->isMainOwner($user))
                                                    <div class="ms-auto dropdown">
                                                        <a class="btn" href="javascript:void(0)" role="button"
                                                            id="actionDropdowns" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            ...
                                                        </a>

                                                        <ul class="dropdown-menu" aria-labelledby="actionDropdowns">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('pages.edit', $page->slug) }}">Edit</a>
                                                            <li>
                                                                <form action="{{ route('pages.destroy', $page->slug) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>

                                            @if ($page->isPrivate())
                                                <div class="tags mb-2">
                                                    <span class="px-1 py-1 fw-bold bg-info text-white">Private</span>
                                                </div>
                                            @endif
                                            <a href="{{ route('join.page.show', $page->slug) }}" class="text-decoration-none">
                                                <h5 class="mb-1">{{ $page->name }}</h5>
                                                <p class="mb-2"> {{ limitString($page->description) }} </p>
                                                <div class="owners">
                                                    <div class="text mb-2">Other Owners</div>
                                                    <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                        @forelse ($page->users as $user)
                                                            <span class="px-2 py-1">{{ $user->full_name }}</span>
                                                        @empty
                                                            <span class="px-2 py-1">No other owners</span>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="interests">
                                                <div class="text mb-2">Interests</div>
                                                <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                    @forelse ($page->interests as $interest)
                                                        <span class="px-2 py-1">{{ $interest->name }}</span>
                                                    @empty
                                                        <span class="px-2 py-1">No interest</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <div class="paginator p-2">
                        {{ $pages->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
