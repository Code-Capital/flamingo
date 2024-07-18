@extends('layouts.dashboard')
@section('title', 'Events list')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 eventsInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Info-tab" data-bs-toggle="tab"
                                    data-bs-target="#Info" type="button" role="tab" aria-controls="Info"
                                    aria-selected="true"><span class="px-1 px-md-2 px-lg-3">About</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                    data-bs-target="#Photos" type="button" role="tab"
                                    aria-controls="Photos" aria-selected="false"><span
                                        class="px-1 px-md-2 px-lg-3">Posts</span></button>
                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab"
                                    data-bs-target="#Friends" type="button" role="tab" aria-controls="Friends"
                                    aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Members</span>
                            </button>
                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab"
                                    data-bs-target="#Requests" type="button" role="tab" aria-controls="Requests"
                                    aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Invite Requests</span>
                            </button>

                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="Info" role="tabpanel"
                         aria-labelledby="Info-tab">
                        <div class="row mx-0">
                            <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
                                <div class="bg-white p-4 dashboardCard">
                                    <div class="aboutCard">
                                        <h6 class="mb-4">About</h6>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing er and
                                            typesetting industry.
                                            Lorem Ipsum has been Lorem Ipsum is simply dummy text of the
                                            printing er and
                                            typesetting industry. Lorem Ipsum has been Lorem Ipsum is simply
                                            dummy text of
                                            the printing er and typesetting industry. Lorem Ipsum has been
                                            Lorem Ipsum is
                                        </p>
                                        <div class="list py-3">
                                            <ul class="list-unstyled">
                                                <li class="d-flex gap-2 align-items-center"><img
                                                            src="assets/tick.svg"><span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                            src="assets/tick.svg"><span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                            src="assets/tick.svg"><span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                            src="assets/tick.svg"><span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                                <li class="d-flex gap-2 align-items-center"><img
                                                            src="assets/tick.svg"><span>Lorem Ipsum is simply dummy text of the printing </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h6 class="mb-4">Rules and Regulations</h6>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing er and
                                            typesetting industry.
                                            Lorem Ipsum has been Lorem Ipsum is simply dummy text of the
                                            printing er and
                                            typesetting industry. Lorem Ipsum has been Lorem Ipsum is simply
                                            dummy text of
                                            the printing er and typesetting industry. Lorem Ipsum has been
                                            Lorem Ipsum is
                                            simply dummy text of the printing er and typesetting industry.
                                            Lorem Ipsum has
                                            been Lorem Ipsum is simply dummy text of the printing er and
                                            typesetting
                                            industry. Lorem Ipsum has been
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 ps-0 ps-md-0 ps-lg-2 pe-0 pe-md-0 pe-lg-auto mb-3">
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                                                        <a data-bs-toggle="modal"
                                                           data-bs-target="#joinCommunity"
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
                    <div class="tab-pane fade" id="Photos" role="tabpanel"
                         aria-labelledby="Photos-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="gallery">
                                <h5 class="gallery-heading pb-4 mb-0">Posts</h5>
                                <div class="d-flex align-items-center pt-4 gap-4 flex-wrap">
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                    <div class="galleryCard text-center d-flex flex-column mb-3">
                                        <img src="assets/galleryImage.png">
                                        <span class="pt-1">Shine</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Members <span>(16)</span></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                    <span class="d-block">Designer</span>
                                                </div>
                                            </div>
                                            <h6 class="mb-0"><a class="text-decoration-none"
                                                                href="">Remove</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Requests to join <span>(16)</span></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="eventCardInner p-3 friendRequest">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="assets/profile.png" class="rounded-circle">
                                                <div>
                                                    <span class="d-block">Muhammad Asad</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/done.svg"></a>
                                                <a class="text-decoration-none" href=""><img
                                                            src="assets/trash.svg"
                                                            alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
