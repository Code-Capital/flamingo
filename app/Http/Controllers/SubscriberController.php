<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
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

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('success', 'Unsubscribed successfully!');
    }
}
