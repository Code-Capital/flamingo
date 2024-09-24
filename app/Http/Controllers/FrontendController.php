<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\HomePage;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\TermsAndConditions;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class FrontendController extends Controller
{
    public function home(): View
    {
        $faqs = Faq::get();
        $homePage = HomePage::with('features')->first();
        // dd($homePage->toArray());
        return view('home', get_defined_vars());
    }

    public function pricing(): View
    {
        $plans = Plan::active()->get();
        $isSubscribed = Auth::user() ? Auth::user()->isSubscribed() : false;
        $settingsArray = Setting::first()->toArray();
        // Filter the keys that start with 'sub_'
        $filteredSettings = array_filter($settingsArray, function ($key) {
            return strpos($key, 'sub_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $settings = $filteredSettings;
        // dd($settings);

        return view('pricing', get_defined_vars());
    }

    public function terms(): View
    {
        $terms = TermsAndConditions::latest()->first();

        return view('terms', get_defined_vars());
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function verification(): View
    {
        return view('verification');
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            Mail::to(config('mail.from.address'))->send(new ContactMail($data));
            return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('contact')->with('error', 'An error occurred while sending your message. Please try again later.');
        }
    }
}
