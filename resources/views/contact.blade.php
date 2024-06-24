@extends('layouts.app')
@section('title', 'Contact')
@section('styles')
@endsection
@section('content')
    <div class="contactWrapper py-5">
        <div class="container">
            <div class="row mx-0">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="col-lg-5 mx-auto px-0">
                        <div class="text-center pt-2">
                            <h2>Contact us</h2>
                            <p class="px-0 px-md-3 px-lg-5">
                                Questions or feedback? Reach out to us! Your input matters. Contact us now
                            </p>
                        </div>
                        <div class="contactCard bg-white p-3 p-md-3 p-lg-5 mt-4">
                            @include('layouts.partial.show-error')
                            <div class="form-group mb-3">
                                <label class="mb-1">Name</label>
                                <input class="form-control form-control-lg" type="text" name="name"
                                       value="{{ old('name') }}" placeholder="i.e. John Doe">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Email</label>
                                <input class="form-control form-control-lg" type="email" name="email"
                                       value="{{ old('email') }}" placeholder="i.e. John Doe">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Message</label>
                                <textarea rows="5" name="message" class="form-control"
                                          placeholder="Type you message">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
