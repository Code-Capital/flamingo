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
                                <h3 class="marketHeading mb-0">User List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <table id="usersTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscribed</th>
                                    <th>Created At</th>
                                    <th>Action</th>
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
                ajax: "{{ route('users.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'is_subscribed',
                        name: 'is_subscribed'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            let body = $('body');
            body.on('click', '.delete', function() {
                let id = $(this).data('id');
                let url = "{{ route('users.destroy', ':id') }}".replace(':id', id);
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
                        deleteRecord(url, table);
                    }
                });
            })

            body.on('click', '.block', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.users.block', ':id') }}".replace(':id', id);
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
                        updateUserStatus(url, table);
                    }
                });
            })

            body.on('click', '.unblock', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.users.unblock', ':id') }}".replace(':id', id);
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
                        updateUserStatus(url, table);
                    }
                });
            })

            body.on('change', '.toggle-subscribe', function() {
                loadingStart();
                var userId = $(this).data('id');
                var isSubscribed = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('admin.users.toggle.subscription') }}', // Your route for toggling subscription
                    method: 'POST',
                    data: {
                        id: userId,
                        is_subscribed: isSubscribed,
                        _token: '{{ csrf_token() }}' // CSRF token
                    },
                    success: function(response) {
                        loadingStop();
                        if (response.success) {
                            newNotificationSound();
                            toastr.success(response.message);
                        } else {
                            errorNotificationSound();
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        loadingStop();
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            function updateUserStatus(url, table) {
                $.ajax({
                    url: url,
                    type: "PUT",
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
