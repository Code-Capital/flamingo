@extends('layouts.dashboard')
@section('title', 'People with same interest')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
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
            let body = $('body');

            body.on('click', '.unfriend', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                unfriendUser(id, $(this));
            });

            function unfriendUser(id, button) {
                $.ajax({
                    url: '{{ route('friend.remove', ':id') }}'.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success == false) {
                            toastr.error(response.message);
                            errorNotificationSound();
                            return false;
                        }

                        toastr.success(response.message);
                        newNotificationSound();
                        button.closest('.friend-request-' + id).fadeOut(300)
                            .hide(); // Hide the parent element of the button
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        console.log(error);
                        errorNotificationSound();
                    }
                });
            }

        });
    </script>
@endsection
