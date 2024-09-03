<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('username', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed
    //         return redirect()->intended('/sipalingadminB$/articles'); // redirect to intended page
    //     } else {
    //         // Authentication failed
    //         return back()->withErrors([
    //             'username' => 'Incorrect credentials.',
    //             // 'username' => 'The provided credentials do not match our records.',
    //         ]);
    //     }
    // }

    public function login(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in using the provided credentials
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // If successful, redirect to the intended location or the admin dashboard
            return redirect()->intended('/sipalingadminB$/articles');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['login' => 'Incorrect credentials.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/sipalingadminB$');
    }
}
