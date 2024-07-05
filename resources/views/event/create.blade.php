@extends('layouts.dashboard')
@section('title', 'Create Event')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 pt-5 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-6 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Creator</span><span class="d-flex align-items-center gap-2"><img src="assets/icon11.svg" alt="">Public</span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <input class="w-100" type="text" placeholder="Muhammad Usama">
                                <a class="text-decoration-none" href=""><img src="assets/pencil.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Name</span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <input class="w-100" type="text" placeholder="Pakistani Freelancers">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center gap-2">
                            <span>Event Location </span><span>(Optional)</span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <input class="w-100" type="email" placeholder="Pakistan">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Activities </span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <textarea rows="4" class="w-100" placeholder="Type you message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Activities </span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <textarea rows="4" class="w-100" placeholder="Type you message"></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
