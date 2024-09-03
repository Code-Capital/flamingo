@extends('layouts.dashboard')
@section('title', 'Create Event')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    @if ($remianingEventCount > 0)
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Event Name and Event Location in a single row -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-1 required">
                                            <span>Event Title</span>
                                        </label>
                                        <div class="form-control form-control-lg">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input class="w-100" type="text" name="title"
                                                    value="{{ old('title') }}" placeholder="John Doe" required>
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
                                        <select class="w-100 form-control form-select location" name="location_id" required>
                                            @forelse ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    @if (old('location_id') == $location->id) selected @endif>
                                                    {{ $location->name }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('location_id')
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
                                                    value="{{ old('start_date') }}" required>
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
                                                    value="{{ old('end_date') }}" required>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="mb-1 required">
                                            <span>Event Thumbanil</span>
                                        </label>
                                        <div class="form-control form-control-lg">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input class="w-100" name="thumbnail" type="file" allow="images/*"
                                                    required>
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
                                                <input class="w-100" name="images[]" type="file" allow="images/*"
                                                    multiple>
                                            </div>
                                        </div>
                                        @error('images')
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
                                    <select class="w-100 form-control form-select interests" name="interests[]" multiple
                                        required>
                                        @forelse ($interests as $interest)
                                            <option value="{{ $interest->id }}"
                                                {{ in_array($interest->id, old('interests', [])) ? 'selected' : '' }}>
                                                {{ $interest->name }} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('thumbnail')
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
                                        <textarea rows="4" name="description" class="w-100" required placeholder="Describe the event rules description">{{ old('description') }}</textarea>
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
                                        <textarea rows="4" name="rules" class="w-100" placeholder="Describe the event rules">{{ old('rules') }}</textarea>
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
                                        <option value="draft" @if (old('status') == 'draft') selected @endif>Draft
                                        </option>
                                        <option value="published" @if (old('status') == 'published') selected @endif>Publish
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
                        </form>
                    @else
                        <div class="alert alert-danger" role="alert">
                            You have reached the maximum limit of creating events for this month. Please delete some events
                            to create new
                            events.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".interests").select2({
                placeholder: "Select interests",
                allowClear: false,
            });


            $(".location").select2({
                placeholder: "Select select location",
                allowClear: false,
            });
        })
    </script>
@endsection
