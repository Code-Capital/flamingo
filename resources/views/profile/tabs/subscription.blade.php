<div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="pricingWrapper">
            @if (!$user->isSubscribed())
                <div class="text-center py-5">
                    <h2>Pricing Plans</h2>
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
                                <a href="{{ route('stripe.subscription.checkout', $plan->uuid) }}"
                                    class="btn-primary btn w-100 mt-3">Get started</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <div class="alert alert-warning text-center" role="alert">
                                No plans available
                            </div>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="row mx-0 mb-3">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-between pb-3">
                            <h3 class="marketHeading mb-0">Subscriptions</h3>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <table id="usersTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('User name') }}</th>
                                <th>{{ __('Subscription') }} name</th>
                                <th>Stripe id</th>
                                <th>Stripe status</th>
                                <th>{{ __('Ends at') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through the users data --}}
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
