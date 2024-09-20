@extends('layouts.dashboard')
@section('title', 'Home Page Design')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-3">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-between pb-3">
                            <h3 class="marketHeading mb-0">Create Feature</h3>
                            <a href="{{ route('admin.homepage.edit') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                    <form action="{{ route('admin.homepage.feature.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Heading</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="2" name="heading" class="w-100" placeholder="Heading" required></textarea>
                                </div>
                            </div>
                            @error('heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="3" name="description" class="w-100" placeholder="Description" required>
                                    </textarea>
                                </div>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Image</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="image" type="file" accept=".jpg,.jpeg,.png"
                                                required>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            {{ __('Create') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
