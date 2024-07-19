@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.dashboard')
@section('title', 'Search')
@section('styles')
    <style>
        .select2-container .select2-selection--multiple {
            width: 100% !important;
            min-height: 44px !important;
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            line-height: 25px !important;
            font-size: 16px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="dashboardCard border-0">
                    <form action="{{ route('search.users') }}" method="GET">
                        <div class="d-flex align-items-center gap-3 searchWrapper">
                            <div class="col-5 form-group flex-grow-1">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="Search by name & username" name="q" value="{{ request()->q }}">
                            </div>
                            <div class="col-5 form-group flex-grow-1">
                                <select class="form-control form-control-lg w-100" name="interests[]" multiple>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ in_array($interest->id, $selectedInterests) ? 'selected' : '' }}>
                                            {{ $interest->name }}</option>
                                    @empty
                                        <option value="">Please Select Interests</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-2 form-group flex-grow-1">
                                <button class="btn btn-primary" type="submit" value="submit" name="find">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="bg-white p-4 dashboardCard mt-4">
                    <div class="row mx-0">
                        @forelse($users as $user)
                            <div class="col-lg-6 mb-3">
                                <div class="eventCardInner p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src=" {{ $user->avatar_url }}" class="rounded-circle">
                                            <div>
                                                <span class="d-block">{{ $user->full_name }}</span>
                                                <span class="d-block">{{ $user->designation }}</span>
                                            </div>
                                        </div>
                                        @unless (auth()->user()->isFriendsWith($user))
                                            <h6 class="mb-0">
                                                <a class="text-decoration-none add-friend" data-id="{{ $user->id }}"
                                                    href="javascript:void(0)">
                                                    Add friend
                                                </a>
                                            </h6>
                                        @endunless
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>

                </div>
            </div>

            {{-- <div class="col-lg-4 mb-3"> --}}
            {{--     <div class="bg-white p-4 dashboardCard "> --}}
            {{--         <h5>Interests</h5> --}}
            {{--         <div class="d-flex align-items-center gap-2 flex-wrap hashtag"> --}}
            {{--             @forelse($interests as $interest ) --}}
            {{--                 <span># {{ $interest->name }}</span> --}}
            {{--             @empty --}}
            {{--             @endforelse --}}
            {{--         </div> --}}
            {{--     </div> --}}
            {{-- </div> --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.searchWrapper select').select2({
                placeholder: "Please Select Interests",
                allowClear: true
            });
            let body = $('body');

            body.on('click', '.add-friend', function() {
                let name = $(this).data('id');
                let url = '{{ route('add-friend', ':slug') }}'.replace(':slug', name);
                this.remove();
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            newNotificationSound();
                        } else {
                            toastr.error(response.message);
                            errorNotificationSound();
                        }
                    }
                });
            });

        });
    </script>
@endsection
