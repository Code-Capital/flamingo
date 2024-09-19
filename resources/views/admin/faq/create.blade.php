@extends('layouts.dashboard')
@section('title', 'Create Faq')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3 mx-auto">
                <div class="profileForm bg-white p-3 p-md-3 p-lg-5 mt-2">
                    <div class="col-lg-12 w-100 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="marketHeading mb-0">Create Faq</h3>
                        </div>
                    </div>
                    <form action="{{ route('faqs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Event question -->
                        <div class="form-group mb-3">
                            <label class="mb-1 required">
                                <span>Question</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="2" name="question" class="w-100" required placeholder="Write your question...">{{ old('question') }}</textarea>
                                </div>
                            </div>
                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Event answer -->
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>Answer</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="4" name="answer" class="w-100" placeholder="write answer of the question...">{{ old('answer') }}</textarea>
                                </div>
                            </div>
                            @error('answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
