<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
    public function showUsers()
    {
        return view('admin.users');
    }

    public function getAllUsers()
    {
        $users = User::get();
        return response()->json(['users' => $users], 200);
    }

    public function getAllRoles()
    {
        $roles = Role::all()->pluck('name');
        return response()->json(['roles' => $roles], 200);
    }

    public function getAnUser(User $user)
    {
        return response()->json(['user' => $user], 200);
    }


    public function saveUser(CreateUserRequest $request)
    {
        $user = new User($request->all());
        $user->save();
        $role = $request->input('role');
        if ($role === 'admin') {
            $user->assignRole('admin');
        } elseif ($role === 'user') {
            $user->assignRole('user');
        }

    }

    public function updateUser(User $user, Request $request)
    {
        $role = $request->input('role');
        if ($role === 'admin') {
            $user->assignRole('admin');
        } elseif ($role === 'user') {
            $user->assignRole('user');
        }
        $user->update($request->all());
        return response()->json(['User' => $user], 201);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }

    public function newUser(CreateUserRequest $request)
    {
        $user = new User($request->all());
        $user->save();
        $user->assignRole('user');
        return redirect()->route('login');
    }
}
