@extends('layouts.dashboard')
@section('title', 'Search')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">
                <div class="dashboardCard border-0">
                    <div class="d-flex align-items-center gap-3 searchWrapper">
                        <div class="form-group flex-grow-1">
                            <input class="form-control form-control-lg w-100" type="email"
                                   placeholder="Search by name & interest">
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Filter Active
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="search-sugestion">Action</a></li>
                                <li><a class="dropdown-item" href="search-sugestion">Another action</a></li>
                                <li><a class="dropdown-item" href="search-sugestion">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 dashboardCard mt-4">
                    <div class="d-flex align-items-center flex-column justify-content-center noResult">
                        <img src="assets/emoji.svg">
                        <h2 class="mb-0 py-3">No Results Found</h2>
                        <p>You couldn’t find what you searched for.
                            Try searching again.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="bg-white p-4 dashboardCard ">
                    <h5>Interests</h5>
                    <div class="d-flex align-items-center gap-2 flex-wrap hashtag">
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                        <span># Happiness</span>
                        <span># Worklife</span>
                        <span># Education</span>
                        <span># Sports</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
