@extends('layouts.dashboard')
@section('title', 'Show Event Details')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 eventsInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">About</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#Photos"
                                type="button" role="tab" aria-controls="Photos" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Posts</span></button>
                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Members</span>
                            </button>
                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Invite Requests</span>
                            </button>
                            <button class="nav-link" id="Rejected-Requests-tab" data-bs-toggle="tab"
                                data-bs-target="#Rejected-Requests" type="button" role="tab"
                                aria-controls="Rejected-Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Rejected Requests</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="Info" role="tabpanel" aria-labelledby="Info-tab">
                        <div class="row mx-0">
                            <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
                                <div class="bg-white p-4 dashboardCard">
                                    <div class="aboutCard">
                                        <h6 class="mb-4">About</h6>
                                        <p>
                                            {{ $event->description }}
                                        </p>
                                        <div class="list py-3">
                                            <ul class="list-unstyled">
                                                <li class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('assets/tick.svg') }}" alt="">
                                                    <span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                        src="{{ asset('assets/tick.svg') }}">
                                                    <span>Lorem Ipsum is simply dummy text of the
                                                        printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                        src="{{ asset('assets/tick.svg') }}">
                                                    <span>Lorem Ipsum is simply dummy text of the
                                                        printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                        src="{{ asset('assets/tick.svg') }}">
                                                    <span>Lorem Ipsum is simply dummy text of the
                                                        printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                        src="{{ asset('assets/tick.svg') }}">
                                                    <span>Lorem Ipsum is simply dummy text of the
                                                        printing </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h6 class="mb-4">Rules and Regulations</h6>
                                        <p>
                                            {{ $event->rules }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 ps-0 ps-md-0 ps-lg-2 pe-0 pe-md-0 pe-lg-auto mb-3">
                                <div class="bg-white p-4 dashboardCard ">
                                    <h5>People you may know</h5>
                                    <div class="list">
                                        <div class="singlePerson py-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="avatarWrapper">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="image position-relative">
                                                            <img src=" {{ asset('assets/profile.png') }}" alt="">
                                                            <span class="position-absolute"></span>
                                                        </div>

                                                        <div class="details">
                                                            <span class="d-block">Muhammad Asad</span>
                                                            <span class="d-block">Designer</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <div class="d-flex align-items-center gap-1 flex-column">
                                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                            class="text-decoration-none">
                                                            <img src=" {{ asset('assets/icon7.svg') }}" alt="">
                                                        </a>
                                                        <span class="d-block">Join</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="singlePerson py-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="avatarWrapper">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="image position-relative">
                                                            <img src=" {{ asset('assets/profile.png') }}" alt="">
                                                            <span class="position-absolute"></span>
                                                        </div>

                                                        <div class="details">
                                                            <span class="d-block">Muhammad Asad</span>
                                                            <span class="d-block">Designer</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <div class="d-flex align-items-center gap-1 flex-column">
                                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                            class="text-decoration-none">
                                                            <img src=" {{ asset('assets/icon7.svg') }}" alt="">
                                                        </a>
                                                        <span class="d-block">Join</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0 mt-3">See more...</h5>


                                </div>
                                <div class="bg-white p-4 dashboardCard mt-4">
                                    <h5>Advertizement</h5>
                                    <img class="img-fluid" src="{{ asset('assets/feedImage.png') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Photos" role="tabpanel" aria-labelledby="Photos-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="gallery">
                                <h5 class="gallery-heading pb-4 mb-0">Posts</h5>
                                <div class="d-flex align-items-center pt-4 gap-4 flex-wrap">
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="{{ asset('assets/galleryImage.png') }}">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Members
                                        <span>({{ $event->acceptedMembers()->count() }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                @forelse ($event->acceptedMembers as $user)
                                    <div class="col-lg-6 mb-3 friend-request-{{ $user->id }}">
                                        <div class="eventCardInner p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $user->avatar_url }} " class="rounded-circle">
                                                    <div>
                                                        <span class="d-block"> {{ $user->full_name }} </span>
                                                        <span class="d-block"> {{ $user->designation }} </span>
                                                    </div>
                                                </div>
                                                <h6 class="mb-0">
                                                    <a class="text-decoration-none remove-request"
                                                        href="javascript:void(0)"
                                                        data-id="{{ $user->id }}">Remove</a>
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
                    <div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Requests to join
                                        <span>({{ $event->pendingRequests->count() }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 pending-request-container">
                                @forelse ($event->pendingRequests as $user)
                                    <div class="col-lg-6 mb-3  friend-request-{{ $user->id }}">
                                        <div class="eventCardInner p-3 friendRequest">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $user->avatar_url }} " class="rounded-circle">
                                                    <div>
                                                        <span class="d-block"> {{ $user->full_name }} </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-decoration-none accept-request"
                                                        data-id="{{ $user->id }}" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/done.svg') }}">
                                                    </a>
                                                    <a class="text-decoration-none reject-request"
                                                        data-id="{{ $user->id }}" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-no-data-found />
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Rejected-Requests" role="tabpanel"
                        aria-labelledby="Reject-Requests-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Reject Requests
                                        <span>({{ $event->rejectedRequests->count() }})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0 rejected-request-container">
                                @forelse ($event->rejectedRequests as $user)
                                    <div class="col-lg-6 mb-3  friend-request-{{ $user->id }}">
                                        <div class="eventCardInner p-3 friendRequest">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $user->avatar_url }}" alt="user avatar"
                                                        class="rounded-circle">
                                                    <div>
                                                        <span class="d-block">Muhammad Asad</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-decoration-none accept-request"
                                                        data-id="{{ $user->id }}" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/done.svg') }}">
                                                    </a>
                                                    {{-- <a class="text-decoration-none remove-request"
                                                        data-id="{{ $user->id }}" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                    </a> --}}
                                                </div>
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
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            let eventId = "{{ $event->id }}";
            let body = $('body');
            let rejectedRequestContainer = $('.rejected-request-container');
            let pendingRequestContainer = $('.pending-request-container');

            body.on('click', '.remove-request', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                removeMember(id, $(this));
            });

            body.on('click', '.accept-request', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'accepted', $(this));
            });

            body.on('click', '.reject-request', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'rejected', $(this));
            });

            function removeMember(id, container) {
                var url = "{{ route('events.remove.member', ['event' => ':eventId', 'user' => ':userId']) }}";
                url = url.replace(':eventId', eventId).replace(':userId', id);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success == false) {
                            toastr.error(response.message);
                            errorNotificationSound();
                            return false;
                        }

                        toastr.success(response.message);
                        newNotificationSound();
                        container.closest('.friend-request-' + id).fadeOut(300)
                            .hide(); // Hide the parent element of the button

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            }

            function sendRequest(id, status, container) {
                var url = "{{ route('events.status.update', ['event' => ':eventId', 'user' => ':userId']) }}";
                url = url.replace(':eventId', eventId).replace(':userId', id);
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success == false) {
                            toastr.error(response.message);
                            errorNotificationSound();
                            return false;
                        }

                        toastr.success(response.message);
                        newNotificationSound();
                        container.closest('.friend-request-' + id).fadeOut(300)
                            .hide(); // Hide the parent element of the button

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                });
            }

            // function createRequestHtml(user) {
            //     return `
        //         <div class="col-lg-6 mb-3 friend-request-${user.id}">
        //             <div class="eventCardInner p-3 friendRequest">
        //                 <div class="d-flex align-items-center justify-content-between">
        //                     <div class="d-flex align-items-center gap-3">
        //                         <img src="${user.avatar_url}" class="rounded-circle">
        //                         <div>
        //                             <span class="d-block">${user.full_name}</span>
        //                         </div>
        //                     </div>
        //                     <div class="d-flex align-items-center gap-2">
        //                         <a class="text-decoration-none accept-request" data-id="${user.id}" href="javascript:void(0)">
        //                             <img src="/assets/done.svg">
        //                         </a>
        //                         <a class="text-decoration-none reject-request" data-id="${user.id}" href="javascript:void(0)">
        //                             <img src="/assets/trash.svg" alt="">
        //                         </a>
        //                     </div>
        //                 </div>
        //             </div>
        //         </div>
        //     `;
            // }

        });
    </script>
@endsection
