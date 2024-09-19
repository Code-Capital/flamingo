<div class="tab-pane fade" id="Rejected-Requests" role="tabpanel" aria-labelledby="Reject-Requests-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">Reject {{ __('Requests') }}
                    <span>({{ $event->rejectedRequests->count() }})</span>
                </div>
            </div>
        </div>
        <div class="row mx-0 rejected-request-container">
            @forelse ($event->rejectedRequests as $user)
                <div class="col-lg-6 mb-3  friend-request-{{ $user->id }}">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $user->avatar_url }}" alt="user avatar" class="rounded-circle">
                                <div>
                                    <span class="d-block">Muhammad Asad</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a class="text-decoration-none accept-request" data-id="{{ $user->id }}"
                                    href="javascript:void(0)">
                                    <img src="{{ asset('assets/done.svg') }}">
                                </a>
                                {{-- <a class="text-decoration-none remove-request"
                                                        data-id="{{ $user->id }}" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                    </a> --}}
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
