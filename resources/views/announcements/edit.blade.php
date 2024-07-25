@extends('layouts.dashboard')
@section('title', 'Edit Announcement')
@section('styles')

@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3 mx-auto">
                <form action="{{ route('announcements.update', $announcement->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                        <!-- Announcement Name and Announcement Location in a single row -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Announcement Title</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="title" value="{{ $announcement->title }}"
                                                placeholder="John Doe" required>
                                        </div>
                                    </div>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Start Datetime</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="start_date" type="date"
                                                value="{{ $announcement->start_date }}" required>
                                        </div>
                                    </div>
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>End Datetime</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="end_date" type="date"
                                                value="{{ $announcement->end_date }}" required>
                                        </div>
                                    </div>
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- Announcement Description -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Announcement Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="4" name="body" class="w-100" required
                                        placeholder="Describe the Announcement rules description">{{ $announcement->body }}</textarea>
                                </div>
                            </div>
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Announcement Status -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Status</span>
                            </label>
                            <div class="d-flex align-items-center justify-content-between">
                                <select class="w-100 form-control form-select" name="status" required>
                                    <option value="">Please Select Status</option>
                                    <option value="0" @if ($announcement->status == 0) selected @endif>Draft</option>
                                    <option value="1" @if ($announcement->status == 1) selected @endif>Publish</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Create Button -->
                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
