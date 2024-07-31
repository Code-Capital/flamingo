<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function force(Request $request): View
    {
        return view('profile.edit-bkp', [
            'user' => $request->user(),
        ]);
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

        return Redirect::route('profile.edit')->with('success', 'Profile avatar Updated!');
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

        return view('profile.info', get_defined_vars());
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return Redirect::back()->with('error', 'The provided password does not match your current password');
        }

        $user = $request->user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Password updated successfully');
    }
}
