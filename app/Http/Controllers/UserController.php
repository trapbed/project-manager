<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //
    public function all_users(){
        $users = ['users'=>User::paginate(10)];
        return view('pages/users', $users);
    }
}
