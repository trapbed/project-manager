<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Models\User;
class AuthController extends Controller
{
    public function login(Request $request){
        // $credentals = $request->validate([
        //     'email'=>['required', 'email'],
        //     'password'=>['required'],
        // ]);

        if(strlen(trim($request->email))>0 && strlen(trim($request->password))>0){
            $user = User::where('email', $request->email)->exists();
            if($user == true){
                $user = User::where('email', $request->email)->get();
                foreach($user as $field){
                    $email = $field->email;
                    $pass = $field->password;
                    $blocked = $field->blocked;
                }
        
                if($blocked == '0'){
                    if(Hash::check($request->password,$pass)){
                        if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']]) ){
                            return response()->json(['mess'=>'Успешная авторизация!', 'role'=>Auth::user()->role, 'email'=>$email, 'id'=>Auth::id(),'name'=>Auth::user()->name, 'res'=>true]);
                        }
                        else{
                            return response()->json(['mess'=>'Не удалось войти!']);
                        }
                    }
                    else{
                        return response()->json(['mess'=>'Неверный пароль!']);
                    }
                }
                else{
                    return response()->json(['mess'=>'Ваш профиль заблокирован!']);
                }
            }
            else{
                return response()->json(['mess'=>'Такого пользователя нет, проверьте логин!']);
            }
        }
        else{
            return response()->json(['mess'=>'Заполните все поля!']);
        }        
    }

    public function logout(){
        Auth::logout();
        return response()->json('Вы вышли из аккаунта');
    }
}
