{{-- JoinedUsers --}}
<div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">Members <span>(16)</span></div>
            </div>
        </div>
        <div class="row mx-0">
            @forelse ($JoinedUsers as $user)
                <div class="col-lg-6 mb-3">
                    <div class="eventCardInner p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="assets/profile.png" class="rounded-circle">
                                <div>
                                    <span class="d-block">{{ $user->full_name }}</span>
                                    <span class="d-block">{{ $user->designation }}</span>
                                </div>
                            </div>
                            <h6 class="mb-0"><a class="text-decoration-none" href="">Remove</a>
                            </h6>
                        </div>
                    </div>
                </div>
            @empty
                <x-no-data-found />
            @endforelse
            <div class="paginator">
                {{ $JoinedUsers->links() }}
            </div>

        </div>
    </div>
</div>
