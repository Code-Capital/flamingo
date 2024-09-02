<?php

namespace App\Http\Controllers\Admin;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Laravel\Cashier\Subscription;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $subscriptions = Subscription::query()
                ->with(['user:id,first_name,last_name'])
                ->latest()->get();


            return DataTables::of($subscriptions)
                ->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row?->user?->full_name ?? 'Guest';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->editColumn('ends_at', function ($row) {
                    return $row->ends_at ? $row->ends_at->format('d/m/Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return 'actions here';
                })
                ->rawColumns(['full_name', 'action'])
                ->make(true);
        }
        return view('subscriptions.index');
    }
}
