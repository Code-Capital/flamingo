@extends('layouts.app')
@section('title', 'Pricing')
@section('styles')
@endsection
@section('content')
    <div class="pricingWrapper pb-5">
        <div class="container">
            <div class="text-center py-5">
                <h2>{{__("Pricing Plans")}}</h2>
                {{-- <p>Choose the plan that best fits your needs</p>
                <div class="d-flex align-items-center gap-4 toggler justify-content-center">
                    <span>Monthly</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                    <span>Annually</span>
                </div> --}}
            </div>
            <div class="row align-items-stretch">
                @if (!$isSubscribed)
                    @forelse ($plans as $plan)
                        <div class="col-lg-5 mb-4 mx-auto">
                            <div class="pricingCard px-5 pt-3 pb-5 h-100">
                                <div class="text-end">
                                    <div class="badge bg-white px-3">{{__("Popular")}}</div>
                                </div>
                                <div class="d-flex gap-3">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <img src=" {{ asset('assets/icon5.svg') }} " alt="">
                                    </div>
                                    <div class="text">
                                        {{-- <p class="mb-2">{{ $plan->name }}</p> --}}
                                        <h6>{{ $plan->name }}</h6>
                                    </div>
                                </div>
                                <p class="text pe-5 pt-3">{{ $plan->description }}</p>
                                <div class="heading mb-4"><span class="h2">{{ env('CASHIER_CURRENCY_SYMBOL', '$') }}
                                        {{ $plan->amount }}</span><span class="month">/
                                        {{ getInterval($plan->interval) }}</span>
                                </div>
                                @if ($settings)
                                    <h5 class="mb-3">{{__("What’s included")}}</h5>
                                    <ul class="list-unstyled">
                                        @forelse ($settings as $key => $setting)
                                            <li class="mb-4">
                                                <span>
                                                    <svg width="26" height="27" viewBox="0 0 26 27" fill="#DE296A"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_1_69)">
                                                            <path
                                                                d="M13 26.5C20.1799 26.5 26 20.6799 26 13.5C26 6.3201 20.1799 0.5 13 0.5C5.8201 0.5 0 6.3201 0 13.5C0 20.6799 5.8201 26.5 13 26.5Z" />
                                                            <path d="M7.1167 14.3406L10.4785 17.7024L18.8831 9.29785"
                                                                stroke="white" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_1_69">
                                                                <rect width="26" height="26" fill="white"
                                                                    transform="translate(0 0.5)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                                <span>Total
                                                    {{ str_replace('count', '', str_replace('_', ' ', str_replace('sub_', '', $key))) }}
                                                    ({{ $setting }})
                                                </span>
                                            </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                @endif
                                <a href="{{ route('stripe.subscription.checkout', $plan->uuid) }}"
                                    class="btn-primary btn w-100 mt-3">{{__("Get started")}}</a>
                            </div>
                        </div>
                    @empty
                        <x-no-data-found />
                    @endforelse
                @else
                    <!-- Content to show when the user is subscribed -->
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            <strong>{{('You')}}'re already subscribed!</strong> Thank {{('you')}} for being a part of our service.
                            If {{('you')}} need any assistance or want to upgrade {{('you')}}r plan, please <a>view your
                                {{ __('subscription') }}
                                details</a>.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
