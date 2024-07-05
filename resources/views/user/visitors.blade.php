@extends('layouts.dashboard')
@section('title', 'Visitors')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">

                <div class="bg-white p-4 dashboardCard">
                    <nav>
                        <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="popular-tab" data-bs-toggle="tab"
                                    data-bs-target="#popular" type="button" role="tab" aria-controls="popular"
                                    aria-selected="true"><span class="px-1 px-md-2 px-lg-3">Popular</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                    data-bs-target="#suggestions" type="button" role="tab"
                                    aria-controls="suggestions" aria-selected="false"><span
                                        class="px-1 px-md-2 px-lg-3">Profile</span></button>
                            <button class="nav-link" id="friends-tab" data-bs-toggle="tab"
                                    data-bs-target="#friends" type="button" role="tab" aria-controls="friends"
                                    aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Contact</span></button>
                        </div>
                    </nav>
                    <div class="tab-content p-3 border-0" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="popular" role="tabpanel"
                             aria-labelledby="popular-tab">
                            <div class="d-flex align-items-center gap-4 flex-wrap">
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="suggestions" role="tabpanel"
                             aria-labelledby="suggestions-tab">
                            <div class="d-flex align-items-center gap-4 flex-wrap">
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                            <div class="d-flex align-items-center gap-4 flex-wrap">
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                                <div class="profilecard">
                                    <img src="assets/profileImage.png">
                                    <div class="name mt-2">Muhammad Asad</div>
                                    <div class="profession">Designer</div>
                                </div>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
