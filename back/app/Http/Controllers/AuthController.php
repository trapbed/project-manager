<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Models\User;
class AuthController extends Controller
{
    public function login(Request $request){
        $credentals = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required'],
        ]);

        $user = User::where('email', $request->email)->get();
        foreach($user as $field){
            $email = $field->email;
            $pass = $field->password;
            $blocked = $field->blocked;
        }

        if($blocked == '0'){
            if($email == $request['email']){
                if(Hash::check($request['password'],$pass)){
                    if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']]) ){
                        return response()->json(['mess'=>'Успешная авторизация!', 'role'=>Auth::user()->role, 'email'=>Auth::user()->email, 'id'=>Auth::user()->id,'name'=>Auth::user()->name]);
                    }
                    else{
                        return response()->json('Не удалось войти!');
                    }
                }
                return response()->json('Неверный пароль!');
            }
            else{
                return response()->json('Такого пользователя нет, проверьте логин!');
            }

            if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])){
                return response()->json(['mess'=>'Успешная авторизация!', 'role'=>Auth::user()->role, 'name'=>Auth::user()->name]);
            }
            else{
                return response()->json(['mess'=>'Такого пользователя нет, проверьте!']);
            }
        }
        else{
            return response()->json(['mess'=>'Ваш профиль заблокирован!', 'blocked'=>'true']);
        }
    }

    public function logout(){
        // if(Auth::logout()){
        //     $mess = 'Вы вышли из аккаунта!';
        // }
        // else{
        //     $mess = 'Не удалось выйти из аккаунта!';
        // }
        Auth::logout();
        return response()->json('Вы вышли из аккаунта');
    }
}
