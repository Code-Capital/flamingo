@extends('layouts.dashboard')
@section('title', 'Events list friends')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="heading pb-4">{{ __('Friends') }} <span>({{ $friends->count() }})</span></div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($friends as $friend)
                            <div class="col-lg-4 mb-3 friend-request-{{ $friend->id }}">
                                <div class="eventCardInner p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset($friend->avatar_url) }}" class="rounded-circle">
                                            <div>
                                                <a href="{{ route('user.users.show', $friend->id) }}">
                                                    <span class="d-block"> {{ $friend->user_name }} </span>
                                                </a>

                                                <span class="d-block"> {{ $friend->designation }} </span>
                                            </div>
                                        </div>
                                        <h6 class="mb-0">
                                            <a class="text-decoration-none unfriend" href="javascript:void(0)"
                                                data-id="{{ $friend->id }}">{{ __('Remove') }}</a>
                                        </h6>
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
    <script>
        $(document).ready(function() {
            let body = $('body');

            // add unfriend code in common scripts file
        });
    </script>
@endsection
