@extends('layouts.dashboard')
@section('title', 'User feed')
@section('styles')

    <style>
        .file-container {
            max-height: 250px;
            overflow: auto;
        }

        .post_gallery {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-auto-rows: 200px;
            grid-auto-flow: dense;
            max-width: 1200px;
            margin: 10px auto;
            padding: 0 10px;
            max-height: 50vh;
            overflow-y: scroll;
        }

        .gallery__item {
            align-items: center;
            display: flex;
            justify-content: center;
            object-fit: contain;
        }

        .gallery__item>img {
            height: 100%;
            object-fit: cover;
            width: 100%;
        }

        .gallery__item--hor {
            grid-column: span 2;
        }
    </style>
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="innerCard p-3 bg-white">
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                            @csrf
                            <div class="avatar align-items-center gap-3 py-4">
                                <img class="rounded-circle" src="{{ $user->avatar_url }}" alt="user image">
                                <input class="border-0 form-control" name="body" type="text"
                                    placeholder="What's on your mind?" required>
                            </div>

                            <div class="dz-default dz-message dropzone" id="upload-files"></div>
                            <div class="help-block with-errors dropzone-error text-danger"></div>

                            <div class="file-container bg-light"></div>
                            <div class="border-top d-flex align-items-center justify-content-between pt-3">
                                <div class="d-flex align-items-center gap-4">
                                    {{-- <div class="text " role="button">
                                        <img class="img-upload img-fluid" src="{{ asset('assets/icon9.svg') }}"
                                            alt="pic image">
                                        <span>Photo</span>
                                        <input type="file" name="media[]" multiple hidden accept="image/*">
                                    </div> --}}
                                    <div class="text" role="button">
                                        <div class="d-flex align-items-center gap-1">
                                            <img src=" {{ asset('assets/icon11.svg') }} ">
                                            <select class="form-select border-0 p-1 custom-select-styling" role="button"
                                                name="is_private">
                                                <option value="0">Public</option>
                                                <option value="1">Private</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-primary px-4" type="submit">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @forelse($feeds as $post)
                        <div class="innerCard p-3 bg-white mt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatar align-items-center gap   -3 py-4">
                                    <img class="rounded-circle" src=" {{ asset($post->user->avatar_url) }}">
                                    <div class="details p-2">
                                        <span class="d-block"> <a
                                                href="{{ route('user.feed.show', $post->user->user_name) }}"
                                                class="text-decoration-none">
                                                {{ $post->user->user_name }}
                                                {{-- @if ($post->user_id == $currentUser->id)
                                                    <small
                                                        class="badge bg-secondary small fw-lighter text-white px-1 py-1">Author</small>
                                                @endif --}}

                                            </a>
                                        </span>
                                        <span class="d-block">{{ $post->user->designation }}</span>
                                        <span class="d-block small">{{ $post->formatted_created_at }}</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="btn" id="postActions" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ asset('assets/dropdown.svg') }}" alt="dropdown">
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="postActions">
                                        @if ($currentUser->id == $post->user_id)
                                            <li>
                                                <a class="dropdown-item post-destroy" data-post="{{ $post->id }}"
                                                    href="javascript::void(0)">Delete</a>
                                            </li>
                                        @else
                                            <li><a class="dropdown-item post-report" data-post="{{ $post->id }}"
                                                    href="javascript:void(0)">Report</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <p class="detailsText">
                                {{ $post->body }}
                            </p>
                            <div class="post_gallery bg-light">
                                @forelse($post->media as $media)
                                    <div class="gallery__item gallery__item--hor">
                                        @if ($media->file_type == 'video')
                                            <video width="100%" controls>
                                                <source src="{{ $media->file_path }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ $media->file_path }}" alt="Post image" class="img-fluid">
                                        @endif
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="likes align-items-center justify-content-between pt-4">
                                <div class="d-flex align-items-center gap-4 ">
                                    <form action="{{ route('post.like-or-unlike', $post->id) }}"
                                        id="likeForm-{{ $post->id }}" class="ajax-like-form" method="post">
                                        @csrf
                                        <button class="btn" type="submit">
                                            {{-- <img src="{{ asset('assets/like.svg') }}" alt="like"> --}}
                                            <img src="{{ asset($post->likedByCurrentUser() ? 'assets/icon12.svg' : 'assets/like.svg') }}"
                                                alt="like">
                                            <span id="like_count_{{ $post->id }}">{{ $post->likes_count }}</span>
                                        </button>
                                    </form>

                                    <div class="text d-flex align-items-center gap-3 show-comment-form"
                                        data-id="{{ $post->id }}" role="button">
                                        <img src="{{ asset('assets/icon13.svg') }} " alt="comment">
                                        <span id="comment_count_{{ $post->id }}">{{ $post->comments_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments">
                            @if ($post->comments_count > 0)
                                <h5 class="py-3">Comments:</h5>
                            @endif
                            <div class="comment-input-{{ $post->id }} bg-light p-2 mt-2 d-none">
                                <form id="commentForm-{{ $post->id }}"
                                    action="{{ route('comment.store', $post->id) }}" method="POST"
                                    class="d-flex align-items-center gap-3 ajax-comment-form">
                                    @csrf
                                    <textarea class="form-control me-2" name="body" placeholder="please write comment"></textarea>
                                    <button class="btn" type="submit">
                                        <img src="{{ asset('assets/send.svg') }}" alt="Send" class="img-fluid" />
                                    </button>
                                </form>
                            </div>
                            <div class="comment-container-{{ $post->id }}">
                                @if ($post->comments_count > 0)
                                    @include('user.partials.comments', ['comments' => $post->comments])
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="bg-white p-4 dashboardCard mt-4">
                            <div class="d-flex align-items-center flex-column justify-content-center noResult">
                                <img src="{{ asset('assets/emoji.svg') }}" alt="no post found">
                                <h2 class="mb-0 py-3">No Posts Found</h2>
                                <p>There are no posts available to show</p>
                            </div>
                        </div>
                    @endforelse

                    <div class="paginator ms-auto mt-4">
                        {{ $feeds->onEachSide(2)->links() }}
                    </div>
                </div>

                {{-- Show private account notification --}}
                @if ($user->isPrivate())
                    <div class="bg-white p-4 dashboardCard mt-4">
                        <div class="d-flex align-items-center flex-column justify-content-center noResult">
                            <img src="{{ asset('assets/secure.svg') }}">
                            <h2 class="mb-0 py-3">This Account is Private</h2>
                            <p>Follow this account to see their Friends and Photos</p>
                        </div>
                    </div>
                @endif
            </div>
            <x-people-with-same-interest :peoples="$peoples" />
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let body = $('body');
            let reportModal = $('#reportModal');
            let reportForm = $('#reportForm');

            body.on('click', '.post-destroy', function() {
                let id = $(this).data('post');
                destroyPost(id);
            });

            body.on('click', '.post-report', function() {
                let id = $(this).data('post');
                let url = `{{ route('post.report', ':id') }}`.replace(':id', id);
                reportForm.attr('action', url);
                reportModal.modal('show');
            });

            body.on('submit', '#reportForm', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                let url = $(this).attr('action');

                // Call the reportPost function and handle the result
                sendReport(url, formData)
                    .done(function(response) {
                        if (response.success) {
                            newNotificationSound();
                            toastr.success(response.message);
                            reportModal.modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            errorNotificationSound();
                            toastr.error(response.message);
                        }
                    })
                    .fail(function(xhr) {
                        errorNotificationSound();
                        let errorMessage = xhr.responseJSON.message ||
                            'An error occurred while processing your request.';
                        toastr.error(errorMessage);
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
@endsection
