@extends('layouts.dashboard')
@section('title', 'Settings')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-8 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav>
                        <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="preferences-tab" data-bs-toggle="tab"
                                    data-bs-target="#preferences" type="button" role="tab" aria-controls="preferences"
                                    aria-selected="true"><span class="px-1 px-md-2 px-lg-3">Preferences</span></button>
                            <button class="nav-link" id="account-tab" data-bs-toggle="tab"
                                    data-bs-target="#account" type="button" role="tab"
                                    aria-controls="account" aria-selected="false"><span
                                        class="px-1 px-md-2 px-lg-3">Account</span></button>
                        </div>
                    </nav>
                    <div class="tab-content p-3 border-0" id="nav-tabContent">
                        <div class="tab-pane fade active show account-settings-tab" id="preferences" role="tabpanel"
                             aria-labelledby="preferences-tab">

                            <a class="btn  btn-primary px-4" href="profile">Profile Settings</a>
                            <div class="form-group mb-3 mt-5">
                                <label class="d-flex align-items-center gap-2 mb-2">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="checkboxLabel">Allow others to ‘like’ my profile</span>
                                </label>
                                <label class="d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="checkboxLabel">Hide my birthday year</span>
                                </label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between links-account">
                                <p>Who can see my profile</p>
                                <a class="text-decoration-none gap-2 d-flex align-items-center" href=""><img
                                            src="assets/icon11.svg">Public</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between links-account">
                                <p>Who can post on my profile</p>
                                <a class="text-decoration-none gap-2 d-flex align-items-center" href=""><img
                                            src="assets/friends.svg">My Friends</a>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <label class="mb-3 d-flex align-items-center justify-content-between">
                                    <span>Others</span>
                                </label>
                                <label class="d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox">
                                    <span class="checkboxLabel">Don’t show my online Status</span>
                                </label>
                            </div>

                        </div>
                        <div class="tab-pane fade passwordCard" id="account" role="tabpanel"
                             aria-labelledby="account-tab">
                            <div class="form-group mb-3">
                                <label class="mb-1">Current Password</label>
                                <input class="form-control form-control-lg" type="text" placeholder="Current Password">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">New Password</label>
                                <input class="form-control form-control-lg" type="text" placeholder="New Password">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1">Confirm Password</label>
                                <input class="form-control form-control-lg" type="text" placeholder="Confirm Password">
                            </div>
                            <div class="text-end mt-4">
                                <a class="btn  btn-primary px-4" href="profile">Submit</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="bg-white p-4 dashboardCard ">
                    <h5>My Friends</h5>
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
