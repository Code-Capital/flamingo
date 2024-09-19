@extends('layouts.dashboard')
@section('title', 'Show pages')
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
                            <button class="nav-link " id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">About</span></button>

                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Members</span>
                            </button>
                            @if ($page->isMainOwner($user))
                                <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                    type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                        class="px-1 px-md-2 px-lg-3">Send Invite {{ __('Requests') }}</span>
                                </button>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">

                    @include('page.partials.posts-tabs')

                    @include('page.partials.about-tab')

                    @include('page.partials.memebers-tab')

                    @include('page.partials.requests-tab')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let body = $('body');
            $('#searchOwners').submit(function(e) {
                loadingStart();
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var type = form.attr('method');
                var data = form.serialize();
                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response) {
                        loadingStop();
                        $('#searchOwnersContainer').html(response);
                    },
                    error: function(error) {
                        loadingStop();
                        console.log(error);
                    }
                });
            });

            body.on('click', '.send-invitation', function(e) {
                e.preventDefault();

                let btn = $(this);
                let userId = $(this).data('user');
                let pageId = $(this).data('page');
                let url = "{{ route('page.invite.sent') }}"
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: csrf,
                        user_id: userId,
                        page_id: pageId
                    },
                    success: function(response) {
                        btn.closest('.invite-send-' + userId).remove();

                        console.log(response);

                        if (response.success) {
                            toastr.success(response.message);
                            newNotificationSound();
                        } else {
                            toastr.error(response.message ||
                                'An error occurred while sending the invitation');
                            errorNotificationSound();
                        }
                    },
                    error: function(xhr) {
                        // Get error message from response or use a fallback message
                        const errorMessage = xhr.responseJSON?.message ||
                            'Something went wrong';
                        toastr.error(errorMessage);
                        errorNotificationSound();
                    }
                });
            });

            body.on('click', '.remove-member', function(e) {
                e.preventDefault();
                let userId = $(this).data('user');
                let pageId = $(this).data('page');
                let url = "{{ route('page.member.remove', ':id') }}".replace(':id', pageId);
                let csrf = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: csrf,
                        user_id: userId,
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            newNotificationSound();
                            toastr.success(response.message);
                            // setTimeout(() => {
                            //     location.reload();
                            // }, 1000);
                        } else {
                            toastr.error(response.message);
                            errorNotificationSound();
                        }
                    },
                    error: function(error) {
                        console.log(error.message);
                        toastr.success(error.message);
                        errorNotificationSound();
                    }
                });
            });

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
            dictDefaultMessage: "{{ __('Drag and drop files here or click to upload') }}",
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
@endsection
