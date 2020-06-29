<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Hash;
use Str;

class LoginController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {
        if ($service === 'twitter'){

            $user = Socialite::driver($service)->stateless()->user();
        }
        else
        {
            $user = Socialite::driver($service)->user();
        }

       $user = User::firstorCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);
        Auth::login($user, true);

        return redirect('/');
    }

  /*  public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $user = User::firstorCreate([
           'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);
        Auth::login($user, true);

        return redirect('/');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $user = User::firstorCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);
        Auth::login($user, true);

        return redirect('/');
    }*/
}
