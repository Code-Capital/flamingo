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
                            <h3 class="marketHeading mb-0">Hero Section</h3>
                        </div>
                    </div>
                    <form action="{{ route('admin.homepage.update.hero') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Hero Heading</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="2" name="hero_heading" class="w-100" placeholder="Hero section heading" required>{{ $homePage->hero_heading ?? '' }}</textarea>
                                </div>
                            </div>
                            @error('hero_heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>Hero Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="3" name="hero_description" class="w-100" placeholder="Hero section heading" required>{{ $homePage->hero_description ?? '' }}
                                    </textarea>
                                </div>
                            </div>
                            @error('hero_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-1 required">
                                        <span>Hero Image</span>
                                    </label>
                                    @if ($homePage->hero_image)
                                        <div class="mb-3" style="height: 100px; width: 100px">
                                            <img src="{{ $homePage->hero_image }}" alt="Hero image" class="img-fluid">
                                        </div>
                                    @endif
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" name="hero_image" type="file" accept=".jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                    @error('hero_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Feature section --}}
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-3">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-between pb-3">
                            <h3 class="marketHeading mb-0">Feature Section</h3>
                            <a href="{{ route('admin.homepage.feature.create') }}" class="btn btn-primary"
                                id="add-feature-button">
                                {{ __('Add New Feature') }}
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.homepage.update.feature') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Feature Heading</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="2" name="feature_heading" class="w-100" placeholder="Feature section heading" required>{{ $homePage->feature_heading ?? '' }}</textarea>
                                </div>
                            </div>
                            @error('feature_heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>Feature Description</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="3" name="feature_description" class="w-100" placeholder="Hero section heading" required>{{ $homePage->feature_description ?? '' }}
                                    </textarea>
                                </div>
                            </div>
                            @error('feature_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-3">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    <div class="form-group mb-3">
                        <label class="mb-1">
                            <span>All Features</span>
                        </label>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Feature Title</th>
                                    <th scope="col">Feature Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($homePage->features as $feature)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $feature->heading }}</td>
                                        <td>{{ $feature->description }}</td>
                                        <td>
                                            @if ($feature->image)
                                                <img src="{{ $feature->image }}" alt="Feature image" class="img-fluid"
                                                    style="height: 50px; width: 50px;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.homepage.feature.edit', $feature->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.homepage.feature.destroy', $feature->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
