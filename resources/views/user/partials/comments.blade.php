@foreach ($comments as $comment)
    <div class="single-item mt-2">
        @if ($comment->type == \App\Enums\CommentTypeEnum::COMMENT->value)
            <div class="commentbox p-3">
                <div class="d-flex align-items-start gap-2">
                    <img class="rounded-circle" src="{{ asset($comment->user->avatar_url) }}" alt="user image">
                    <div class="content">
                        <h5 class="mb-1">{{ $comment->user->full_name }}</h5>
                        <p class="mb-3">{{ $comment->body }}</p>
                        <div class=" show-comment-form-{{ $comment->id }} d-flex align-items-center gap-3">
                            <a class="text-decoration-none"
                                href="javascript:void(0)"><span>{{ $comment->likes_count ?? 0 }}</span> Likes</a>
                            <a class="text-decoration-none" href="javascript:void(0)">Like</a>
                            <a class="text-decoration-none show-reply-form" data-id="{{ $comment->id }}"
                                href="javascript:void(0)">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reply-container-{{ $comment->id }}">
                <div class="reply-input-{{ $comment->id }} offset-1 bg-light p-2 mt-2 d-none">
                    <form id="commentForm-{{ $comment->id }}" action="{{ route('reply.store', $comment->id) }}"
                        method="POST" class="d-flex align-items-center gap-3 ajax-reply-form">
                        @csrf
                        <textarea class="form-control me-2" name="body"></textarea>
                        <button class="btn" type="submit">
                            <img src="{{ asset('assets/send.svg') }}" alt="Send" class="img-fluid" />
                        </button>
                    </form>
                </div>
            </div>

            {{-- @elseif($comment->type == \App\Enums\CommentTypeEnum::REPLY->value) --}}
            @forelse ($comment->replies as $comment)
                <div class="position-relative">
                    <div class="position-absolute">
                        <img src="{{ asset('assets/commentImg.svg') }}" alt="reply image">
                    </div>
                </div>
                <div class="reply p-3 ms-5 mt-4">
                    <div class="d-flex align-items-start gap-2">
                        <img class="rounded-circle" src="assets/profile.png">
                        <div class="content">
                            <h5 class="mb-1">{{ $comment->user->full_name }}</h5>
                            <p class="mb-3">{{ $comment->body }}</p>
                            {{-- <div class=" show-comment-form-{{ $comment->id }} d-flex align-items-center gap-3">
                                <a class="text-decoration-none" href="javascript:void(0)">Like</a>
                                <a class="text-decoration-none show-reply-form" data-id="{{ $comment->id }}"
                                    href="javascript:void(0)">Reply</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="reply-container-{{ $comment->id }}">
                    <div class="reply-input-{{ $comment->id }} offset-1 bg-light p-2 mt-2 d-none">
                        <form id="commentForm-{{ $comment->id }}" action="{{ route('reply.store', $comment->id) }}"
                            method="POST" class="d-flex align-items-center gap-3 ajax-reply-form">
                            @csrf
                            <textarea class="form-control me-2" name="body"></textarea>
                            <button class="btn" type="submit">
                                <img src="{{ asset('assets/send.svg') }}" alt="Send" class="img-fluid" />
                            </button>
                        </form>
                    </div>
                </div> --}}
            @empty
            @endforelse
        @endif

        {{-- @if ($comment->replies->count())
            <div class="reply ms-5 mt-4">
                @include('user.partials.comments', ['comments' => $comment->comments])
            </div>
        @endif --}}
    </div>
@endforeach
