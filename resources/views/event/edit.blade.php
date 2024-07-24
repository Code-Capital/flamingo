@extends('layouts.dashboard')
@section('title', 'Edit Event')
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
                <form action="{{ route('events.update', $event->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                        <!-- Event Name and Event Location in a single row -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Event Title</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="title" value="{{ $event->title }}"
                                                placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Event Location</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="location"
                                                value="{{ $event->location }}" placeholder="Pakistan" required>
                                        </div>
                                    </div>
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Start Datetime and End Datetime in a single row -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Start Datetime</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="start_date" type="date"
                                                value="{{ $event->start_date }}" required>
                                        </div>
                                    </div>
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>End Datetime</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="end_date" type="date"
                                                value="{{ $event->end_date }}" required>
                                        </div>
                                    </div>
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Event Thumbanil -->
                            @php
                                $thumbnail = $event->thumbnail_url;
                                $required = $thumbnail == null ? true : false;
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src=" {{ $event->thumbnail_url }} " alt="">
                                    <label class="mb-1  {{ $thumbnail == null ? 'required' : '' }}">
                                        <span>Event Thumbanil</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="thumbnail" type="file" allow="images/*"
                                                @@required($required)>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Event Gallery -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-1">
                                        <span>Event Gallery</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="images[]" type="file"
                                                accept="image/png, image/jpeg, image/gif" multiple>
                                        </div>
                                    </div>
                                    @error('thumbnail')
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
                                            {{ $event->interests->contains($interest->id) ? 'selected' : '' }}>
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
                                <span>Event Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="4" name="description" class="w-100" required placeholder="Describe the event rules description">{{ $event->description }}</textarea>
                                </div>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Event Rules -->
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>Event Rule and Regulations <small class="text-muted">(optional)</small></span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="4" name="rules" class="w-100" placeholder="Describe the event rules">{{ $event->rules }}</textarea>
                                </div>
                            </div>
                            @error('rules')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Event Status -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Status</span>
                            </label>
                            <div class="d-flex align-items-center justify-content-between">
                                <select class="w-100 form-control form-select" name="status" required>
                                    <option value="">Please Select Status</option>
                                    <option value="draft" @if ($event->status == 'draft') selected @endif>Draft</option>
                                    <option value="published" @if ($event->status == 'published') selected @endif>Publish
                                    </option>
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
