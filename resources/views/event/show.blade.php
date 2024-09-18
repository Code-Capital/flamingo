@extends('layouts.dashboard')
@section('title', 'Show Event Details')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 eventsInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">

                            <button class="nav-link active" id="Posts-tab" data-bs-toggle="tab" data-bs-target="#Posts"
                                type="button" role="tab" aria-controls="Posts" aria-selected="true">
                                <span class="px-1 px-md-2 px-lg-3">Posts</span>
                            </button>

                            <button class="nav-link" id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info"
                                type="button" role="tab" aria-controls="Info" aria-selected="true">
                                <span class="px-1 px-md-2 px-lg-3">About</span>
                            </button>

                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#Gallery"
                                type="button" role="tab" aria-controls="Gallery" aria-selected="false">
                                <span class="px-1 px-md-2 px-lg-3">Gallery</span>
                            </button>

                            @if ($user->isEventOwner($event))
                                <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                    type="button" role="tab" aria-controls="Friends" aria-selected="false">
                                    <span class="px-1 px-md-2 px-lg-3">Members</span>
                                </button>

                                <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                    type="button" role="tab" aria-controls="Requests" aria-selected="false">
                                    <span class="px-1 px-md-2 px-lg-3">Incoming Requests</span>
                                </button>

                                <button class="nav-link" id="Rejected-Requests-tab" data-bs-toggle="tab"
                                    data-bs-target="#Rejected-Requests" type="button" role="tab"
                                    aria-controls="Rejected-Requests" aria-selected="false">
                                    <span class="px-1 px-md-2 px-lg-3">Rejected Requests</span>
                                </button>
                            @endif

                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    @include('event.partials.posts-tab')

                    @include('event.partials.about-tab')

                    @include('event.partials.gallery-tab')

                    @if ($user->isEventOwner($event))
                        @include('event.partials.members-tab')

                        @include('event.partials.invites-tab')

                        @include('event.partials.rejected-tab')
                    @endif
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

            // let fileInput = $('input[type="file"]');


            // $('.img-upload').click(function() {
            //     fileInput.click();
            // });


            // fileInput.change(function(event) {
            //     const files = event.target.files;
            //     const container = $('.file-container');
            //     container.empty(); // Clear previous previews

            //     for (let i = 0; i < files.length; i++) {
            //         const file = files[i];

            //         // Check if the file type is an image
            //         if (file.type.startsWith('image/')) {
            //             const reader = new FileReader();
            //             reader.onload = function(e) {
            //                 const img = $('<img>').attr('src', e.target.result);
            //                 const fileItem = $('<div>').addClass('file-item p-1');
            //                 fileItem.append(img);
            //                 container.append(fileItem);
            //             };
            //             reader.readAsDataURL(file);
            //         } else {
            //             // Handle non-image files (e.g., display file name)
            //             const fileItem = $('<div>').addClass('file-item p-1');
            //             const fileType = $('<span>').text(file.type);
            //             const fileName = $('<span>').text(file.name);
            //             fileItem.append(fileType).append(fileName);
            //             container.append(fileItem);
            //         }
            //     }
            // });


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
        });
    </script>

    <script>
        Dropzone.autoDiscover = false;
        // Dropzone has been added as a global variable.
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var dropzone = new Dropzone("#upload-files", {
            url: "{{ route('files.upload') }}",
            paramName: "media",
            maxFiles: 5,
            maxFilesize: 5, // MB
            addRemoveLinks: true,
            autoProcessQueue: false,
            parallelUploads: 10,
            uploadMultiple: true,
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.heic', // Include HEIC format
            dictDefaultMessage: "Drag and drop files here or click to upload",
        });

        $('#postForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            loadingStart();
            let formData = new FormData(this);

            // Append Dropzone files
            dropzone.getAcceptedFiles().forEach(file => {
                formData.append('media[]', file);
            });

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    loadingStop();
                    if (response.success) {
                        newNotificationSound();
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        errorNotificationSound();
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    loadingStop();
                    errorNotificationSound();
                    let errorMessage = xhr.responseJSON.message;
                    toastr.error(errorMessage);
                }
            });
        });
    </script>
    @include('event.partials.comment-scripts')
@endsection
