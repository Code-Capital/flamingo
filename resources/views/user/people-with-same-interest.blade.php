@extends('layouts.dashboard')
@section('title', 'People with same interest')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="heading pb-4">Peoples <span>({{ $peoples->count() }})</span></div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($peoples as $people)
                            <div class="col-lg-4 mb-3 friend-request-{{ $people->id }}">
                                <div class="eventCardInner p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset($people->avatar_url) }}" class="rounded-circle">
                                            <div>
                                                <span class="d-block"> {{ $people->full_name }} </span>
                                                <span class="d-block"> {{ $people->designation }} </span>
                                            </div>
                                        </div>
                                        <h6 class="mb-0">
                                            <a class="text-decoration-none add-friend" href="javascript:void(0)"
                                                data-id="{{ $people->id }}">Add Friends</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <div class="paginator">
                        {{ $peoples->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // let body = $('body');
            // body.on('click', '.unfriend', function(event) {
            //     event.preventDefault();
            //     let id = $(this).data('id');
            //     unfriendUser(id, $(this));
            // });

            //  Add friend in the common scripts file
        });
    </script>
@endsection
