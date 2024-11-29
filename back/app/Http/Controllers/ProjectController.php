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
        }else{
            $users = DB::table('users')->select('id', 'name')->where('role','=','worker')->get();
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
        $projects = DB::table('projects')->select('id','title', 'description', 'user_id', 'started_at', 'finished_at', 'status', 'squad')->where('user_id', '=', $request->id)->limit(2)->get();
        $count = DB::table('projects')->where('user_id', '=', $request->id)->count();
        return response()->json(['projects'=>$projects, 'count'=>$count]);
    }
    public function update_project_info(Request $request){
        $current_proj_info = DB::table('projects')->select('id','title','description','status')->where('id','=', $request->id_proj)->get();
        // $users = DB::table('users')->select('id','name')->where('role', '=', 'worker')->where('blocked','=',0)->get();
        return response()->json(['project'=>$current_proj_info]);
    }
    public function save_update_proj(Request $request){
        $id = strlen(trim($request->id_project))? $request->id_project : false;
        $title = strlen(trim($request->title))? $request->title : false;
        $desc = strlen(trim($request->description))? $request->description : false;
        $status = strlen(trim($request->status))? $request->status : false;
        $old_data = DB::table('projects')->select('title','description','status')->where('id','=', $id)->get()[0];
        if($id && $title && $desc && $status){
            if($old_data->title != $title || $old_data->description != $desc || $old_data->status != $status){
                // return response()->json('ch');
                $update = Project::where('id','=',$id)->update([
                    'title'=>$title, 
                    'description'=>$desc,
                    'status'=>$status
                ]);
                if($update){    
                    $mess = 'Успешное изменение проекта!';
                    $res = true;
                    $projects = DB::table('projects')->select('id','title', 'description', 'user_id', 'started_at', 'finished_at', 'status', 'squad')->where('user_id', '=', $request->id_user)->limit(2)->get();
                    $count = DB::table('projects')->where('user_id', '=', $request->id_user)->count();
                }
                else{
                    $mess = 'Не удалось изменить данные о проекте!';
                    $res = false;
                }
            }
            else{
                // return response()->json('noch');
                $mess = 'Измените хотя-бы одно поле!';
                $res = false;
            }
        }
        else{
            // return response()->json('fields');
            $mess = 'Заполните все поля!';
            $res = false;
        }
        if($res != true){
            return response()->json(['mess'=>$mess, 'res'=>$res]);
        }
        else{
            return response()->json(['mess'=>$mess, 'res'=>$res, 'projects'=>$projects, 'count'=>$count]);
        }
    }
    public function delete_project(Request $request){
        $delete = Project::where('id','=', $request->id_proj)->delete();
        if($delete){
            $mess = 'Проект удален!';
            $res = true;
            $projects = DB::table('projects')->select('id','title', 'description', 'user_id', 'started_at', 'finished_at', 'status', 'squad')->where('user_id', '=', $request->id_user)->limit(2)->get();
            $count = DB::table('projects')->where('user_id', '=', $request->id_user)->count();
            return response()->json(['mess'=>$mess, 'res'=>$res,'projects'=>$projects, 'count'=>$count]);
        }else{
            $mess = 'Не удалось удалить проект!';
            $res = false;
            return response()->json(['mess'=>$mess, 'res'=>$res]);
        }
        // return response()->json();
    }
    public function save_create_project(Request $request){
        // check title unique
    }
}


// INSERT INTO `projects` (`id`, `title`, `description`, `user_id`, `started_at`, `finished_at`, `status`, `squad`, `created_at`, `updated_at`) VALUES (NULL, 'Some project for test', 'description of \"Some project for test\"', '12', '2024-10-17', '2024-10-29', 'Завершен', '{\"squad\":[3,10]}', NULL, NULL);