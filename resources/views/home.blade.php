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
                            <a href="{{ route('register') }}" class="btn btn-primary px-4">Join Now</a>
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
                <div class="col-lg-6 mb-3">
                    <div class="accordion">
                        <div class="accordion-item mb-5 border-0">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What features does Flamingo offer?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How does payment work on Flamingo?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Can I use Flamingo on mobile devices?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="accordion">
                        <div class="accordion-item mb-5 border-0">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Is Flamingo suitable for businesses?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How do I get support on Flamingo?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-5">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Is my data secure on Flamingo?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae esse incidunt
                                    repellat tenetur. Illum nostrum odio quasi quo quod repellat sint unde vel veniam,
                                    veritatis! Ad et suscipit voluptatibus. Quod?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
