<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->route('admin.users');
    }

    public function edit(User $user)
    {
        return view('admin.editUser', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('admin.users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        return view('admin.detailUser', compact('user'));
    }
}
