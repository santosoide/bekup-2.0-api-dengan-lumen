<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{

    public function index()
    {
        return User::paginate();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        
        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user =  User::find($id);

        $user->delete();

        return "User berhasil di delete";
    }

    public function token(JWTAuth $jwt)
    {
        return $jwt->parseToken()->toUser();
    }

    public function postLogin(Request $request, JWTAuth $jwt)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|string'
        ]);

        if (! $token = $jwt->attempt($request->only(['email', 'password']))) {
            return response()->json(['user_not_found'], 404);
        }

        return response()->json(compact('token'));
    }

}
