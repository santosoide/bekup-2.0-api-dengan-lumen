<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

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

}
