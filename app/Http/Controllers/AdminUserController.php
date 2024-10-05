<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin-users', [
            'users' => User::where('name', '!=', 'adminB$')->get()
        ]);
    }
}
