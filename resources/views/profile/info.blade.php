@extends('layouts.dashboard')
@section('title', 'Profile info')
@section('styles')
    @include('layouts.datatable-styles')
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
                                    class="px-1 px-md-2 px-lg-3">{{ __('Info') }}</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#Photos"
                                type="button" role="tab" aria-controls="Photos" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">{{ __('Photos') }}</span>
                            </button>
                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">{{ __('Requests') }}</span>
                            </button>
                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">{{ __('Friends') }}</span>
                            </button>
                            <button class="nav-link" id="Blocked-tab" data-bs-toggle="tab" data-bs-target="#Blocked"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">{{ __('Blocked') }}</span>
                            </button>
                            <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab"
                                data-bs-target="#Subscription" type="button" role="tab" aria-controls="Subscription"
                                aria-selected="false"><span class="px-1 px-md-2 px-lg-3">{{ __('Subscription') }}</span>
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
    @if ($user->isSubscribed())
        @include('layouts.datatable-scripts')
        <script>
            $(document).ready(function() {
                let table = $('#usersTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('stripe.subscription.mine') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'sub_name',
                            name: 'sub_name'
                        },
                        {
                            data: 'stripe_id',
                            name: 'stripe_id'
                        },
                        {
                            data: 'stripe_status',
                            name: 'stripe_status'
                        },
                        {
                            data: 'ends_at',
                            name: 'ends_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        }
                    ]
                });

                let body = $('body');
                $('body').on('click', '.cancel', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('stripe.subscription.cancel', ':id') }}".replace(':id', id);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateSubscriptionStatus(url, table);
                        }
                    });
                })

                $('body').on('click', '.resume', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('stripe.subscription.resume', ':id') }}".replace(':id', id);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateSubscriptionStatus(url, table);
                        }
                    });
                })

                function updateSubscriptionStatus(url, table) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                newNotificationSound();
                                table.ajax.reload();
                                toastr.success(response.message);
                            } else {
                                errorNotificationSound();
                                toastr.error(response.message);
                            }
                        },
                        error: function(error) {
                            errorNotificationSound();
                            toastr.error(error.message);
                        }
                    });
                }
            });
        </script>
    @endif
    <script>
        $(".delete_btn").on("click", function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = "{{ route('profile.media.delete', ':id') }}".replace(':id', id);
            let element = $(this).parent();
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        // newNotificationSound();
                        toastr.success(response.message);
                        console.log(response.message);
                        $(`.galleryCard[data-id=${id}]`).remove();
                    } else {
                        // errorNotificationSound();
                        toastr.error(response.message);
                        console.log(response.message);
                    }

                    element.remove();
                },
                error: function(error) {
                    // errorNotificationSound();
                    toastr.error(error.message);
                    // console.log(error.message);
                }
            });
        });
    </script>
@endsection
