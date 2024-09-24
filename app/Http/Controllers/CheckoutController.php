<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('checkout.index');
    }

    public function checkout(Request $request, Plan $plan)
    {
        if ($request->user()->isSubscribed()) {
            return redirect()->route('home');
        }

        Stripe::setApiKey(config('cashier.secret'));

        return $request->user()
            ->newSubscription('default', $plan->stripe_plan_id)
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
        abort(403, 'Subscription cancelled');
    }
}
