@extends('layouts.dashboard')
@section('title', 'Create Event')
@section('styles')
    <style>
        .select2-container .select2-selection--multiple {
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
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-4">
                    <!-- Event Name and Event Location in a single row -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Event Name</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="text" placeholder="Pakistani Freelancers">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1 d-flex align-items-center gap-2">
                                    <span>Event Location</span><span>(Optional)</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="text" placeholder="Pakistan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Datetime and End Datetime in a single row -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Start Datetime</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="datetime-local">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>End Datetime</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="datetime-local">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Description -->
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Description</span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <textarea rows="4" class="w-100" placeholder="Describe the event"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Event Activities -->
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Event Activities</span>
                        </label>
                        <div class="form-control form-control-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <textarea rows="4" class="w-100" placeholder="Type your activities"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Event Interests -->
                    <div class="form-group mb-3">
                        <label class="mb-1 d-flex align-items-center justify-content-between">
                            <span>Interests</span>
                        </label>
                        <div class="d-flex align-items-center justify-content-between">
                            <select class="w-100 form-control form-select" multiple>
                                <option value="technology">Technology</option>
                                <option value="business">Business</option>
                                <option value="education">Education</option>
                                <option value="health">Health</option>
                                <option value="entertainment">Entertainment</option>
                            </select>
                        </div>
                    </div>
                    <!-- Create Button -->
                    <button class="btn btn-primary w-100 mt-3">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(".form-select").select2({
                placeholder: "Select an interest",
                allowClear: false
            });
        })
    </script>
@endsection
