<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subscriber::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->full_name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="delete btn
                    btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('subscribers.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:subscribers'],
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'is_active' => true,
        ]);

        return to_route('home')->with('success', 'You have successfully subscribed!');
    }

    public function destroy(Request $request, Subscriber $subscriber)
    {
        $delete = $subscriber->delete();
        if ($request->ajax()) {
            return $this->sendSuccessResponse(null, 'Subscriber deleted successfully');
        }
    }
}
