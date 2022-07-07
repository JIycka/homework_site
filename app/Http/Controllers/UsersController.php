<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController
{
    public function authorize()
    {
        return true;
    }

    public function index()
    {
        $users = User::query()->orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:255', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        User::create($request->all());

        return redirect()->route('users.index');
    }

    public function show($id)
    {

    }

    public function edit(int $id)
    {
        $user = User::query()->find($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
            'password' => ['required', 'min:8', 'max:255', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::query()->find($request->id);
        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
