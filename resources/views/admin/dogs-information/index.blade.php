@extends('layouts.dashboard')
@section('title', 'Dogs Information list')
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
                                <h3 class="marketHeading mb-0">Information List</h3>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add Information
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <select id="filter" class="form-select mb-3">
                                <option value="">All</option>
                                <option value="dog_breed">Dog Breed</option>
                                <option value="dog_gender">Dog Gender</option>
                                <option value="kennel_club">Kennel Club</option>
                                <option value="dog_working_club">Dog Working Club</option>
                                <option value="dog_withers_height"> Dog Withers Height</option>
                                <option value="weight">Weight</option>
                                <option value="size">Size</option>
                                <option value="castrated">Castrated</option>
                                <option value="target">Targeting</option>
                                <option value="furr">Fur</option>
                                <option value="drawing">Drawing</option>
                                <option value="hills">Hills</option>
                                <!-- Add more options as needed -->
                            </select>

                        </div>
                    </div>
                    <div class="row mx-0">
                        <table id="usersTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Info</th>
                                    <th>Created At</th>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dogs-information.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="type" id="type" class="form form-select" required>
                                <option value="dog_breed">Dog Breed</option>
                                <option value="dog_gender">Dog Gender</option>
                                <option value="kennel_club">Kennel Club</option>
                                <option value="dog_working_club">Dog Working Club</option>
                                <option value="dog_withers_height"> Dog Withers Height</option>
                                <option value="weight">Weight</option>
                                <option value="size">Size</option>
                                <option value="castrated">Castrated</option>
                                <option value="target">Targeting</option>
                                <option value="furr">Fur</option>
                                <option value="drawing">Drawing</option>
                                <option value="hills">Hills</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" name="info" required id="info" class="form-control"
                                placeholder="Please Enter Information">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- <div class="modal fade bd-example-modal-lg" id="faceModal">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dogs-information.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="type" id="" class="form-select" required>
                                <option value="">hello</option>
                                <option value="">hello</option>
                                <option value="">hello</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="info" required id="info" class="form-control"
                                placeholder="Please Enter Information">
                        </div>
                    </div>
                    <input type="hidden" name="action" id="actionInput" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger reject-btn">Reject</button>
                        <button type="button" class="btn btn-warning approve-btn">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
    @include('layouts.datatable-scripts')
    <script>
        $(document).ready(function() {




            let table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('dogs-information.index') }}",
                    data: function(d) {
                        d.filter = $('#filter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'info',
                        name: 'info'
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

            $('#filter').change(function() {
                table.ajax.reload();
            });



            let body = $('body');
            body.on('click', '.delete-info', function() {
                let id = $(this).data('id');
                let url = "{{ route('dogs-information.destroy', ':id') }}".replace(':id', id);
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
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    table.ajax.reload();
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(error) {
                                toastr.error(error.message);
                            }
                        });
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
