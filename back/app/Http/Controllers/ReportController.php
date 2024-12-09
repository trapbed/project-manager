<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class ReportController extends Controller
{
    public function get_data_for_report(Request $request){
        $aspect = $request->aspect;
        if($aspect == 'worker'){
            $data = DB::table('users')->select('id', 'name')->where('role','=', 'worker')->get();
        }
        else if($aspect == 'project'){
            $data = DB::table('projects')->select('id', 'title as name')->get();
        }
        return response()->json($data);
    }
    
    public function get_data_to_create_report(Request $request){
        $res = false;
        $aspect = $request->aspect;
        $time = $request->time;
        $today = date('Y-m-d');
        $x_ago = '';
        switch($time){
            case 'year':
                // $plus = '';
                $interval = 365;
                $x_ago = date('Y-m-d', strtotime('-1 year', strtotime($today)));
                break;
            case 'month':
                // $plus = '';
                $interval = 31;
                $x_ago = date('Y-m-d', strtotime('-1 month', strtotime($today)));
                break;
            case 'week':
                // $plus = '';
                $interval = 7;
                $x_ago = date('Y-m-d', strtotime('-1 week', strtotime($today)));
                break;
        }
        $id = $request->data;
        $abc = 'c';
        if($aspect == 'worker'){
            $abc = 'a';
            $report =  DB::table('tasks')->select('title','status','started_at', 'finished_at')->where('user_id', '=',$id)->where('started_at', '>', $x_ago)->where('status', '!=', 'Назначена')->where('started_at', '<', $today) ->get();
            
        }
        else if($aspect == 'project'){
            $abc = 'b';
            $report = DB::table('tasks')->select('title','status','started_at','finished_at')->where('project_id', '=',$id)->where('started_at', '>', $x_ago)->where('status', '!=', 'Назначена')->where('started_at', '<', $today) ->get();
            
        }
        // foreach($report as $key=>$value){
        //     $array[$key] .=  $value->title ;
        //     // $array = $array_titles_field[$count_fields];
        //     // $array[$array_titles_field[$count_fields]] = $value->$array_titles_field[$count_fields];
        //     // $report = json_decode($value, true);
        //     // $report= $value->title;
        //     $count_fields++;
        //     // $report[$key] =  json_decode($value, true);
        // }

        // $count = 0;
        // foreach($report as $key=>$value){
        //     // $array[$count] = json_decode($value[$count]);
        //     array_push($array, array_values((array)$report));
        //     $count++;
        //     // $report .= json_decode($re);

        // }

        
        

        

        // return response()->json([$time, $aspect, $today, $x_ago]);
        // return response()->json(['report'=>$report, 'abc'=>$abc, 'id'=>$id]);
        // return response()->json(['form_data'=>$request, 'report'=>$report]);
        // return response()->json($request);
        // return response()->json(['mess'=>$mess,'res'=>$res]);
        return response()->json(['aspect'=>$aspect, 'id'=>$id, 'report'=>$report]);
        // return response()->json([$array]);

    }
    public function create_report(Request $request  ){
        // $report = substr($request->report, 0, -1);
        // $report = mb_substr($report, 1);
        // $report = "{".$report."}";
        $report = json_encode($request->report, JSON_UNESCAPED_UNICODE);
        $res = false;
        $aspect = $request->aspect;
        $id = $request->id;
        $id_creator = $request->id_creator;
        // if(count($report) == 0 ){
        //     $mess = 'Нет данных для создания отчета!';
        // }
        // else{
        //     $create_admin_report = Report::create([
        //         'type'=>$aspect,
        //         'aspect_id'=>$id,
        //         'date_report'=>date('Y-m-d'),
        //         'user_id'=>$id_creator
        //     ]);
        //     if($create_admin_report){
        //         $mess = 'Успешное создание отчета!';
        //         $res = true;
        //     }
        //     else{
        //         $mess = 'Не удалось создать отчет!';
        //     }
        // }
        // return response()->json(json_encode($request->report, JSON_UNESCAPED_UNICODE));
        return response()->json($report);
    }
    
}
