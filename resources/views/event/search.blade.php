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
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="dashboardCard border-0 mb-3">
                    <form action="{{ route('search.events') }}" method="GET">
                        <div class="row gap-3 searchWrapper">
                            <div class="col-5 form-group flex-grow-1">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="Search by title, slug" name="q" value="{{ request()->q }}">
                            </div>
                            <div class="col-5 form-group flex-grow-1">
                                <input class="form-control form-control-lg w-100" type="search"
                                    placeholder="Search by location" name="location" value="{{ request()->location }}">
                            </div>
                            <div class="col-5 form-group flex-grow-1">
                                <select class="form-control w-100" name="interests[]" multiple>
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

                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <a class="btn btn-outline-primary px-4" href="{{ route('events.create') }}">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($events as $event)
                            <div class="col-lg-6 mb-3 ">
                                <div class="announcementCard p-3 d-flex align-items-stretch gap-4">
                                    <img src="{{ $event->thumbnail_url }}">
                                    <div class="content">
                                        <span>
                                            {{ $event->formatted_created_at }}
                                            <div class="tags"> Creator: {{ $event->owner->full_name }} </div>
                                        </span>
                                        <h5 class="mb-1"> {{ $event->title }} </h5>
                                        <p class="mb-2"> {{ limitString($event->description, 50) }} </p>
                                        <div class="text mb-2"># Interests</div>
                                        <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                            @forelse ($event->interests as $interest)
                                                <span class="px-2 py-1">{{ $interest->name }}</span>
                                            @empty
                                                <span class="px-2 py-1">No interests</span>
                                            @endforelse
                                        </div>

                                        @if (!$event->allMembers()->where('user_id', $user->id)->exists())
                                            <div class="d-flex align-items-center p-3">
                                                <a class="join-event" data-id="{{ $event->id }}"
                                                    href="javascript:void(0)">
                                                    <img src="{{ asset('assets/done.svg') }}" alt="join event"
                                                        style="height: 30px; width:30px; object-fit: contain">
                                                </a>
                                            </div>
                                        @else
                                            <div class="tags d-flex align-items-center pt-2">
                                                <span class="px-2 py-1 bg-success text-white">Request sent</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse

                    </div>
                    <div class="paginator bg-light p-2">
                        {{ $events->onEachSide(2)->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.searchWrapper select').select2({
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
    </script>
@endsection
