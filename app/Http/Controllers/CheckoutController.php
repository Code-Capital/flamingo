<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
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

    public function cancelSubscription(Request $request, ?User $user = null)
    {
        try {
            $user = $user ?: $request->user();
            $user->subscription('default')->cancel();

            return $this->sendSuccessResponse(null, 'Subscription cancelled successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while cancelling subscription '.$th->getMessage());
        }
    }

    public function resumeSubscription(Request $request, ?User $user = null)
    {
        try {
            $user = $user ?: $request->user();
            $user->subscription('default')->resume();

            return $this->sendSuccessResponse(null, 'Subscription resumed successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while resuming subscription '.$th->getMessage());
        }
    }
}
