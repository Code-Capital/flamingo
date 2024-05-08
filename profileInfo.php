<?php include_once 'includes/headerLinks.php'; ?>
<main>
    <div id="wrapper" class="dashboardWrapper d-flex align-items-stretch">
        <?php include_once 'includes/dashboardSideBar.php'; ?>
        <div id="content-wrapper" class="contentWrapper h-100">
            <div class="hero">
                <div class="bg-primary">
                    <a id="sidebar-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="px-2 px-md-3 px-lg-5 bg-white pb-4">
                    <div class="d-flex align-items-center justify-content-between gap-4 pb-3">
                        <div class="profile position-relative">
                            <img class="position-absolute" src="assets/profile.png">
                        </div>
                        <div class="d-flex justify-content-between align-items-center flex-grow-1 pt-4">
                            <div class="name">
                                <span class="d-block">Muhammad Usama</span>
                                <span class="d-block pt-2">Visitor</span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="notifications position-relative">
                                    <a class="text-decoration-none" href="notification">
                                        <img src="assets/bell.svg">
                                        <span class="position-absolute dot"></span>
                                    </a>
                                </div>
                                <a href="profile" class="btn btn-primary px-4">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-0 px-md-2 px-lg-3 ">
                <div class="row mx-0 pt-5 profileInfoWrap">
                    <div class="col-lg-12 mb-3">
                        <div class="bg-white p-4 dashboardCard">
                            <nav class="mb-0">
                                <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="Info-tab" data-bs-toggle="tab"
                                            data-bs-target="#Info" type="button" role="tab" aria-controls="Info"
                                            aria-selected="true"><span class="px-1 px-md-2 px-lg-3">Info</span></button>
                                    <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                            data-bs-target="#Photos" type="button" role="tab"
                                            aria-controls="Photos" aria-selected="false"><span
                                                class="px-1 px-md-2 px-lg-3">Photos</span></button>
                                    <button class="nav-link" id="Friends-tab" data-bs-toggle="tab"
                                            data-bs-target="#Friends" type="button" role="tab" aria-controls="Friends"
                                            aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Contact</span>
                                    </button>
                                    <button class="nav-link" id="Requests-tab" data-bs-toggle="tab"
                                            data-bs-target="#Requests" type="button" role="tab" aria-controls="Requests"
                                            aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Requests</span>
                                    </button>
                                    <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab"
                                            data-bs-target="#Subscription" type="button" role="tab"
                                            aria-controls="Subscription"
                                            aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Subscription</span>
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
                                                        simply dummy text of the printing er and typesetting industry.
                                                        Lorem Ipsum has
                                                        been Lorem Ipsum is simply dummy text of the printing er and
                                                        typesetting
                                                        industry. Lorem Ipsum has been
                                                    </p>
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Photos" role="tabpanel"
                                 aria-labelledby="Photos-tab">
                                <div class="bg-white p-4 dashboardCard">
                                    <div class="gallery">
                                        <div class="d-flex align-items-center justify-content-between pb-4 ">
                                            <button class="btn btn-primary px-4">Gallery</button>
                                            <label for="upload_new">
                                                <input id="upload_new" type="file" class="px-4 d-none">
                                                <div class="btn btn-outline-primary">Upload</div>
                                            </label>
                                        </div>
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
                                            <div class="heading pb-4">Friends <span>(16)</span></div>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                                                        href="">Unfriend</a>
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
                                            <div class="heading pb-4">Friend Requests <span>(16)</span></div>
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
                            <div class="tab-pane fade" id="Subscription" role="tabpanel"
                                 aria-labelledby="Subscription-tab">
                                <div class="bg-white p-4 dashboardCard">
                                    <div class="pricingWrapper">
                                        <div class="text-center py-5">
                                            <h2>Pricing Plans</h2>
                                            <p>Choose the plan that best fits your needs</p>
                                            <div class="d-flex align-items-center gap-4 toggler justify-content-center">
                                                <span>Monthly</span>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                           id="flexSwitchCheckChecked" checked>
                                                </div>
                                                <span>Annually</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-stretch">
                                            <div class="col-lg-4 mb-4">
                                                <div class="pricingCard p-5 h-100">
                                                    <div class="d-flex gap-3">
                                                        <div class="icon d-flex align-items-center justify-content-center">
                                                            <img src="assets/icon4.svg">
                                                        </div>
                                                        <div class="text">
                                                            <p class="mb-2">For individuals</p>
                                                            <h6>Basic</h6>
                                                        </div>
                                                    </div>
                                                    <p class="text pe-5 pt-3">Ideal for individuals and small teams</p>
                                                    <div class="heading mb-4"><span class="h2">$99</span><span
                                                                class="month">/monthly</span></div>
                                                    <h5 class="mb-3">What’s included</h5>
                                                    <ul class="list-unstyled">
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span> Basic profile creation</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span> Access to community features</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span> Limited content sharing access</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span> Standard support</span>
                                                        </li>
                                                    </ul>
                                                    <button class="btn-primary btn w-100 mt-3">Get started</button>
                                                </div>

                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pricingCard px-5 pt-3 pb-5 active h-100">
                                                    <div class="text-end">
                                                        <div class="badge bg-white px-3">Popular</div>
                                                    </div>
                                                    <div class="d-flex gap-3">
                                                        <div class="icon d-flex align-items-center justify-content-center">
                                                            <img src="assets/icon5.svg">
                                                        </div>
                                                        <div class="text">
                                                            <p class="mb-2">For startups</p>
                                                            <h6>Pro</h6>
                                                        </div>
                                                    </div>
                                                    <p class="text pe-5 pt-3">Ideal for individuals and small teams</p>
                                                    <div class="heading mb-4"><span class="h2">$99</span><span
                                                                class="month">/monthly</span></div>
                                                    <h5 class="mb-3">What’s included</h5>
                                                    <ul class="list-unstyled">
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Advanced profile customization</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Access to community features</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Enhanced content sharing access</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Priority support</span>
                                                        </li>
                                                    </ul>
                                                    <button class="btn-primary btn w-100 mt-3">Get started</button>
                                                </div>

                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="pricingCard p-5 h-100">
                                                    <div class="d-flex gap-3">
                                                        <div class="icon d-flex align-items-center justify-content-center">
                                                            <img src="assets/icon6.svg">
                                                        </div>
                                                        <div class="text">
                                                            <p class="mb-2">For big companies</p>
                                                            <h6>Enterprise</h6>
                                                        </div>
                                                    </div>
                                                    <p class="text pe-5 pt-3">Tailored for large communities and
                                                        businesses</p>
                                                    <div class="heading mb-4"><span class="h2">$99</span><span
                                                                class="month">/monthly</span></div>
                                                    <h5 class="mb-3">What’s included</h5>
                                                    <ul class="list-unstyled">
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Customizable solutions</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Advanced analytics</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Dedicated account manager option</span>
                                                        </li>
                                                        <li class="mb-4">
                                <span>
                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                         xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_69)"><path
                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z"/><path
                                                    d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"/></g><defs><clipPath id="clip0_1_69"><rect
                                                        width="26" height="26" fill="white"
                                                        transform="translate(0 0.5)"/></clipPath></defs></svg>
                                </span>
                                                            <span>Advanced reporting</span>
                                                        </li>
                                                    </ul>
                                                    <button class="btn-primary btn w-100 mt-3">Get started</button>
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
    </div>
    </div>

</main>
<?php include_once 'includes/footerLinks.php'; ?>
<script>
    $(document).ready(function() {
        $("#profileInfo").addClass('active');
    });
</script>
