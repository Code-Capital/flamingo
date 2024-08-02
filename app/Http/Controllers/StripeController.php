<?php

namespace App\Http\Controllers;

use Stripe\Plan;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;
use App\Models\PricingPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Set Stripe API key
            $plans = PricingPlan::all();

            return DataTables::of($plans)
                ->addIndexColumn()
                ->addColumn('id', function ($plan) {
                    return $plan->id;
                })
                ->editColumn('amount', function ($plan) {
                    return '$' . number_format($plan->amount / 100, 2);
                })
                ->editColumn('interval', function ($plan) {
                    return ucfirst($plan->interval);
                })
                ->editColumn('status', function ($plan) {
                    return $plan->active ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($plan) {
                    // return $plan;
                    return '<button type="button" data-id="' . $plan->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stripe.plans.index');
    }

    public function create(): View
    {
        return view('stripe.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'interval' => ['required', 'string'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                Stripe::setApiKey(config('cashier.secret'));

                // Create a product
                $product = Product::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'type' => 'service', // or 'good' based on your needs
                    'active' => $request->status ?? true,
                    'description' => $request->description,
                ]);

                // create a price
                $price = Price::create([
                    'unit_amount' => $request->amount * 100, // Convert to cents
                    'currency' => 'usd',
                    'recurring' => ['interval' => $request->interval],
                    'product' => $product->id,
                ]);

                // Create a plan
                PricingPlan::create([
                    'uuid' => Str::uuid(),
                    'name' => $request->name,
                    'description' => $request->description,
                    'amount' => $request->amount,
                    'interval' => $request->interval,
                    'stripe_product_id' => $product->id,
                    'stripe_price_id' => $price->id,
                    'currency' => env('CASHIER_CURRENCY', 'usd'),
                    'status' => $request->status ?? true,
                ]);
            });
            return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.plans.create')->with('error', 'Error occured while creating plan.' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        // Set Stripe API key
        Stripe::setApiKey(config('cashier.secret'));

        // Retrieve the plan
        $plan = Plan::retrieve($id);

        // Delete the plan
        $plan->delete();

        return $this->sendSuccessResponse('Plan deleted successfully.');
    }
}
