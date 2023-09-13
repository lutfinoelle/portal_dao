<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'no_pn' => 'required|unique:users',
                'password' => 'required|min:6',
                'role' => 'required',
            ]);
    
            $user = new User();
            $user->name = $request->name;
            $user->no_pn = $request->no_pn;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required',
                'no_pn' => 'required|unique:users,no_pn,' . $user->id,
                'password' => 'nullable|min:6',
                'role' => 'required',
            ]);
    
            $user->name = $request->name;
            $user->no_pn = $request->no_pn;
            $user->password = $request->password ? bcrypt($request->password) : $user->password;
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
