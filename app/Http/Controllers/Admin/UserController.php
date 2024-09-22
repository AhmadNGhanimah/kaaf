<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.users', compact('users'));
    }
    public function toggleAdmin($id)
    {
        $user = User::find($id);
        $user->role_as = !$user->role_as;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
