<div class="tab-pane fade" id="Info" role="tabpanel" aria-labelledby="Info-tab">
    <div class="row mx-0">
        <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
            <div class="bg-white p-4 dashboardCard">
                <div class="aboutCard">
                    <h6 class="mb-4">About</h6>
                    <p>
                        {{ $event->description }}
                    </p>

                    <h6 class="mb-2 mt-4">Rules and Regulations</h6>
                    <p>
                        {{ $event->rules }}
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
                                        <img src=" {{ asset('assets/profile.png') }}" alt="">
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
                                        <img src=" {{ asset('assets/icon7.svg') }}" alt="">
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
                                        <img src=" {{ asset('assets/profile.png') }}" alt="">
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
                                        <img src=" {{ asset('assets/icon7.svg') }}" alt="">
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
                <img class="img-fluid" src="{{ asset('assets/feedImage.png') }}">
            </div>
        </div>
    </div>
</div>
