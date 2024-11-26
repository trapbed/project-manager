<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
 
use App\Models\Task; 

use Illuminate\Support\Facades\DB;
use Response;


class TaskController extends Controller 
{ 
    // 
    public function all_tasks(){ 
        // $tasks = ['tasks'=>Task::latest()->get(), 'count'=>Task::latest()->count()]; 
        // return response()->json($tasks); 
        
        $tasks_all = DB::table('tasks')->select('tasks.id as tasks_id', 'projects.id as project_id','tasks.title as title_task','projects.title as title_project','users.name as worker','tasks.priority','tasks.finished_at', 'tasks.status')-> 
        join('projects', 'projects.id','=', 'tasks.project_id')-> 
        join('users', 'users.id', '=', 'tasks.user_id')-> 
        limit(8)->offset(0)->get(); 
 
        return response()->json(['tasks'=>$tasks_all, 'count'=>Task::latest()->count()]); 
    } 
    public function get_tasks_on_page(Request $request){ 
        // $limit = ; 
        $page = $request->page_id; 
        if($page == 1){ 
             
        } 
        $offset = $page*8-8; 
        $tasks = DB::table('tasks')->select('tasks.id as tasks_id', 'projects.id as project_id','tasks.title as title_task','projects.title as title_project','users.name as worker','tasks.priority','tasks.finished_at', 'tasks.status')-> 
        join('projects', 'projects.id','=', 'tasks.project_id')-> 
        join('users', 'users.id', '=', 'tasks.user_id')-> 
        limit(8)->offset($offset)->get(); 
 
         
        return response()->json($tasks); 
    } 
    public function get_manager_of_project(Request $request){ 
        $manager_p = DB::table('projects')->select('users.name')->where('users.id','projects.user.id')-> 
        join('users', 'users.id', 'projects.user_id', '=', 'users.id')->get(); 
        return response()->json($manager_p); 
    } 
    public function one_task_more(Request $request){ 
        $task_info = DB::table('tasks')-> 
        join('users', 'users.id', '=', 'tasks.user_id')-> 
        select('users.name', 'tasks.id', 'tasks.title', 'tasks.description', 'tasks.project_id')-> 
        where('tasks.id', $request->id)-> 
        get(); 
        
        $boss = DB::table('users')->join('projects', 'users.id', '=', 'projects.user_id')-> 
        where('projects.id',$task_info[0]->project_id)-> 
        select('users.name')->get(); 
        $info_task_boss = ['task_worker'=>$task_info[0], 'boss'=>$boss[0]]; 
        return response()->json($info_task_boss); 
    } 
    
    public function get_info_form_create_task(Request $request){
        $id_project = (int) substr($request->project_id, 11);
        $squad = (array) json_decode(DB::table('projects')->select('squad')->where('id','=', $id_project)->get()[0]->squad);
        $squad = $squad['squad'];
        $arr_from_n_worker = [];
        foreach($squad as $worker_id){
            $worker = DB::table('users')->select('id','name')->where('id','=',$worker_id)->get()[0];
            $arr_from_n_worker[$worker->id] = $worker->name;
        }
        $project_info = DB::table('projects')->select('id','title','started_at', 'finished_at')->where('id','=', $id_project)->get();
        return response()->json(['info'=>$project_info,'arr'=>$arr_from_n_worker,'request'=>$request]);
    }
    public function save_create_task(Request $request){
        // $task = Task::create([])
        // $ = isset($request)?:;
        $id_proj =isset($request->id_project) ? $request->id_project: false;
        $title = (strlen(trim($request->title))>0)? $request->title : false;
        $desc = (strlen(trim($request->description))>0) ? $request->description : false;
        $start = isset($request->started_at) ? $request->started_at: false;
        $finish = isset($request->finished_at) ? $request->finished_at: false;
        $worker = isset($request->worker) ? $request->worker: false;
        $priority = isset($request->priority) ? $request->priority: false;
        if($id_proj && $title && $desc && $start && $finish && $worker && $worker && $priority){
            $task = Task::create([
                'title'=>$title,
                'description'=>$desc,
                'project_id'=>$id_proj,
                'started_at'=>$start,
                'finished_at'=>$finish,
                'user_id'=>$worker,
                'priority'=>$priority,
                'status'=>'Назначена'
            ]);
            if($task){
                $mess = 'Успешное создание задачи!';
                $res = true;
            }   
            else{
                $mess = 'Не удалось назначить задачу!';
                $res = false;
            }
        }
        else{
            $mess = 'Заполните все поля!';
            $res =false;
        }
        // $project_id = DB::table('projects')->select('title')->where('id','=',$request->id_project)->get()[0];
        return response()->json(['mess'=>$mess, 'res'=>$res]);
    }
}