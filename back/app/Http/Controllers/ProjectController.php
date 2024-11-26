<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;



class ProjectController extends Controller
{
    public function all_projects(){
        $projects_db = DB::table('projects')->
        select('projects.id as project_id','projects.title','projects.description','users.name','projects.status','projects.started_at', 'projects.finished_at')->
        join('users', 'users.id','=', 'projects.user_id')->limit(8)->get();
        return response()->json(['projects'=>$projects_db, 'count'=>Project::latest()->count()]);
    }
    public function get_projects_on_page(Request $request){
        $page = $request->page_id;
        $offset = $page*8-8;
        $projects_db = DB::table('projects')->
        select('projects.id as project_id','projects.title','projects.description','users.name','projects.status','projects.started_at', 'projects.finished_at')->
        join('users', 'users.id','=', 'projects.user_id')->limit(8)->offset($offset)->get();
        return response()->json(['projects'=>$projects_db, 'count'=>Project::latest()->count()]);
    }
    public function get_info_one_project(Request $request){
        $project = DB::table('projects')->
        select('projects.id','title','description','users.name','started_at','finished_at','status', 'squad')
        ->where('projects.id', '=', $request->project_id)
        ->join('users', 'users.id','=', 'projects.user_id')->get();
        
        $arr_squad = [];
        foreach(json_decode($project[0]->squad) as $squad_r){
            $squad = $squad_r;
            foreach($squad as $user){
                $user_n = DB::table('users')->select('id','name')->where('id', $user)->get();
                $arr_squad[$user_n[0]->id] = $user_n[0]->name;
            }
        }
        $users = DB::table('users')->select('name')->where('role', '=', 'worker')->get();
        return response()->json(['project'=>$project, 'users'=>$users, 'squad'=>$arr_squad]);
    }
    public function update_squad(Request $request){
        if($request->squad != null && count($request->squad)>0){
            $condition = [];
            foreach($request->squad as $user){
                array_push($condition, ['id' , '!=',$user]);
            }
            $users = DB::table('users')->select('id', 'name')->where($condition)->where('role','=','worker')->get();
            // $count = DB::table('users')->select('id', 'name')->where($condition)->where('role','=','worker')->count();
        }else{
            $users = DB::table('users')->select('id', 'name')->where('role','=','worker')->get();
            // $count = DB::table('users')->select('id', 'name')->where('role','=','worker')->count();
        }
        
        return response()->json(['users'=>$users]);
    }
    public function save_update_squad(Request $request){
        $old_squad = json_decode(DB::table('projects')->select('squad')->where('id', '=', $request->project_id)->get('squad')[0]->squad);
        $new_worker_in_squad = intval(substr($request->form_data, 5));
        array_push($old_squad->squad, $new_worker_in_squad);
        $new_squad = json_encode($old_squad);
        $update_squad = DB::table('projects')->where('id', '=', $request->project_id)->update(['squad'=>$new_squad]);
        if($update_squad){
            $mess = 'Команда увеличилась!';
        }
        else{
            $mess = 'Не удалось добавить сотрудника!(';
        }
        $project = DB::table('projects')->
        select('projects.id','title','description','users.name','started_at','finished_at','status', 'squad')
        ->where('projects.id', '=', $request->project_id)
        ->join('users', 'users.id','=', 'projects.user_id')->get();
        $arr_squad = [];
        foreach(json_decode($project[0]->squad) as $squad_r){
            $squad = $squad_r;
            foreach($squad as $user){
                $user_n = DB::table('users')->select('id','name')->where('id', $user)->get();
                $arr_squad[$user_n[0]->id] = $user_n[0]->name;
            }
        }
        $users = DB::table('users')->select('name')->where('role', '=', 'worker')->get();
        return response()->json(['mess'=>$mess, 'project'=>$project, 'users'=>$users, 'squad'=>$arr_squad]);
    }
    public function delete_from_squad(Request $request){

    }

    public function get_projects_title(){
        $today = date('Y-m-d');
        $titles = DB::table('projects')->where('finished_at', '>=',$today)->select('id','title')->get();
        return response()->json($titles);
    }


    public function projects_info_admin(Request $request){
        $projects = DB::table('projects')->select('title', 'description', 'user_id', 'started_at', 'finished_at', 'status', 'squad')->where('user_id', '=', $request->id)->get();
        $count = DB::table('projects')->where('user_id', '=', $request->id)->count();
        return response()->json(['projects'=>$projects, 'count'=>$count]);
    }
}
