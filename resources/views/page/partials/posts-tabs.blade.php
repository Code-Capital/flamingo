<div class="tab-pane fade active show" id="Posts" role="tabpanel" aria-labelledby="Posts-tab">
    <div class="row mx-0">
        <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
            <div class="bg-white p-4 dashboardCard">

                @if ($isOwnerOrMember)
                    <div class="innerCard p-3 bg-white">
                        <form action="{{ route('pages.post.store', $page->id) }}" method="POST"
                            enctype="multipart/form-data" id="postForm">
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
                                    <div class="text" role="button">
                                        <div class="d-flex align-items-center gap-1">
                                            <img src=" {{ asset('assets/icon11.svg') }} ">
                                            <select class="form-select border-0 p-1 custom-select-styling"
                                                role="button" name="is_private">
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
                @endif

                @forelse($posts as $post)
                    <div class="innerCard p-3 bg-white mt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="avatar align-items-center gap-3 py-4">
                                <img class="rounded-circle" src=" {{ asset($post->user->avatar_url) }}">
                                <div class="details">
                                    <span class="d-block"> <a
                                            href="{{ route('user.feed.show', $post->user->user_name) }}"
                                            class="text-decoration-none">{{ $post->user->user_name }}</a></span>
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
                        @if ($isOwnerOrMember)
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
                                        <span
                                            id="comment_count_{{ $post->id }}">{{ $post->comments_count }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($isOwnerOrMember)
                        <div class="comments">
                            <h5 class="py-3">Comments:</h5>
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
                                    @include('user.partials.comments', [
                                        'comments' => $post->comments,
                                    ])
                                @endif
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="bg-white p-4 dashboardCard mt-4">
                        <div class="d-flex align-items-center flex-column justify-content-center noResult">
                            <img src="{{ asset('assets/emoji.svg') }}" alt="no post found">
                            <h2 class="mb-0 py-3">No Posts Found</h2>
                            <p>There are no posts available to show</p>
                        </div>
                    </div>
                @endforelse

                <div class="mt-3 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
