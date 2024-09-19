<div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">{{ __('Friends') }} <span>{{ $friends->count() }}</span></div>
            </div>
        </div>
        <div class="row mx-0">
            @forelse($friends as $friend)
                <div class="col-lg-6 mb-3 friend-request-{{ $friend->id }}">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $friend->avatar_url }}" class="rounded-circle">
                                <div>
                                    <span class="d-block">{{ $friend->full_name }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a class="text-decoration-none block" data-id="{{ $friend->id }}" tooltip="Block"
                                    href="javascript:void(0)">
                                    <img src="{{ asset('assets/secure.svg') }} ">
                                </a>
                                <a class="text-decoration-none unfriend" data-id="{{ $friend->id }}"
                                    tooltip="Unfriend" href="javascript:void(0)">
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
