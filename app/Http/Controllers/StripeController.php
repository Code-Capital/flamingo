<?php

namespace App\Http\Controllers;

use App\Models\Plan as ModelsPlan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\Plan;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;
use Yajra\DataTables\DataTables;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Set Stripe API key
            $plans = ModelsPlan::get();

            return DataTables::of($plans)
                ->addIndexColumn()
                ->addColumn('id', function ($plan) {
                    return $plan->id;
                })
                ->editColumn('amount', function ($plan) {
                    return '$' . number_format($plan->amount, 2);
                })
                ->editColumn('interval', function ($plan) {
                    return ucfirst($plan->interval);
                })
                ->editColumn('status', function ($plan) {
                    return $plan->status ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($plan) {
                    // return $plan;
                    return '<button type="button" data-id="' . $plan->id . '" class="btn btn-danger btn-sm delete" disabled>Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $planCount = ModelsPlan::count();

        return view('stripe.plans.index', get_defined_vars());
    }

    public function create(): View|RedirectResponse
    {
        if (ModelsPlan::count() > 0) {
            return redirect()->route('admin.plans.index')->with('error', 'You can only create one plan.');
        }

        return view('stripe.plans.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            // 'amount' => ['required', 'numeric',],
            'interval' => ['required', 'string'],
        ]);

        try {
            // Wrap the Stripe and DB operations in a transaction
            DB::transaction(function () use ($request) {
                // Set the Stripe API key
                Stripe::setApiKey(config('cashier.secret'));

                $plan = Plan::create([
                    'amount' => $request->amount ? $request->amount * 100 : 0,
                    'currency' => env('CASHIER_CURRENCY', 'usd'),
                    'interval' => $request->interval,
                    'product' => [
                        'name' => $request->name,
                        // 'description' => $request->description,
                    ],
                ]);

                // Save the plan in your local database
                ModelsPlan::create([
                    'uuid' => Str::uuid(),
                    'name' => $request->name,
                    'description' => $request->description,
                    'amount' => $request->amount,
                    'interval' => $request->interval,
                    'stripe_product_id' => $request->stripe_product_id ?? null,
                    'stripe_price_id' => $request->stripe_price_id ?? null,
                    'stripe_plan_id' => $plan->id,
                    'currency' => env('CASHIER_CURRENCY', 'usd'),
                    'status' => $request->status ?? true,
                ]);
            });

            // Redirect to the plans index with a success message
            return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
        } catch (\Throwable $th) {
            // Handle any errors that occurred during the process
            return redirect()->route('admin.plans.create')->with('error', 'Error occurred while creating the plan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pricingPlan = ModelsPlan::findOrFail($id);
            Stripe::setApiKey(config('cashier.secret'));

            $price = Price::retrieve($pricingPlan->stripe_price_id);
            dd($price->toArray());
            $price->delete();

            // Retrieve and delete the product associated with the plan
            $product = Product::retrieve($pricingPlan->stripe_product_id);
            $product->delete();

            // Delete the plan from your local database
            $pricingPlan->delete();

            // Return a success response
            return $this->sendSuccessResponse('Plan deleted successfully.');
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return $this->sendErrorResponse('Error occurred while deleting the plan: ' . $e->getMessage());
        }
    }
}
