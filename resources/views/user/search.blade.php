@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.dashboard')
@section('title', 'Search')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="dashboardCard border-0">
                    <form action="{{ route('search.users') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-4 form-group">
                                <select class="form-control interests" name="interests[]" multiple>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ in_array($interest->id, $selectedInterests) ? 'selected' : '' }}>
                                            {{ $interest->name }}</option>
                                    @empty
                                        <option value="">{{ __('Please Select Interests') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-3 form-group">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="{{ __('Search by name or email') }}" name="q"
                                    value="{{ request()->q }}">
                            </div>
                            <div class="col-lg-3 form-group">
                                <select class="form-control locations w-100" name="location">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ request()->location == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-2 form-group text-md-end">
                                <button class="btn btn-primary w-100 w-md-auto" type="submit" value="submit"
                                    name="find">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-white p-4 dashboardCard mt-4">
                    <div class="row mx-0">
                        @forelse($users as $user)
                            <div class="col-lg-4 mb-3">
                                <div class="eventCardInner p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src=" {{ $user->avatar_url }}" class="rounded-circle">
                                            <div>
                                                <span class="d-block">{{ $user->user_name }}</span>
                                                <span class="d-block">{{ $user->designation }}</span>
                                            </div>
                                        </div>
                                        @if (!$user->friends->contains(auth()->user()))
                                            <h6 class="mb-0">
                                                <a class="text-decoration-none add-friend" data-id="{{ $user->id }}"
                                                    href="javascript:void(0)">
                                                    {{ __('Add friend') }}
                                                </a>
                                            </h6>
                                        @else
                                            <h6 class="mb-0">
                                                <a class="text-decoration-none text-muted " href="javascript:void(0)">
                                                    Request sent
                                                </a>
                                            </h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    @if (!is_array($users) && !$users->isEmpty())
                        <div class="paginator">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.interests').select2({
                placeholder: "{{ __('Please Select Interests') }}",
                allowClear: true
            });

            $('.locations').select2({
                placeholder: "{{ __('Please Select location') }}",
                allowClear: true
            });
        });
    </script>
@endsection
