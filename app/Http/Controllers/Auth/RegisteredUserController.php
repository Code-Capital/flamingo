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
        $request->validate(
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['nullable', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'interests' => ['required', 'array'],
                'interests.*' => ['exists:interests,id'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
                'age' => ['nullable', 'integer'],
                'country_id' => ['nullable', 'exists:countries,id'],
                'county_id' => ['nullable', 'exists:counties,id'],
            ],
            [
                // English Custom Messages
                'first_name.required' => __('First name is required.'),
                'user_name.required' => __('User name is required.'),
                'user_name.unique' => __('The username is already taken, please choose a new one.'),
                'email.unique' => __('The email is already taken, please choose a different one.'),
                'email.email' => __('Please enter a valid email address.'),
                'interests.required' => __('You must select at least one interest.'),
                'interests.*.exists' => __('The selected interest is invalid.'),
                'password.required' => __('Password is required.'),
                'password.confirmed' => __('Password confirmation does not match.'),
                'country_id.exists' => __('The selected country is invalid.'),
                'county_id.exists' => __('The selected county is invalid.'),

                // Swedish Custom Messages
                'first_name.required' => __('Förnamn är obligatoriskt.'),
                'user_name.required' => __('Användarnamn är obligatoriskt.'),
                'user_name.unique' => __('Användarnamnet är upptaget, välj ett nytt.'),
                'email.unique' => __('E-postadressen är redan upptagen, välj en annan.'),
                'email.email' => __('Vänligen ange en giltig e-postadress.'),
                'interests.required' => __('Du måste välja minst ett intresse.'),
                'interests.*.exists' => __('Det valda intresset är ogiltigt.'),
                'password.required' => __('Lösenord är obligatoriskt.'),
                'password.confirmed' => __('Lösenordsbekräftelsen matchar inte.'),
                'country_id.exists' => __('Det valda landet är ogiltigt.'),
                'county_id.exists' => __('Det valda länet är ogiltigt.'),
            ]
        );


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
