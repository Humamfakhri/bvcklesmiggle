<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
        ]);

        // Opsi untuk login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman yang diinginkan setelah registrasi
        return redirect()->route('home')->with('success', 'Registration successful!');
    }

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
            return redirect()->intended('/');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['login' => 'Incorrect credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
