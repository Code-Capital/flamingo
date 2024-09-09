@extends('layouts.dashboard')
@section('title', 'Edit Page')
@section('styles')
    <style>
        .select2-container .select2-selection--multiple,
        .select2-container .select2-selection {
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
            <div class="col-lg-12 mb-3 mx-auto">
                <form action="{{ route('pages.update', $page->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                        <!-- Event Name and Event Location in a single row -->
                        <div class="row ">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Page Name</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="name" value="{{ $page->name }}"
                                                placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Event Thumbanil -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1 ">
                                        <span>Profile Image</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="profile_image" type="file" accept="images/*">
                                        </div>
                                    </div>
                                    @error('profile_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Event Gallery -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1">
                                        <span>Cover Image</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="cover_image" type="file" accept="images/*">
                                        </div>
                                    </div>
                                    @error('cover_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Event Interests -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Interests</span>
                            </label>
                            <div class="d-flex align-items-center justify-content-between">
                                <select class="w-100 form-control form-select" name="interests[]" multiple required>
                                    @foreach ($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ $page->interests->contains($interest->id) ? 'selected' : '' }}>
                                            {{ $interest->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            @error('interests')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Event Description -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="4" name="description" class="w-100" required placeholder="Describe the event rules description">{{ $page->description }}</textarea>
                                </div>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Is Private Checkbox -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="is_private" value="1"
                                {{ $page->is_private ? 'checked' : '' }} id="private">
                            <label class="form-check-label" for="private">Is Private </label>
                        </div>

                        <!-- Create Button -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".form-select").select2({
                placeholder: "Select interests",
                allowClear: false,
            });
        })
    </script>
@endsection
