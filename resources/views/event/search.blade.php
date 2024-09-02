@extends('layouts.dashboard')
@section('title', 'Events list')
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
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                {{-- search form --}}
                <div class="dashboardCard border-0">
                    <form action="{{ route('search.events') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4 col-lg-4 form-group">
                                <select class="form-control interests w-100" name="interests[]" multiple>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ in_array($interest->id, $selectedInterests) ? 'selected' : '' }}>
                                            {{ $interest->name }}</option>
                                    @empty
                                        <option value="">Please Select Interests</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-4 col-lg-3 form-group">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="Search by name & title" name="q" value="{{ request()->q }}">
                            </div>
                            <div class="col-md-4 col-lg-3 form-group">
                                <select class="form-control locations w-100" name="location">
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
                        </div>
                    </form>
                </div>

                <div class="bg-white p-4 dashboardCard mt-4">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <a class="btn btn-outline-primary px-4" href="{{ route('events.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($events as $event)
                            <x-event-card :event="$event" :user="$user" :url="route('joined.events.show', $event->slug)" />
                        @empty
                            <x-no-data-found />
                        @endforelse

                    </div>
                    <div class="paginator p-2">
                        {{ $events->onEachSide(2)->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.interests').select2({
                placeholder: "Please Select Interests",
                allowClear: true
            });

            $('.locations').select2({
                placeholder: "Please Select Interests",
                allowClear: true
            });

            $(document).on('click', '.join-event', function() {
                let eventId = $(this).data('id');
                joinEvent(eventId);
            });

            function joinEvent(eventId) {
                $.ajax({
                    url: "{{ route('event.join', ':id') }}".replace(':id', eventId),
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            newNotificationSound();
                        } else {
                            toastr.error(response.message);
                            errorNotificationSound();
                        }

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        toastr.error('Something went wrong');
                        errorNotificationSound();
                    }
                });
            }
        });
    </script>
@endsection
