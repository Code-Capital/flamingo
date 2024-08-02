<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('checkout.index');
    }

    public function checkout(Request $request, $productID, $priceID)
    {
        Stripe::setApiKey(config('cashier.secret'));
        return $request->user()
            ->newSubscription($productID, $priceID)
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
}
