{{-- JoinedUsers --}}
<div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">{{__("Members")}} <span>({{ $JoinedUsers->count() }})</span></div>
            </div>
        </div>
        <div class="row mx-0">
            @forelse ($JoinedUsers as $member)
                <div class="col-lg-6 mb-3 memeber-{{ $member->id }}">
                    <div class="eventCardInner p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset($member->avatar_url) }}" class="rounded-circle">
                                <div>
                                    <span class="d-block">{{ $member->full_name }}</span>
                                    <span class="d-block">{{ $member->designation }}</span>
                                </div>
                            </div>
                            <h6 class="mb-0">
                                @if ($page->isMainOwner($user))
                                    <a class="text-decoration-none remove-member" data-user="{{ $member->id }}"
                                        data-page="{{ $page->id }}"
                                        href="javascript:void(0)">{{ __('Remove') }}</a>
                                @endif
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
