<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DogsInformation;
use App\Models\Media;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load(['interests', 'location', 'userInfo']);
        $interests = Interest::all();
        $countries = Country::all();
        $selectedInterests = $user->interests->pluck('id')->toArray();
        $locations = Location::all();
        $dogs_information = DogsInformation::all();

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

        $request->user()->userInfo()->update([
            'municipality' => $request->input('municipality'),
            'dog_breed' => $request->input('dog_breed'),
            'dog_gender' => $request->input('dog_gender'),
            'kennel_club' => $request->input('kennel_club'),
            'dog_working_club' => $request->input('dog_working_club'),
            'dog_withers_height' => $request->input('dog_withers_height'),
            'weight' => $request->input('weight'),
            'size' => $request->input('size'),
            'castrated' => $request->input('castrated'),
            'target' => $request->input('target'),
            'furr' => $request->input('furr'),
            'drawing' => $request->input('drawing'),
            'hills' => $request->input('hills'),
        ]);

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

        $peoples = getPeoples($user);

        $subscriptions = Subscription::where('user_id', $user->id)->get();
        $plans = Plan::all();

        $settingsArray = Setting::first()->toArray();
        $filteredSettings = array_filter($settingsArray, function ($key) {
            return strpos($key, 'sub_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $settings = $filteredSettings;

        return view('profile.info', get_defined_vars());
    }

    public function pendingRequests(): View
    {
        $user = Auth::user();
        $requests = $user->receivedRequests;

        return view('user.pending-requests', get_defined_vars());
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Correctly validate current password
            'password' => ['required', 'string', 'min:8', 'confirmed'], // New password validation
        ]);

        // Update the user's password
        $user = $request->user();
        $user->password = Hash::make($request->input('password')); // 'password' is the name from form input
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Password updated successfully');
    }



    public function deleteImage(Request $request, $id)
    {
        $image = Media::findOrFail($id);
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}
