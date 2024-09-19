@extends('layouts.dashboard')
@section('title', 'Confirmation')
@section('styles')
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12">
                <div class="bg-white px-4 dashboardCard py-5">
                    <div class="row mx-auto  justify-content-center">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center justify-content-center confirmation">
                                <img class="img-fluid" src="assets/confirmation.png">
                                <h4>{{ __('Subscription') }} Confirmed</h4>
                                <p class="text-center">Congratulations! 🎉 You've successfully purchased your
                                    {{ __('subscription') }} plan. Get ready to unlock premium access, exclusive content,
                                    ad-free
                                    browsing, priority support, and join our vibrant community.</p>
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
