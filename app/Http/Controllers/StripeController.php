<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            Stripe::setApiKey(config('cashier.secret'));

            // Retrieve all plans from Stripe
            $plans = Plan::all([
                'limit' => 100, // Adjust the limit if necessary
            ]);

            // Retrieve product details for the plans
            $planData = $plans->data;
            foreach ($planData as &$plan) {
                $product = Product::retrieve($plan->product);
                $plan->plan_id = $plan->id;
                $plan->product_description = $product->description;
                $plan->product_name = $product->name;
            }


            return DataTables::of($planData)
                ->addIndexColumn()
                ->addColumn('id', function ($plan) {
                    return $plan->id;
                })
                ->addColumn('name', function ($plan) {
                    return $plan->product_name;
                })
                ->addColumn('description', function ($plan) {
                    return $plan->product_description;
                })
                ->addColumn('amount', function ($plan) {
                    return '$' . number_format($plan->amount / 100, 2);
                })
                ->addColumn('interval', function ($plan) {
                    return ucfirst($plan->interval);
                })
                ->addColumn('status', function ($plan) {
                    return $plan->active ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($plan) {
                    // return $plan;
                    return '<button type="button" data-id="' . $plan->plan_id . '" class="btn btn-danger btn-sm delete">Delete</button>';
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

        // Set Stripe API key
        Stripe::setApiKey(config('cashier.secret'));

        // Create a product
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => 'service', // or 'good' based on your needs
            'active' => $request->status ?? true,
        ]);

        // Create a subscription plan
        $plan = Plan::create([
            'nickname' => $request->input('name'),
            'amount' => $request->input('amount') * 100, // Amount in cents
            'interval' => $request->input('interval'), // e.g., 'month'
            'currency' => env('CASHIER_CURRENCY', 'usd'),
            'product' => $product->id,
        ]);

        return to_route('admin.plans.index')->with('success', 'Plan created successfully.');
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
