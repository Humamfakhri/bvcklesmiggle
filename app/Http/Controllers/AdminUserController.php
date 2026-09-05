<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin-users', [
            'users' => User::where('is_admin', false)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required'     => 'Name is required.',
            'username.required' => 'Username is required.',
            'username.unique'   => 'That username is already taken.',
            'email.required'    => 'Email is required.',
            'email.unique'      => 'That email is already registered.',
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        User::create([
            'name'     => strip_tags($validatedData['name']),
            'username' => strip_tags($validatedData['username']),
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => false,
        ]);

        return redirect()->route('admin-users.index')->with('success', 'User has been created successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting admin accounts through this route
        if ($user->is_admin) {
            return redirect()->route('admin-users.index')->with('error', 'Admin accounts cannot be deleted from this panel.');
        }

        $user->delete();

        return redirect()->route('admin-users.index')->with('success', 'User has been deleted successfully!');
    }
}
