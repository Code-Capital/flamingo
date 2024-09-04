@extends('layouts.dashboard')
@section('title', 'Events list')
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
                                <h3 class="marketHeading mb-0">Posts List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Body</th>
                                    <th>media</th>
                                    <th>Published at</th>
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
            let table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                // orderable: false,
                ajax: "{{ route('posts.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'body',
                        name: 'body',
                        orderable: false
                    },
                    {
                        data: 'media',
                        name: 'media',
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
            $('body').on('click', '.delete', function() {
                let id = $(this).data('id');
                let url = "{{ route('posts.destroy', ':id') }}".replace(':id', id);
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
        });
    </script>
@endsection
