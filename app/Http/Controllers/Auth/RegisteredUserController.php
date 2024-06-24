<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $interests = Interest::select('id', 'name')->get();

        return view('auth.register', get_defined_vars());
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'], // 'last_name' is a new field that we added to the 'users' table
            'user_name' => ['required', 'string', 'max:255', 'unique:'.User::class], // 'user_name' is a new field that we added to the 'users' table
            'interests' => ['required', 'array'], // 'exists' rule checks if the value exists in the 'interests' table with the column 'id
            'interests.*' => ['exists:interests,id'], // 'interests.*' means that each value in the 'interests' array should be validated against the 'exists' rule
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_name' => $request->user_name,
        ]);

        $user->interests()->attach($request->interests);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
