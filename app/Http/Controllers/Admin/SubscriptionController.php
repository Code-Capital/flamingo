<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Stripe\Stripe;
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
                ->editColumn('sub_name', function ($row) {
                    return ucfirst($row->type);
                })
                ->editColumn('stripe_status', function ($row) {
                    return ucfirst($row->stripe_status);
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->editColumn('ends_at', function ($row) {
                    return $row->ends_at ? $row->ends_at->format('d/m/Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $user = Auth::user();
                    // uncomment after testing
                    if ($user->id === $row->user_id) {
                        return 'No action available';
                    }
                    if ($row->ends_at) {
                        return '<button type="button" name="resume" data-id="'.e($row->user_id).'" class="resume btn btn-warning btn-sm">Resume</button>';
                    } else {
                        return '<button type="button" name="cancel" data-id="'.e($row->user_id).'" class="cancel btn btn-danger btn-sm">Cancel</button>';
                    }
                })

                ->rawColumns(['full_name', 'stripe_status', 'action'])
                ->make(true);
        }

        return view('subscriptions.index');
    }
}
