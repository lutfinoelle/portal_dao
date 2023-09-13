<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('no_pn', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('auth.login')->with('error', 'Your email or password is incorrect.');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }
}
