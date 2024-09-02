<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->ajax()) {
            $subscriptions = Subscription::query()
                ->with('user')
                ->latest()->get();
            dd($subscriptions->toArray());

            return DataTables::of($subscriptions)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->full_name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    if ($row->isBlocked()) {
                        $button = '<button type="button" name="unblock" data-id="' . $row->id . '" class="btn btn-danger btn-sm unblock">
                            <img src="https://img.icons8.com/ios/50/000000/lock.png" width="20" height="20" alt="unlock">
                        </button>';
                    } else {
                        $button = '<button type="button" name="block" data-id="' . $row->id . '" class="btn btn-info btn-sm block">
                            <img src="https://img.icons8.com/ios/50/000000/unlock.png" width="20" height="20" alt="lock">
                        </button>';
                    }

                    // $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('subscriptions.index');
    }
}
