@extends('layouts.app')
@section('title', 'Pricing')
@section('styles')
@endsection
@section('content')
    <div class="pricingWrapper pb-5">
        <div class="container">
            <div class="text-center py-5">
                <h2>Pricing Plans</h2>
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
                                    <div class="badge bg-white px-3">Popular</div>
                                </div>
                                <div class="d-flex gap-3">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <img src=" {{ asset('assets/icon5.svg') }} " alt="">
                                    </div>
                                    <div class="text">
                                        <p class="mb-2">{{ $plan->name }}</p>
                                        <h6>Pro</h6>
                                    </div>
                                </div>
                                <p class="text pe-5 pt-3">Ideal for individuals and small teams</p>
                                <div class="heading mb-4"><span
                                        class="h2">{{ env('CASHIER_CURRENCY_SYMBOL', '$') }}{{ $plan->amount }}</span><span
                                        class="month">/ {{ getInterval($plan->interval) }}</span>
                                </div>
                                <a href="{{ route('stripe.subscription.checkout', $plan->uuid) }}"
                                    class="btn-primary btn w-100 mt-3">Get started</a>
                            </div>
                        </div>
                    @empty
                        <x-no-data-found />
                    @endforelse
                @else
                    <!-- Content to show when the user is subscribed -->
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            <strong>You're already subscribed!</strong> Thank you for being a part of our service.
                            If you need any assistance or want to upgrade your plan, please <a>view your subscription
                                details</a>.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
