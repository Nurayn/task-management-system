<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function all()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }
}
