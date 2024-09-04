@extends('layouts.dashboard')
@section('title', 'Create plans')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="row mx-0 mb-3">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-between pb-3">
                                <h3 class="marketHeading mb-0">Create Plans</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <form action="{{ route('admin.plans.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="profileForm bg-white">
                                <!-- Event Name and Event Location in a single row -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mb-1 required">
                                                <span>Plan Title</span>
                                            </label>
                                            <div class="form-control form-control-lg">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <input class="w-100" type="text" name="name"
                                                        value="{{ old('name') }}" placeholder="John Doe" required>
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mb-1 required">
                                                <span>Price in {{ strtoupper(env('CASHIER_CURRENCY')) }} </span>
                                            </label>
                                            <div class="form-control form-control-lg">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <input class="w-100" type="number" name="amount"
                                                        value="{{ old('amount') }}" placeholder="10" required>
                                                </div>
                                            </div>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mb-1 required">
                                                <span>Interval</span>
                                            </label>
                                            <select class="w-100 form-control form-select location" name="interval"
                                                required>
                                                <option value="day">Daily</option>
                                                <option value="week">Weekly</option>
                                                <option value="month">Monthly</option>
                                                <option value="quarter">Every 3 months</option>
                                                <option value="semiannual">Every 6 months</option>
                                                <option value="year">Yearly</option>
                                            </select>
                                            @error('interval')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Event Description -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group
                                        ">
                                            <label class="mb-1 required">
                                                <span>Plan Description</span>
                                            </label>
                                            <textarea class="form-control form-control-lg" name="description" placeholder="Plan Description" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
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
        </div>
    </div>
@endsection
@section('scripts')

@endsection
