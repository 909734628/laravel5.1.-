<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }
    public function store(Request $request){
        $this->validate($request,['email'=>'required|email|max:255','password'=>'required']);
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials,$request->has('remember'))) {
            $request->session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()->id]);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }
    }
}
