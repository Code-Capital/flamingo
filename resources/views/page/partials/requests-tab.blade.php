<div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <div class="col-lg-12">
                <div class="heading pb-4">{{ __('Invite Member') }}</div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="dashboardCard border-0 mb-3">
                <form action="{{ route('search.users.page.owners') }}" id="searchOwners" method="POST">
                    @csrf
                    <input type="hidden" name="page_id" value="{{ $page->id }}">
                    <div class="row g-3 searchWrapper">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="{{ __('Search by name or email') }}" name="q" value="">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 d-flex align-items-center">
                            <button class="btn btn-primary w-100" type="submit" value="submit" name="search">
                                {{__("Search")}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="user-container row" id="searchOwnersContainer">
                <x-no-data-found />
            </div>
        </div>
    </div>
</div>
