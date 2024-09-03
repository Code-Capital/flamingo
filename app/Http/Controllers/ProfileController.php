<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Location;
use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laravel\Cashier\Subscription;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load(['interests', 'location']);
        $interests = Interest::all();
        $countries = Country::all();
        $selectedInterests = $user->interests->pluck('id')->toArray();
        $locations = Location::all();

        return view('profile.edit', get_defined_vars());
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $request->user()->interests()->sync($request->input('interests'));

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd($request->all());
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image'],
        ]);

        $request->user()->updateAvatar($request->file('avatar'));

        return Redirect::route('profile.edit')->with('success', 'Avatar update successfully!');
    }

    public function info(): View
    {
        $user = Auth::user();
        $userMedia = $user->media()->orderBy('created_at', 'desc')->get();
        $postMedia = $user->posts()->with('media')->latest()->get()->pluck('media')->flatten();
        $media = $userMedia->merge($postMedia);

        $requests = $user->receivedRequests;
        $friends = $user->acceptedFriends;
        $blockedUsers = $user->blockedFriends;

        $peoples = $user->byInterests($user->interests->pluck('id')->toArray())
            ->byNotUser($user->id)
            ->limit(10)
            ->get();

        $subscriptions = Subscription::where('user_id', $user->id)->get();
        $plans = Plan::all();

        return view('profile.info', get_defined_vars());
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'password', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Password updated successfully');
    }
}
