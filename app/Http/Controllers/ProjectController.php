<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    //
    public function all_projects(){
        if(Auth::user()->role == 'manager'){
        $id_user = Auth::user()->id;
            $projects = ['projects' => Project::latest()->where('user_id', $id_user)->get()];
        }
        else{
            $projects = ['projects' => Project::latest()->get()];
        }
        return view('pages/projects', $projects);
    }

    // public function manager_projects(){
    //     $projects = ['projects'=>Project::latest()->where('user_id', $id_user)->get()];
    //     return view('pages/projects', $projects);
    // }
}
