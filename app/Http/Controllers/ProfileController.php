<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $request->validateWithBag('userDeletion', [
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

        return Redirect::route('profile.edit')->with('success', 'Avatar Updated!');
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
}
