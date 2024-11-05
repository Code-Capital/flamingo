@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.dashboard')
@section('title', 'Search')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="dashboardCard border-0">
                    <form action="{{ route('search.users') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-4 outlined_select2">
                                <select class="form-select interests" name="interests[]" multiple>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ in_array($interest->id, $selectedInterests) ? 'selected' : '' }}>
                                            {{ $interest->name }}</option>
                                    @empty
                                        <option value="">{{ __('Please Select Interests') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-lg-3 form-group">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="{{ __('Search by name or email') }}" name="q"
                                    value="{{ request()->q }}">
                            </div>
                            <div class="col-lg-3 outlined_select2">
                                <select class="form-select locations w-100" name="location">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ request()->location == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-2 form-group text-md-end">
                                <button class="btn btn-primary w-100 w-md-auto" type="submit" value="submit"
                                    name="find">
                                    Search
                                </button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">More Filters</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Breed of dog</span>
                                                    </label>

                                                    <select class="w-100 form-select" name="dog_breed" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'dog_breed') as $row)
                                                            <option @selected(request()->has('dog_breed') && request()->dog_breed == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Dog's gender</span>
                                                    </label>

                                                    <select class="form-select" name="dog_gender" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'dog_gender') as $row)
                                                            <option @selected(request()->has('dog_gender') && request()->dog_gender == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Kennel club</span>
                                                    </label>

                                                    <select class="w-100 form-select" name="kennel_club" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'kennel_club') as $row)
                                                            <option @selected(request()->has('kennel_club') && request()->kennel_club == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Working dog club
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="dog_working_club"
                                                        id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'dog_working_club') as $row)
                                                            <option @selected(request()->has('dog_working_club') && request()->dog_working_club == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Height at the withers
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="dog_withers_height"
                                                        id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'dog_withers_height') as $row)
                                                            <option @selected(request()->has('dog_withers_height') && request()->dog_withers_height == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>
                                                            Weight
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="weight" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'weight') as $row)
                                                            <option @selected(request()->has('weight') && request()->weight == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Size
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="size" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'size') as $row)
                                                            <option @selected(request()->has('size') && request()->size == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Castrated
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="castrated" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'castrated') as $row)
                                                            <option @selected(request()->has('castrated') && request()->castrated == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Targeting
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="target" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'target') as $row)
                                                            <option @selected(request()->has('target') && request()->target == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Fur
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="furr" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'furr') as $row)
                                                            <option @selected(request()->has('furr') && request()->furr == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Drawing
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="drawing" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'drawing') as $row)
                                                            <option @selected(request()->has('drawing') && request()->drawing == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Hills
                                                        </span>
                                                    </label>

                                                    <select class="w-100 form-select" name="hills" id="">
                                                        <option value="" selected disabled>Please Select</option>
                                                        @foreach ($dogs_information->where('type', 'hills') as $row)
                                                            <option @selected(request()->has('hills') && request()->hills == $row->info ? true : false)
                                                                value="{{ $row->info }}">
                                                                {{ $row->info }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-between">
                                <a class="modal-title fw-medium text-decoration-none" href="javascript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Apply
                                    More
                                    Filters?</a>

                                <a class="text-danger text-decoration-none" href="{{ route('search.users') }}">Clear all
                                    Filters</a>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="bg-white p-4 dashboardCard mt-4">
                    <div class="row mx-0">
                        @forelse($users as $user)
                            <div class="col-lg-4 mb-3">
                                <div class="eventCardInner p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <a class="fw-bolder d-flex align-items-center gap-3" href="{{ route('user.users.show', $user->id) }}">
                                                <img src=" {{ $user->avatar_url }}" class="rounded-circle">
                                                <div>

                                                    <span class="d-block">{{ $user->user_name }}</span>
                                                    <span class="d-block">{{ $user->designation }}</span>
                                                </div>
                                            </a>

                                        </div>
                                        @if (!$user->friends->contains(auth()->user()))
                                            <h6 class="mb-0">
                                                <a class="text-decoration-none add-friend" data-id="{{ $user->id }}"
                                                    href="javascript:void(0)">
                                                    {{ __('Add friend') }}
                                                </a>
                                            </h6>
                                        @else
                                            <h6 class="mb-0">
                                                <a class="text-decoration-none text-muted " href="javascript:void(0)">
                                                    Request sent
                                                </a>
                                            </h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    @if (!is_array($users) && !$users->isEmpty())
                        <div class="paginator">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.interests').select2({
                placeholder: "{{ __('select interests') }}",
                allowClear: true
            });

            $('.locations').select2({
                placeholder: "{{ __('select location') }}",
                allowClear: true
            });
        });
    </script>
@endsection
