<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsers(){
        return view('admin.users');
    }

    public function getAllUsers()
    {
        $users = User::get();
        return response()->json(['users' => $users], 200);
    }

    public function saveUser(Request $request){
        // $user = new User($request->all());
        // $user->save();
        // return response()->json(['User' => $user], 200);

        dd($request);
    }
}
