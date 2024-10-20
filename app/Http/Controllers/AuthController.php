<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class AuthController extends Controller
{
    //
    public function login(Request $request){
        $request->validate([
            'email'=>['required','email'],
            'pass'=>['required'],
        ]);
        $user = User::where('email',$request->email)->get();
        foreach($user as $row){
            $name = $row->name;
            $pass = $row->password;
            $id = $row->id;
            $role = $row->role;
        }

        if($pass == $request->pass){
            Auth::login(User::find($id));
            // echo 'dsd';
            return redirect()->route('tasks');
        }
        else{
            return response('Неверные данные');
        }
    }
}
