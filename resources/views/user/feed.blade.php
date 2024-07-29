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
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="innerCard p-3 bg-white">
                        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="avatar align-items-center gap-3 py-4">
                                <img class="rounded-circle" src="{{ asset('assets/profile.png') }}" alt="user image">
                                <input class="border-0 form-control" name="body" type="text"
                                    placeholder="What's on your mind?" required>
                            </div>
                            <div class="file-container bg-light"></div>
                            <div class="border-top d-flex align-items-center justify-content-between pt-3">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="text " role="button">
                                        <img class="img-upload img-fluid" src="{{ asset('assets/icon9.svg') }}"
                                            alt="pic image">
                                        <span>Photo</span>
                                        <input type="file" name="media[]" multiple hidden accept="image/*">
                                    </div>
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
                                <div class="avatar align-items-center gap-3 py-4">
                                    <img class="rounded-circle" src=" {{ asset($post->user->avatar_url) }}">
                                    <div class="details">
                                        <span class="d-block"> <a
                                                href="{{ route('user.feed.show', $post->user->user_name) }}"
                                                class="text-decoration-none">{{ $post->user->full_name }}</a></span>
                                        <span class="d-block">{{ $post->user->designation }}</span>
                                        <span class="d-block small">{{ $post->formatted_created_at }}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="detailsText">
                                {{ $post->body }}
                            </p>
                            <div class="post_gallery bg-light">
                                @forelse($post->media as $media)
                                    <div class="gallery__item gallery__item--hor">
                                        <img src="{{ $media->file_path }}" alt="Post image" class="img-fluid">
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
                            <h5 class="py-3">Comments:</h5>
                            <div class="comment-container-{{ $post->id }}">
                                @if ($post->comments_count > 0)
                                    @include('user.partials.comments', ['comments' => $post->comments])
                                @endif
                            </div>
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
                        {{ $feeds->links() }}
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
            <div class="col-lg-4 mb-3">
                <div class="bg-white p-4 dashboardCard ">
                    <h5>People you may know</h5>
                    <div class="list">
                        @forelse ($peoples as $user)
                            <div class="singlePerson py-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="avatarWrapper">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="image position-relative">
                                                <img src="assets/profile.png">
                                                <span class="position-absolute"></span>
                                            </div>
                                            <div class="details">
                                                <span class="d-block">{{ $user->full_name }}</span>
                                                <span class="d-block">{{ $user->designation }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttonWrapper">
                                        <div class="d-flex align-items-center gap-1 flex-column">
                                            <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                                class="text-decoration-none">
                                                <img src="assets/icon7.svg">
                                            </a>
                                            <span class="d-block">Join</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <h5 class="mb-0 mt-3">See more...</h5>
                </div>
                {{-- <div class="bg-white p-4 dashboardCard mt-4"> --}}
                {{--     <h5>Advertizement</h5> --}}
                {{--     <img class="img-fluid" src=" {{ asset('assets/feedImage.png') }}"> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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

        });
    </script>
    @include('event.partials.comment-scripts')
@endsection
