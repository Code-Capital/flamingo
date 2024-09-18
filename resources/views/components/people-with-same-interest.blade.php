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
                                    <img src="{{ $user->avatar_url }}">
                                    @if ($user->active_status)
                                        <span class="position-absolute"></span>
                                    @endif
                                </div>
                                <div class="details">
                                    <span class="d-block">{{ $user->user_name }}</span>
                                    <span class="d-block">{{ $user->designation }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="buttonWrapper">
                            <div class="d-flex align-items-center gap-1 flex-column">
                                <small>
                                    <a class="add-friend small text-white bg-primary p-1 rounded text-decoration-none" data-id="3"
                                        href="javascript:void(0)">
                                        Add friend
                                    </a>
                                </small>
                                {{-- <a data-bs-toggle="modal" data-bs-target="#joinCommunity" class="text-decoration-none">
                                    <img src="{{ asset('assets/icon7.svg') }}" alt="join community">
                                </a>
                                <span class="d-block">Join</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-danger text-center">No Data Found</div>
            @endforelse
        </div>
        <h5 class="mb-0 mt-3"><a href="{{ route('people.with.same.interest') }}" class="text-decoration-none">See
                all...</a> </h5>
    </div>
    {{-- <div class="bg-white p-4 dashboardCard mt-4"> --}}
    {{--     <h5>Advertizement</h5> --}}
    {{--     <img class="img-fluid" src=" {{ asset('assets/feedImage.png') }}"> --}}
    {{-- </div> --}}
</div>
