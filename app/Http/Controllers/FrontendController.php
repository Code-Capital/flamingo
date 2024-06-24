<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function pricing(): View
    {
        return view('pricing');
    }

    public function terms(): View
    {
        return view('terms');
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function sendContact(Request $request): RedirectResponse
    {
        // Validate the form data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactMail($data));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
