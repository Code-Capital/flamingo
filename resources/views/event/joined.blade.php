@extends('layouts.dashboard')
@section('title', 'Joined Events list')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <a class="btn btn-primary px-4" href="">Joined Events</a>
                                {{-- <a class="btn btn-outline-primary px-4" href="{{ route('events.create') }}">Create</a> --}}
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
            let body = $('body');
            let reportModal = $('#reportModal');
            let reportForm = $('#reportForm');

            body.on('click', '.event-report', function() {
                let id = $(this).data('event');
                let url = `{{ route('event.report', ':id') }}`.replace(':id', id);
                reportForm.attr('action', url);
                reportModal.modal('show');
            });

            body.on('submit', '#reportForm', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                let url = $(this).attr('action');

                // Call the reportPost function and handle the result
                reportEvent(url, formData)
                    .done(function(response) {
                        if (response.success) {
                            newNotificationSound();
                            toastr.success(response.message);
                            reportModal.modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            errorNotificationSound();
                            toastr.error(response.message);
                        }
                    })
                    .fail(function(xhr) {
                        errorNotificationSound();
                        let errorMessage = xhr.responseJSON.message ||
                            'An error occurred while processing your request.';
                        toastr.error(errorMessage);
                    });
            });
        });
    </script>
@endsection
