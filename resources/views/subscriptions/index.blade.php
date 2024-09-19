@extends('layouts.dashboard')
@section('title', 'Users list')
@section('styles')
    @include('layouts.datatable-styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0 mb-3">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <h3 class="marketHeading mb-0">User {{ __('Subscriptions') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <table id="usersTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('User name') }}</th>
                                    <th>{{ __('Subscription') }} name</th>
                                    <th>Stripe id</th>
                                    <th>Stripe status</th>
                                    <th>{{ __('Ends at') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop through the users data --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('layouts.datatable-scripts')
    <script>
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('subscriptions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'sub_name',
                        name: 'sub_name'
                    },
                    {
                        data: 'stripe_id',
                        name: 'stripe_id'
                    },
                    {
                        data: 'stripe_status',
                        name: 'stripe_status'
                    },
                    {
                        data: 'ends_at',
                        name: 'ends_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            let body = $('body');
            $('body').on('click', '.cancel', function() {
                let id = $(this).data('id');
                let url = "{{ route('stripe.subscription.cancel', ':id') }}".replace(':id', id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateSubscriptionStatus(url, table);
                    }
                });
            })

            $('body').on('click', '.resume', function() {
                let id = $(this).data('id');
                let url = "{{ route('stripe.subscription.resume', ':id') }}".replace(':id', id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateSubscriptionStatus(url, table);
                    }
                });
            })

            function updateSubscriptionStatus(url, table) {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            newNotificationSound();
                            table.ajax.reload();
                            toastr.success(response.message);
                        } else {
                            errorNotificationSound();
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        errorNotificationSound();
                        toastr.error(error.message);
                    }
                });
            }
        });
    </script>
@endsection
