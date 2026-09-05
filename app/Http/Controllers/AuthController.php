<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index() {
        return view('admin-login');
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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials) && Auth::user()->is_admin) {
            return redirect()->intended('/admin/articles');
        }

        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->back()->withErrors(['login' => 'Incorrect admin credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
}
