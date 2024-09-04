<script>
    let likedImage = "{{ asset('assets/icon12.svg') }}";
    let likeImage = "{{ asset('assets/like.svg') }}";
    let errorMessage = 'Error Occured! Please try again.';

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
                    errorNotificationSound();
                    return;
                }
                newNotificationSound();

                setTimeout(() => {
                    location.reload();
                }, 1000);

                // let postId = response.data.comment.post.id;
                // let commentContainer = $('.comment-container-' + postId);

                // // toastr.success(response.message);
                // let html = generateCommentHtml(response.data.comment);
                // // commentContainer.append(html);

                // let newComment = $(html).hide();
                // commentContainer.append(newComment);
                // newComment.slideDown('fast');

                // form.trigger('reset'); // Clear the form input fields

                // $("#comment_count_" + postId).html(response.data.current_comment_count);
            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.error('Error submitting comment:', error);
            }
        });
    });

    $('body').on('submit', '.ajax-reply-form', function(event) {
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
                newNotificationSound();

                console.log(response);

                setTimeout(() => {
                    location.reload();
                }, 1000);

                // let commentId = response.data.id;
                // let postId = response.data.post.id;
                // let replyContainer = $('.reply-container-' + commentId);

                // // toastr.success(response.message);
                // let html = generateCommentHtml(response.data.comment);
                // // replyContainer.append(html);

                // let newComment = $(html).hide();
                // replyContainer.append(newComment);
                // newComment.slideDown('fast');

                // form.trigger('reset'); // Clear the form input fields

                // $("#comment_count_" + commentId).html(response.data.post.id);
                // // Optionally, you can update the UI to show the new comment

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
                newNotificationSound();

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

</script>
