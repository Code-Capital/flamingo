<div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="pricingWrapper">
            <div class="text-center py-5">
                <h2>Pricing Plans</h2>
                {{-- <p>Choose the plan that best fits your needs</p>
                <div class="d-flex align-items-center gap-4 toggler justify-content-center">
                    <span>Monthly</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            checked>
                    </div>
                    <span>Annually</span>
                </div> --}}
            </div>
            <div class="row align-items-stretch justify-content-center">
                @forelse ($plans as $plan)
                    <div class="col-lg-4 mb-4">
                        <div class="pricingCard p-5 h-100">
                            <div class="d-flex gap-3">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/icon4.svg') }} ">
                                </div>
                                <div class="text">
                                    {{-- <p class="mb-2">For individuals</p> --}}
                                    <h6>{{ Str::ucfirst($plan->name) }}</h6>
                                </div>
                            </div>
                            <p class="text pe-5 pt-3">{{ $plan->description }}</p>
                            <div class="heading mb-4">
                                <span class="h2">${{ $plan->amount }}</span>
                                <span class="month">/{{ $plan->interval }}</span>
                            </div>
                            {{-- <h5 class="mb-3">What’s included</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-4">
                                        <span>
                                            <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_69)">
                                                    <path
                                                        d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                    <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                            <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_69)">
                                                    <path
                                                        d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                    <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                            <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_69)">
                                                    <path
                                                        d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                    <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                            <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1_69)">
                                                    <path
                                                        d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                    <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785" stroke="white"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                </ul> --}}
                            <a href="{{ route('stript.subscription.checkout', $plan->uuid) }}"
                                class="btn-primary btn w-100 mt-3">Get started</a>
                        </div>

                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

</div>
