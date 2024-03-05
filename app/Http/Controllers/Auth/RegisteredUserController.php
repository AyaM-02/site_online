<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender'=> $request->gender,
            //je zet de ingevoerede gegevens van de form gelijk aan de birthdate in de database 
            'birthdate' => $request->birthdate,
        ]);

        event(new Registered($user));

        $achievement = new achievement;
        $achievement->user_id = $user->id;
        $achievement->title = "new user";
        $achievement->picture_url = "icons/trofee.jpg"; 
        $achievement->achievement_date = Carbon::now();
        $achievement->save();

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
