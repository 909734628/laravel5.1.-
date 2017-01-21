<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }
    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show')->with('user',$user);
    }
    public function store(Request $request){
        $this->validate($request,['name'=>'required|max:50','email'=>'required|email|unique:users|max:255','password' => 'required|confirmed']);
        $user = User::create(['name'=>$request->name,'email' => $request->email,
            'password' => $request->password]);
        Auth::login($user);
        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',$user->id);
    }
}
