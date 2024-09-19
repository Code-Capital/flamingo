@extends('layouts.app')
@section('tile', 'Dashboard')
@section('styles')
@endsection
@section('content')
    <div class="heroWrapper py-5 bg-white">
        <div class="container">
            <div class="row mx-0 align-items-center">
                <div class="col-lg-6">
                    <div class="content pe-5">
                        <h1 class="mb-0 ">Discover Flamingo - Where Vibrancy Meets Connections</h1>
                        <p class="mb-0 py-4">Discover a place where connections, friendships, and communities thrive.
                            Flamingo is your gateway to an inclusive online space where you can interact, share, and
                            engage with like-minded individuals. Join us to meet new people, explore shared interests,
                            and connect with your community!</p>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary px-4">{{ __('Join now') }}</a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image text-center">
                        <img class="img-fluid" src=" {{ asset('assets/hero-image.png') }} " alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featureWrapper py-5">
        <div class="container">
            <div class="text-center pb-4">
                <h2>Discover the Features</h2>
                <p>Discover the Abundance of Features and Benefits with Flamingo</p>
            </div>
            <div class="row mx-0 align-items-stretch">
                <div class="col-lg-4 mb-3">
                    <div class="content bg-white px-4 py-5 h-100">
                        <img class="img-fluid" src="{{ asset('assets/icon1.svg') }}" alt="">
                        <h4 class="mb-0 py-3">Profile Creation</h4>
                        <p class="pe-0 pe-md-3 pe-lg-5">Craft a vibrant, personalized profile to connect with
                            like-minded individuals.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="content bg-white px-4 py-5 h-100">
                        <img class="img-fluid" src="{{ asset('assets/icon2.svg') }}" alt="">
                        <h4 class="mb-0 py-3">Communicate & Connect</h4>
                        <p class="pe-0 pe-md-3 pe-lg-5">Engage actively, connect effortlessly, and build meaningful
                            relationships with others</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="content bg-white px-4 py-5 h-100">
                        <img class="img-fluid" src=" {{ asset('assets/icon3.svg') }} " alt="">
                        <h4 class="mb-0 py-3">Content Sharing</h4>
                        <p class="pe-0 pe-md-3 pe-lg-5">Share captivating stories, spark engaging conversations, and
                            inspire others' creativity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="faqsWrapper py-5 bg-white">
        <div class="container">
            <div class="text-center pb-4">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="row mx-0" id="accordionExample">
                @forelse ($faqs as $faq)
                    <div class="col-lg-6 mb-3">
                        <div class="accordion">
                            <div class="accordion-item mb-5 border-0">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <div class="newsLetter py-5">
        <div class="container pb-4">
            <div class="row mx-0">
                <div class="col-lg-6 mx-auto px-0">
                    <div class="text-center pb-4">
                        <h2>Get community updates, subscribe now!</h2>
                        <p class="px-0 px-md-2 px-lg-5 pt-3">Get the latest community news, events, and discussions
                            delivered to your inbox. Join now to stay connected!</p>
                    </div>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col-lg-5 mx-auto px-0">
                    @include('layouts.partial.show-error')
                    <form action="{{ route('subscribers.store') }}" method="POST">
                        @csrf
                        <div class="row mx-auto justify-content-center align-items-stretch">
                            <div class="col-8">
                                <input class="form-control form-control-lg h-100 newsLetterInput" type="email"
                                    placeholder="Your email" id="email" name="email" required>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary px-4 h-100" type="submit">Join Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
