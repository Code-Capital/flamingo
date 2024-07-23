@extends('layouts.dashboard')
@section('title', 'Profile info')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 profileInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Info-tab" data-bs-toggle="tab" data-bs-target="#Info"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">Info</span></button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#Photos"
                                type="button" role="tab" aria-controls="Photos" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Photos</span>
                            </button>
                            <button class="nav-link" id="Requests-tab" data-bs-toggle="tab" data-bs-target="#Requests"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Requests</span>
                            </button>
                            <button class="nav-link" id="Friends-tab" data-bs-toggle="tab" data-bs-target="#Friends"
                                type="button" role="tab" aria-controls="Friends" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Friends</span>
                            </button>
                            <button class="nav-link" id="Blocked-tab" data-bs-toggle="tab" data-bs-target="#Blocked"
                                type="button" role="tab" aria-controls="Requests" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Blocked</span>
                            </button>
                            <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab"
                                data-bs-target="#Subscription" type="button" role="tab" aria-controls="Subscription"
                                aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Subscription</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="Info" role="tabpanel" aria-labelledby="Info-tab">
                        <div class="row mx-0">
                            <div class="col-lg-8 ps-0 ps-md-0 ps-lg-auto pe-0 pe-md-0 pe-lg-2 mb-3">
                                <div class="bg-white p-4 dashboardCard">
                                    <div class="aboutCard">
                                        <h6 class="mb-4">About</h6>
                                        <p> {{ $user->about }}</p>
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
                                                            <img src=" {{ asset('assets/profile.png') }} ">
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
                                                            <img src=" {{ asset('assets/icon7.svg') }} ">
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
                    <div class="tab-pane fade" id="Photos" role="tabpanel" aria-labelledby="Photos-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="gallery">
                                <div class="d-flex align-items-center justify-content-between pb-4 ">
                                    <button class="btn btn-primary px-4">Gallery</button>
                                    <label for="upload_new">
                                        <input id="upload_new" type="file" class="px-4 d-none">
                                        <div class="btn btn-outline-primary">Upload</div>
                                    </label>
                                </div>
                                <div class="d-flex align-items-center justify-content-center pt-4 gap-4 flex-wrap">
                                    @forelse($media as $item)
                                        <div class="galleryCard text-center d-flex flex-column mb-3">
                                            <img src="{{ asset('assets/galleryImage.png') }}">
                                            <span class="pt-1">Shine</span>
                                        </div>
                                    @empty
                                        <x-no-data-found />
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Friends" role="tabpanel" aria-labelledby="Friends-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Friends <span>{{ $friends->count() }}</span></div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                @forelse($friends as $friend)
                                    <div class="col-lg-6 mb-3 friend-request-{{ $friend->id }}">
                                        <div class="eventCardInner p-3 friendRequest">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $friend->avatar_url }}" class="rounded-circle">
                                                    <div>
                                                        <span class="d-block">{{ $friend->full_name }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-decoration-none block" data-id="{{ $friend->id }}"
                                                        tooltip="Block" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/secure.svg') }} ">
                                                    </a>
                                                    <a class="text-decoration-none unfriend"
                                                        data-id="{{ $friend->id }}" tooltip="Unfriend"
                                                        href="javascript:void(0)">
                                                        <img src="{{ asset('assets/trash.svg') }} " alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-no-data-found />
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Friend Requests <span>{{ $requests->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                @forelse($requests as $user)
                                    <div class="col-lg-6 mb-3 friend-request-{{ $user->id }}">
                                        <div class="eventCardInner p-3 friendRequest">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $user->avatar_url }}" class="rounded-circle">
                                                    <div>
                                                        <span class="d-block">{{ $user->full_name }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-decoration-none accept" data-id="{{ $user->id }}"
                                                        href="javascript:void(0)">
                                                        <img src="{{ asset('assets/done.svg') }} ">
                                                    </a>
                                                    <a class="text-decoration-none reject" data-id="{{ $user->id }}"
                                                        href="javascript:void(0)">
                                                        <img src="{{ asset('assets/trash.svg') }} " alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-no-data-found />
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Blocked" role="tabpanel" aria-labelledby="blocked-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <div class="col-lg-12">
                                    <div class="heading pb-4">Blocked Users <span>{{ $blockedUsers->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-0">
                                @forelse($blockedUsers as $blockUser)
                                    <div class="col-lg-6 mb-3 friend-request-{{ $blockUser->id }}">
                                        <div class="eventCardInner p-3 friendRequest">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $blockUser->avatar_url }}" class="rounded-circle">
                                                    <div>
                                                        <span class="d-block">{{ $blockUser->full_name }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a class="text-decoration-none accept" data-id="{{ $blockUser->id }}"
                                                        tooltip="Unblock" href="javascript:void(0)">
                                                        <img src="{{ asset('assets/done.svg') }} ">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-no-data-found />
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab">
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
                                                    <img src="{{ asset('assets/icon4.svg') }} ">
                                                </div>
                                                <div class="text">
                                                    <p class="mb-2">For individuals</p>
                                                    <h6>Basic</h6>
                                                </div>
                                            </div>
                                            <p class="text pe-5 pt-3">Ideal for individuals and small teams</p>
                                            <div class="heading mb-4">
                                                <span class="h2">$99</span>
                                                <span class="month">/monthly</span>
                                            </div>
                                            <h5 class="mb-3">What’s included</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span> Basic profile creation</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span> Access to community features</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span> Limited content sharing access</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
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
                                                    <img src="{{ asset('assets/icon5.svg') }} ">
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
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Advanced profile customization</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Access to community features</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Enhanced content sharing access</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
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
                                                    <img src="{{ asset('assets/icon6.svg') }} ">
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
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Customizable solutions</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Advanced analytics</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    <span>Dedicated account manager option</span>
                                                </li>
                                                <li class="mb-4">
                                                    <span>
                                                        <svg width="26" height="27" viewBox="0 0 26 27"
                                                            fill="#DE296A" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_1_69)">
                                                                <path
                                                                    d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                                <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                    stroke="white" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_1_69">
                                                                    <rect width="26" height="26" fill="white"
                                                                        transform="translate(0 0.5)" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let body = $('body');

            body.on('click', '.accept', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'accepted', $(this));
            });

            body.on('click', '.reject', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'rejected', $(this));
            });

            body.on('click', '.block', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                sendRequest(id, 'blocked', $(this));
            });

            body.on('click', '.unfriend', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                unfriendUser(id, $(this));
            });

            function sendRequest(id, status, button) {
                $.ajax({
                    url: '{{ route('friend.request.status', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: {
                        "status": status,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success == false) {
                            toastr.error(response.message);
                            errorNotificationSound();
                            return false;
                        }

                        toastr.success(response.message);
                        newNotificationSound();
                        button.closest('.friend-request-' + id).fadeOut(300)
                            .hide(); // Hide the parent element of the button
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        console.log(error);
                        errorNotificationSound();
                        toastr.error(error);
                    }
                });
            }

            function unfriendUser(id, button) {
                $.ajax({
                    url: '{{ route('friend.remove', ':id') }}'.replace(':id', id),
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success == false) {
                            toastr.error(response.message);
                            errorNotificationSound();
                            return false;
                        }

                        toastr.success(response.message);
                        newNotificationSound();
                        button.closest('.friend-request-' + id).fadeOut(300)
                            .hide(); // Hide the parent element of the button
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        console.log(error);
                        errorNotificationSound();
                    }
                });
            }
        });
    </script>
@endsection
