@extends('layouts.dashboard')
@section('title', 'Friends feed')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="innerCard p-3 bg-white mt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="avatar align-items-center gap-3 py-4">
                                <img class="rounded-circle" src="assets/profile.png">
                                <div class="details">
                                    <span class="d-block">Muhammad Usama</span>
                                    <span class="d-block">UI/UX Designer</span>
                                    <span class="d-block small">25 Nov at 12:24 PM</span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0 rounded-0 outline-0 dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="assets/dropdown.svg">
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">{{ __('Action') }}</a></li>
                                    <li><a class="dropdown-item" href="#">Another {{ __('Action') }}</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <h5 class="shopHeading pb-3 mb-0">Family Room Couch/ $320.00</h5>
                        <p class="detailsText">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </p>
                        <p class="detailsText">
                            For detailed information, don't hesitate to direct message me. I'm available 24/7.
                            Thanks😀
                        </p>
                        <img class="img-fluid" src="assets/shopimage.png">
                        <div class="likes align-items-center justify-content-between pt-4">
                            <div class="d-flex align-items-center gap-4 ">
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon12.svg">
                                    <span>14</span>
                                </div>
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon13.svg">
                                    <span>14</span>
                                </div>
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon14.svg">
                                    <span>52</span>
                                </div>
                            </div>
                            <div class="svg">
                                <a class="btn p-0 text-decoration-none" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                         viewBox="0 0 28 28" fill="none">
                                        <path d="M10.4998 4.66663H17.4998C18.1187 4.66663 18.7122 4.91246 19.1498 5.35004C19.5873 5.78763 19.8332 6.38112 19.8332 6.99996V23.3333L13.9998 19.8333L8.1665 23.3333V6.99996C8.1665 6.38112 8.41234 5.78763 8.84992 5.35004C9.28751 4.91246 9.881 4.66663 10.4998 4.66663Z"
                                              fill="#fff" stroke="#FBB03B" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="innerCard p-3 bg-white mt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="avatar align-items-center gap-3 py-4">
                                <img class="rounded-circle" src="assets/profile.png">
                                <div class="details">
                                    <span class="d-block">Muhammad Usama</span>
                                    <span class="d-block">UI/UX Designer</span>
                                    <span class="d-block small">25 Nov at 12:24 PM</span>
                                </div>
                            </div>
                        </div>
                        <p class="detailsText">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </p>
                        <p class="detailsText">
                            For detailed information, don't hesitate to direct message me. I'm available 24/7.
                            Thanks😀
                        </p>
                        <div class="likes align-items-center justify-content-between pt-4">
                            <div class="d-flex align-items-center gap-4 ">
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon12.svg">
                                    <span>14</span>
                                </div>
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon13.svg">
                                    <span>14</span>
                                </div>
                                <div class="text d-flex align-items-center gap-3">
                                    <img src="assets/icon14.svg">
                                    <span>52</span>
                                </div>
                            </div>
                            <div class="svg">
                                <a class="btn p-0 text-decoration-none" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                         viewBox="0 0 28 28" fill="none">
                                        <path d="M10.4998 4.66663H17.4998C18.1187 4.66663 18.7122 4.91246 19.1498 5.35004C19.5873 5.78763 19.8332 6.38112 19.8332 6.99996V23.3333L13.9998 19.8333L8.1665 23.3333V6.99996C8.1665 6.38112 8.41234 5.78763 8.84992 5.35004C9.28751 4.91246 9.881 4.66663 10.4998 4.66663Z"
                                              fill="#fff" stroke="#FBB03B" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>


                    </div>
                    <div class="text-center pt-5">
                        <button class="btn btn-primary">Load More</button>
                    </div>

                </div>


            </div>
            <div class="col-lg-4 mb-3">
                <div class="bg-white p-4 dashboardCard ">
                    <h5>People you may know</h5>
                    <div class="list">
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="singlePerson py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="avatarWrapper">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="image position-relative">
                                            <img src="assets/profile.png">
                                            <span class="position-absolute"></span>
                                        </div>

                                        <div class="details">
                                            <span class="d-block">Muhammad Asad</span>
                                            <span class="d-block">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttonWrapper">
                                    <div class="d-flex align-items-center gap-1 flex-column">
                                        <a data-bs-toggle="modal" data-bs-target="#joinCommunity"
                                           class="text-decoration-none">
                                            <img src="assets/icon7.svg">
                                        </a>
                                        <span class="d-block">Join</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-0 mt-3">See more...</h5>


                </div>
                <div class="bg-white p-4 dashboardCard mt-4">
                    <h5>Advertizement</h5>
                    <img class="img-fluid" src="assets/feedImage.png">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
