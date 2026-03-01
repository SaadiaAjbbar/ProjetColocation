<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function bannedUsers()
    {
        $users = User::where('is_banni', true)->get();
        return view('admin.users.banned', compact('users'));
    }
}
