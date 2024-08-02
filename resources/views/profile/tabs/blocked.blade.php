<div class="tab-pane fade" id="Blocked" role="tabpanel" aria-labelledby="blocked-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">Blocked Users <span>{{ $blockedUsers->count() }}</span>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            @forelse($blockedUsers as $blockUser)
                <div class="col-lg-6 mb-3 friend-request-{{ $blockUser->id }}">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $blockUser->avatar_url }}" class="rounded-circle">
                                <div>
                                    <span class="d-block">{{ $blockUser->full_name }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a class="text-decoration-none accept" data-id="{{ $blockUser->id }}" tooltip="Unblock"
                                    href="javascript:void(0)">
                                    <img src="{{ asset('assets/done.svg') }} ">
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
