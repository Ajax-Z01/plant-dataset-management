<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:5', 'max:20'],
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        Auth::login($user);

        return redirect()->route('login')->withSuccess('Your account has been successfully registered. Please wait until your account is approved by the administrator.');
    }
}
