<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['edit', 'update','destroy']
        ]);
        $this->middleware('guest',[
           'only' => ['create']
        ]);
    }
    public function index(){
        $users = User::paginate(30);
        return view('users.index')->with('users',$users);
    }
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
    public function edit($id){
        $user = User::findOrFail($id);
        $this->authorize('update',$user);
        return view('users.edit')->with('user',$user);
    }
    public function update($id,Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);
        $user = User::findOrfail($id);
        $this->authorize('update',$user);
        $data = array_filter(['name' => $request->name,
            'password' => $request->password
        ]);
        $user->update($data);
        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show',$id);

    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success','成功删除用户！');
        return redirect()->back();
    }
}
