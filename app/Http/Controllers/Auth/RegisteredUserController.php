<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\County;
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
        $countries = Country::select('id', 'name')->get();
        $counties = County::select('id', 'name')->get();

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'], // 'last_name' is a new field that we added to the 'users' table
            'user_name' => ['required', 'string', 'max:255', 'unique:' . User::class], // 'user_name' is a new field that we added to the 'users' table
            'interests' => ['required', 'array'], // 'exists' rule checks if the value exists in the 'interests' table with the column 'id
            'interests.*' => ['exists:interests,id'], // 'interests.*' means that each value in the 'interests' array should be validated against the 'exists' rule
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'age' => ['nullable', 'integer',], // 'age' is a new field that we added to the 'users' table
            'country_id' => ['nullable', 'exists:countries,id'], // 'country_id' is a new field that we added to the 'users' table
            'county_id' => ['nullable', 'exists:counties,id'], // 'county_id' is a new field that we added to the 'users' table
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'age' => $request->age,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'is_private' => $request->is_private ?? 0,
            'country_id' => $request->country_id,
            'county_id' => $request->county_id,
        ]);

        $user->assignRole('user');
        $user->interests()->attach($request->interests);

        $user->userInfo()->create([
            'municipality' => null,
        ]);

        // $user->markEmailAsVerified();
        if ($user->messenger_color || $user->messenger_color == null) {
            $user->update([
                'messenger_color' => '#d63384',
                'active_status' => 1,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
