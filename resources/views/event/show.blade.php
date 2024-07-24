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

                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false">
                                <span class="px-1 px-md-2 px-lg-3">Members</span>
                            </button>

                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false">
                                <span class="px-1 px-md-2 px-lg-3">Invite Requests</span>
                            </button>

                            <button class="nav-link" id="Rejected-Requests-tab" data-bs-toggle="tab"
                                data-bs-target="#Rejected-Requests" type="button" role="tab"
                                aria-controls="Rejected-Requests" aria-selected="false">
                                <span class="px-1 px-md-2 px-lg-3">Rejected Requests</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    @include('event.partials.posts-tab')

                    @include('event.partials.about-tab')

                    @include('event.partials.gallery-tab')

                    @include('event.partials.members-tab')

                    @include('event.partials.invites-tab')

                    @include('event.partials.rejected-tab')
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

            let fileInput = $('input[type="file"]');
            let likedImage = "{{ asset('assets/icon12.svg') }}";
            let likeImage = "{{ asset('assets/like.svg') }}";
            let errorMessage = 'Error Occured! Please try again.';

            $('.img-upload').click(function() {
                fileInput.click();
            });


            fileInput.change(function(event) {
                const files = event.target.files;
                const container = $('.file-container');
                container.empty(); // Clear previous previews

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Check if the file type is an image
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = $('<img>').attr('src', e.target.result);
                            const fileItem = $('<div>').addClass('file-item p-1');
                            fileItem.append(img);
                            container.append(fileItem);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Handle non-image files (e.g., display file name)
                        const fileItem = $('<div>').addClass('file-item p-1');
                        const fileType = $('<span>').text(file.type);
                        const fileName = $('<span>').text(file.name);
                        fileItem.append(fileType).append(fileName);
                        container.append(fileItem);
                    }
                }
            });


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

            $('body').on('submit', '.ajax-comment-form', function(event) {
                event.preventDefault(); // Prevent the default form submission

                let form = $(this);
                let formData = form.serialize(); // Serialize the form data
                let actionUrl = form.attr('action'); // Get the form action URL

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the success response
                        if (response.success == false) {
                            toastr.error(response.message);
                            return;
                        }
                        let postId = response.data.comment.post.id;
                        let commentContainer = $('.comment-container-' + postId);

                        // toastr.success(response.message);
                        let html = generateCommentHtml(response.data.comment);
                        // commentContainer.append(html);

                        let newComment = $(html).hide();
                        commentContainer.append(newComment);
                        newComment.slideDown('fast');

                        form.trigger('reset'); // Clear the form input fields

                        $("#comment_count_" + postId).html(response.data.current_comment_count);
                        // Optionally, you can update the UI to show the new comment

                        newNotificationSound();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.error('Error submitting comment:', error);
                    }
                });
            });

            function generateCommentHtml(comment) {
                return `
                    <div class="commentbox p-3 mt-2">
                        <div class="d-flex align-items-start gap-2">
                            <img class="rounded-circle" src="${comment.user.avatar_url}">
                            <div class="content">
                                <h5 class="mb-1">${comment.user.full_name}</h5>
                                <p class="mb-3">${comment.body}</p>
                                <div class="d-flex align-items-center gap-3">
                                    <a class="text-decoration-none" href="javascript:void(0)"><span>${comment.likes_count}</span> Likes</a>
                                    <a class="text-decoration-none" href="javascript:void(0)">Like</a>
                                    <a class="text-decoration-none" href="javascript:void(0)">Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            $('body').on('submit', '.ajax-like-form', function(event) {
                event.preventDefault(); // Prevent the default form submission

                let form = $(this);
                let formData = form.serialize(); // Serialize the form data
                let actionUrl = form.attr('action'); // Get the form action URL

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the success response
                        if (response.success == false) {
                            toastr.error(response.message ?? errorMessage);
                            errorNotificationSound();
                            return;
                        }
                        // toastr.success(response.message);

                        if (response.data.likeCount == 0) {
                            $("#likeForm-" + response.data.post.id + " button img")
                                .fadeOut('fast', function() {
                                    $(this).attr('src', likeImage).fadeIn('fast');
                                });
                        } else {
                            $("#likeForm-" + response.data.post.id + " button img")
                                .fadeOut('fast', function() {
                                    $(this).attr('src', likedImage).fadeIn('fast');
                                });
                        }


                        $("#like_count_" + response.data.post.id).html(response.data.likeCount);
                        newNotificationSound();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        errorNotificationSound()
                        console.error('Error submitting comment:', error);
                    }
                });
            });

            $('.show-comment-form').click(function() {
                let id = $(this).data('id');
                let commentInput = $('.comment-input-' + id);

                if (commentInput.hasClass('d-none')) {
                    commentInput.removeClass('d-none').hide().slideDown(300); // Adjust speed here
                } else {
                    commentInput.slideUp(300, function() {
                        $(this).addClass('d-none');
                    });
                }
            });

            $('.show-reply-form').click(function() {
                let id = $(this).data('id');
                let replyInput = $('.reply-input-' + id);

                if (replyInput.hasClass('d-none')) {
                    replyInput.removeClass('d-none').hide().slideDown(300); // Adjust speed here
                } else {
                    replyInput.slideUp(300, function() {
                        $(this).addClass('d-none');
                    });
                }
            });

        });
    </script>
@endsection
