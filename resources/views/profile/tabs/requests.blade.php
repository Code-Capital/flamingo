<div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">Friend Requests <span>{{ $requests->count() }}</span>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            @forelse($requests as $user)
                <div class="col-lg-6 mb-3 friend-request-{{ $user->id }}">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $user->avatar_url }}" class="rounded-circle">
                                <div>
                                    <span class="d-block">{{ $user->user_name }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a class="text-decoration-none accept" data-id="{{ $user->id }}"
                                    href="javascript:void(0)">
                                    <img src="{{ asset('assets/done.svg') }} ">
                                </a>
                                <a class="text-decoration-none reject" data-id="{{ $user->id }}"
                                    href="javascript:void(0)">
                                    <img src="{{ asset('assets/trash.svg') }} " alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <x-no-data-found />
            @endforelse
        </div>
    </div>
</div>
