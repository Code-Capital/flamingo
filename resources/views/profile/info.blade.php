@extends('layouts.dashboard')
@section('title', 'Profile info')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 profileInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">Info</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#Photos"
                                type="button" role="tab" aria-controls="Photos" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Photos</span>
                            </button>
                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Requests</span>
                            </button>
                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Friends</span>
                            </button>
                            <button class="nav-link" id="Blocked-tab" data-bs-toggle="tab" data-bs-target="#Blocked"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Blocked</span>
                            </button>
                            <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab"
                                data-bs-target="#Subscription" type="button" role="tab" aria-controls="Subscription"
                                aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Subscription</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    @include('profile.tabs.info')

                    @include('profile.tabs.photos')

                    @include('profile.tabs.friends')

                    @include('profile.tabs.requests')

                    @include('profile.tabs.blocked')

                    @include('profile.tabs.subscription')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let body = $('body');

            body.on('click', '.accept', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'accepted', $(this));
            });

            body.on('click', '.reject', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'rejected', $(this));
            });

            body.on('click', '.block', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'blocked', $(this));
            });

            body.on('click', '.unfriend', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                unfriendUser(id, $(this));
            });

            function sendRequest(id, status, button) {
                $.ajax({
                    url: '{{ route('friend.request.status', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: {
                        "status": status,
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
                        toastr.error(error);
                    }
                });
            }

            $('#upload_new').on('change', function() {
                var fileInput = $(this)[0];

                if (fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select files to upload!'
                    });
                    return;
                }

                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                for (let i = 0; i < fileInput.files.length; i++) {
                    formData.append('media[]', fileInput.files[i]);
                }

                Swal.fire({
                    title: 'Uploading...',
                    html: '<progress id="progressBar" value="0" max="100" style="width: 100%;"></progress>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "{{ route('media.upload') }}", // Replace with your server-side upload URL
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = event.loaded / event.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('#progressBar').attr('value', percentComplete);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            Swal.close();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Files uploaded successfully!'
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: 'An error occurred while uploading the files.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'An error occurred while uploading the files.'
                        });
                    }
                });

            });
        });
    </script>
@endsection
