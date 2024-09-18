@extends('layouts.dashboard')
@section('title', 'Post Show')
@section('styles')

    <style>
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
                    @if ($post)
                        <div class="innerCard p-3 bg-white mt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatar align-items-center gap-3 py-4">
                                    <img class="rounded-circle" src=" {{ asset($post->user->avatar_url) }}">
                                    <div class="details">
                                        <span class="d-block"> <a
                                                href="{{ route('user.feed.show', $post->user->user_name) }}"
                                                class="text-decoration-none">
                                                @if ($post->user_id == $currentUser->id)
                                                    You
                                                @else
                                                    {{ $post->user->user_name }}
                                                @endif
                                            </a>
                                        </span>
                                        <span class="d-block">{{ $post->user->designation }}</span>
                                        <span class="d-block small">{{ $post->formatted_created_at }}</span>
                                    </div>
                                </div>
                                @if ($currentUser->id == $post->user_id)
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="btn" id="postActions"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('assets/dropdown.svg') }}" alt="dropdown">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="postActions">
                                            {{-- <li><a class="dropdown-item" href="#">Edit</a></li> --}}
                                            <li>
                                                <a class="dropdown-item post-destroy" data-post="{{ $post->id }}"
                                                    href="javascript::void(0)">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
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
                    @else
                        <x-no-data-found />
                    @endif
                </div>
            </div>
            <x-people-with-same-interest :peoples="$peoples" />
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let body = $('body');

            body.on('click', '.post-destroy', function() {
                let id = $(this).data('post');
                destroyPost(id);
            });
        });
    </script>
@endsection
