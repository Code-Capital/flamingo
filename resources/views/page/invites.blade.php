@extends('layouts.dashboard')
@section('title', 'Pages Invites')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0 mb-3">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <h3 class="marketHeading mb-0">Page Invites</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @forelse ($pages as $page)
                            <div class="col-lg-6 mb-3 invite-{{ $page->id }}">
                                <div class="eventCardInner p-3 friendRequest">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $page->profile_image_url }}" class="rounded-circle">
                                            <div>
                                                <span class="d-block">{{ $page->name }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 invite-received-{{ $page->id }}">
                                            <a class="text-decoration-none accept" data-page="{{ $page->id }}"
                                                href="javascript:void(0)">
                                                <img src="{{ asset('assets/done.svg') }}" alt="">
                                            </a>
                                            <a class="text-decoration-none reject" data-page="{{ $page->id }}"
                                                href="javascript:void(0)">
                                                <img src="{{ asset('assets/trash.svg') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                    <div class="paginator p-2">
                        {{ $pages->onEachSide(2)->links() }}
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

            body.on('click', '.accept', function() {
                let pageId = $(this).data('page');
                console.log(pageId);
                let url = "{{ route('page.invite.accept', ':id') }}".replace(':id', pageId);
                sendRequest(url);
            });

            body.on('click', '.reject', function() {
                let pageId = $(this).data('page');
                console.log(pageId);
                let url = "{{ route('page.invite.reject', ':id') }}".replace(':id', pageId);
                sendRequest(url);
            });

            function sendRequest(url) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            newNotificationSound();
                            toastr.success(response.message);
                            $('.invite-' + response.data.id).remove();
                        } else {
                            errorNotificationSound();
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        errorNotificationSound();
                        toastr.error(response.message);
                    }
                });
            }
        });
    </script>
@endsection
