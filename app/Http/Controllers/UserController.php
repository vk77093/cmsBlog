<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return view('auth.userIndex',compact('users'));
    }
    public function makeAdmin(User $user){

$user->role='admin';
        $user->save();
        //print_r($user->toSql());
       // print_r($user->getBindings());
        session()->flash('sucess', 'The user Got update');
        return redirect('/user');



    }
    public function edit(){
        //$user=User::all();
        //return view('auth.userEdit',compact('user'));
        return view('auth.userEdit')->with('user',auth()->user());

    }

    public function update(Request $request, $id){

        $errors = $request->validate([
            'name' => 'required|min:5|max:20',
            'about_us'=>'required',
        ]);
        $data=$request->all();
        $user=User::findOrFail($id);
        $user->name=$data['name'];
        $user->about_us=$data['about_us'];
        $user->save();
        session()->flash('sucess', 'User Got Update');
        return redirect('/user');


    }
}

