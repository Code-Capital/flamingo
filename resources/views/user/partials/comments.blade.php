@foreach($comments as $comment)
    <div class="single-item mt-2">
        @if($comment->type = \App\CommentTypeEnum::Comment)
            <div class="commentbox p-3">
                <div class="d-flex align-items-start gap-2">
                    <img class="rounded-circle" src="{{ asset($comment->user->avatar_url) }}">
                    <div class="content">
                        <h5 class="mb-1">{{ $comment->user->full_name }}</h5>
                        <p class="mb-3">{{ $comment->body }}</p>
                        <div class="d-flex align-items-center gap-3">
                            <a class="text-decoration-none" href=""><span>{{ $comment->likes_count ?? 0 }}</span> Likes</a>
                            <a class="text-decoration-none" href="">Like</a>
                            <a class="text-decoration-none" href="">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($comment->type = \App\CommentTypeEnum::Reply)
            <div class="position-relative">
                <div class="position-absolute">
                    <img src="assets/commentImg.svg">
                </div>
            </div>
            <div class="reply p-3 ms-5 mt-4">
                <div class="d-flex align-items-start gap-2">
                    <img class="rounded-circle" src="assets/profile.png">
                    <div class="content">
                        <h5 class="mb-1">Muhammad Usama</h5>
                        <p class="mb-3">Thanks Musk!!</p>
                        <div class="d-flex align-items-center gap-3">
                            <a class="text-decoration-none" href="">Like</a>
                            <a class="text-decoration-none" href="">Reply</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($comment->replies->count())
            <div class="reply ms-5 mt-4">
                @include('user.partials.comments', ['comments' => $comment->comments])
            </div>
        @endif
    </div>
@endforeach

{{--@foreach($comments as $comment)--}}
{{--    <div class="commentbox p-3 mt-2">--}}
{{--        <div class="d-flex align-items-start gap-2">--}}
{{--            <img class="rounded-circle" src="{{ asset($comment->user->avatar_url) }}">--}}
{{--            <div class="content">--}}
{{--                <h5 class="mb-1">{{ $comment->user->full_name }}</h5>--}}
{{--                <p class="mb-3">{{ $comment->body }}</p>--}}
{{--                <div class="d-flex align-items-center gap-3">--}}
{{--                    <a class="text-decoration-none" href="javascript:void(0)"><span>{{ $comment->likes_count }}</span> Likes</a>--}}
{{--                    <a class="text-decoration-none" href="javascript:void(0)">Like</a>--}}
{{--                    <a class="text-decoration-none" href="javascript:void(0)">Reply</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @if($comment->replies->count())--}}
{{--        <div class="reply ms-5 mt-4">--}}
{{--            @include('user.partials.comments', ['comments' => $comment->comments])--}}
{{--        </div>--}}
{{--    @endif--}}
{{--@endforeach--}}