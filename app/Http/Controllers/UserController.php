<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $inputs = $request->validate([
            'email' => 'required|email|string|unique:users',
            'name' => 'required|string|min:3',
            'dateOfBirth' => 'required|date',
            'phoneNum' => 'required|string|min:11|starts_with:0',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'email' => $inputs['email'],
            'name' => $inputs['name'],
            'dateOfBirth' => $inputs['dateOfBirth'],
            'phoneNum' => $inputs['phoneNum'],
            'password' => bcrypt($inputs['password']),
        ]);

        return response(['user' => $user]);
    }

    public function login(Request $request){
        $inputs = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email',$inputs['email'])->first();

        if(!$user || !Hash::check($inputs['password'],$user['password'])){
            return response(['invalid email or password'],401);
        }

        return response(['message' => 'logged successfully']);
    }

    public function getUser($id){
        $user = User::find($id);

        if(!$user) return response(['message' => 'user not found'],404);

        return response(['user' => $user]);
    }

    public function getAllUsers(){
        return User::all();
    }

    public function updateUserInfo($id,Request $request){
        $request->validate([
            'email' => 'email|string|unique:users',
            'name' => 'min:3|string',
            'dateOfBirth' => 'date',
            'phoneNum' => 'string|min:11|starts_with:0',
        ]);

        $user = User::find($id);
        
        if(!$user) return response(['message' => 'user not found'],404);

        $user->update($request->all());

        return response(['user' => $user]);
    }

    public function deleteUser($id){
        $user = User::find($id);

        if(!$user) return response(['message' => 'user not found'],404);

        $user->delete();

        return response(['message' => 'deleted successfully']);
    }
}
