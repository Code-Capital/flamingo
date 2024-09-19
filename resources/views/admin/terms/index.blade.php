@extends('layouts.dashboard')
@section('title', 'Terms & Conditions')
@section('styles')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-3">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0 mb-3">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <h3 class="marketHeading mb-0">Terms & Conditions</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 col-12 w-100">
                        <form action="{{ route('terms-conditions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="profileForm">
                                <!-- Event Description -->
                                <div class="form-group mb-3">
                                    {{-- <label class="mb-1 required">
                                        <span>Event Description</span>
                                    </label> --}}
                                    <textarea rows="4" id="summernote" name="terms" required>{!! old('terms', $terms->content ?? '') !!}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/lang/summernote-ko-KR.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200, // set the height of the editor
                toolbar: [
                    // ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    // ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
