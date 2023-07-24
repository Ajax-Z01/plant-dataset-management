<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    function redirect() {
        return Socialite::driver('google')->redirect();
    }

    function callback() {
        $googleUser = Socialite::driver('google')->user();
        // dd($googleUser);
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'avatar' => $googleUser->avatar,
            'password' => encrypt('admin@123')
        ]);
 
    Auth::login($user);
    // dd($googleUser->avatar);
 
    return redirect('/dashboard');

    }
}