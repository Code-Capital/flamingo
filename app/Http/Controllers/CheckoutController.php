<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('checkout.index');
    }

    public function checkout(Request $request, PricingPlan $pricingPlan)
    {
        Stripe::setApiKey(config('cashier.secret'));

        return $request->user()
            ->newSubscription('default', $pricingPlan->stripe_plan_id)
            ->checkout([
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);
    }

    public function success(Request $request)
    {
        return view('test.confirmation');
    }

    public function cancel(Request $request)
    {
        dd('cancelled');
    }

    public function cancelSubscription(Request $request)
    {
        $request->user()->subscription('default')->cancel();

        return redirect()->route('profile.edit')->with('success', 'Subscription cancelled successfully');
    }

    public function resumeSubscription(Request $request)
    {
        $request->user()->subscription('default')->resume();

        return redirect()->route('profile.edit')->with('success', 'Subscription resumed successfully');
    }
}
