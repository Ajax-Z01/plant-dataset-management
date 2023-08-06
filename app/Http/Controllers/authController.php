<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // Mendapatkan nilai remember dari input form

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->is_active == 1) {
                return redirect()->route('dashboard')->withSuccess("Welcome to Dashboard Admin");
            } else {
                return redirect()->route('login')->withUnsuccess("Your account is not approved. Please contact the administrator.");
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    function callback()
    {
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
