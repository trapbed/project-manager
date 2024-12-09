<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; 

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function all_users(){
        $users = DB::table('users')->select('users.id','users.name','users.email','users.role', 'users.blocked')->get();
        $count = User::latest()->count();
        return response()->json(['users'=>$users, 'count'=>$count]);
    }

    public function blocked_user(Request $request){
        $mess = 'Не удалось изменить!';
        if($request->now_blocked == '0'){
            $blocked = '1';
            $mess = 'Пользователь заблокирован!';
        }
        else if($request->now_blocked == '1'){
            $blocked = '0';
            $mess = 'Пользователь разблокирован!';
        }
        
        $bloced_action = DB::table('users')->where('id', $request->id)
        ->update(['blocked'=>$blocked]);

        if($bloced_action){
            $users = DB::table('users')->select('users.id','users.name','users.email','users.role', 'users.blocked')->get();
            $count = User::latest()->count();
            
            return response()->json(['mess'=>$mess,'users'=>$users, 'count'=>$count]);
        }
        else{
            return response()->json(['mess'=>'Не удалось изменить информацию!']);
        }
    }

    public function create_user(Request $request){
        $res = false;
        $name = isset($request->name) ? $request->name : false;
        $email = isset($request->email) ? $request->email : false;
        $role = isset($request->role) ? $request->role : false;
        $password = isset($request->password) ? $request->password : false;
        if($name != false || $email != false || $role!= false || $password!=false){
            if(mb_strlen($password) < 8){
                $mess = 'Длина пароля должна быть не менее 8!';
            }
            else if(!ctype_alnum($password)){
                $mess = 'Допустимые символы пароля: буквы и цифры!';
            }
            else{
                $user = User::create([
                    'name'=>$name,
                    'email'=>$email,
                    'role'=>$role,
                    'password'=>Hash::make($password),
                ]);
                if($user){
                    $mess = 'Пользователь создан!';
                    $res = true;
                }
                else{
                    $mess = 'Не удалось созать пользователя';
                }
            }
        }
        else{
            $mess = 'Заполните все поля!';
        }
        $users = DB::table('users')->select('users.id','users.name','users.email','users.role', 'users.blocked')->get();
        $count = User::latest()->count();
        return response()->json(['mess'=>$mess,'users'=>$users, 'count'=>$count, 'res'=>$res]);
    }
}
