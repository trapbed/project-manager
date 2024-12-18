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
        $role = $request->role;
        $id = $request->id;
        if($aspect == 'worker'){
            $data = DB::table('users')->select('id', 'name')->where('role','=', 'worker')->get();
        }
        else if($aspect == 'project'){
            if($role == 'manager'){
                $data = DB::table('projects')->where('user_id','=', $request->id)->select('id', 'title as name')->get();
            }
            else if($role == 'admin'){
                $data = DB::table('projects')->select('id', 'title as name')->get();
            }
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
            $report =  DB::table('tasks')
            ->select('title','status','started_at', 'finished_at')
            ->where('user_id', '=',$id)
            ->where('started_at', '>', $x_ago)
            ->whereBetween('started_at', [$x_ago, $today])
            ->get()->toArray();
            $new_report = [];
            $count = 0;
            foreach($report as $r=>$k){
                // array_push($new_report, json_decode(json_encode($k), true));
                // $new_report[] =  $k;
                $new_report[$count] = $k;
                $count++;
            }
        }
        else if($aspect == 'project'){
            $abc = 'a';
            $report =  DB::table('tasks')
            ->select('title','status','started_at', 'finished_at')
            ->where('project_id', '=',$id)
            ->where('status', '!=', 'Назначена')
            ->whereBetween('started_at', [$x_ago, $today])
            ->get()->toArray();
            $new_report = [];
            $count = 0;
            foreach($report as $r=>$k){
                // array_push($new_report, json_decode(json_encode($k), true));
                // $new_report[] =  $k;
                $new_report[$count] = $k;
                $count++;
            }            
        }
        return response()->json(['aspect'=>$aspect, 'id'=>$id, 'n_report'=>$new_report, 'report'=>$report, 'interval'=>$request->time]);

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
       
        // return response()->json(['aspect'=>$aspect, 'id'=>$id, 'report'=>$new_report]);
       
        // return response()->json([$array]);

    }
    public function create_report(Request $request  ){
        // $report = substr($request->report, 0, -1);
        // $report = mb_substr($report, 1);
        // $report = "{".$report."}";
        // $report = json_encode($request->report, JSON_UNESCAPED_UNICODE);
        $res = false;
        $aspect = $request->aspect;
        $id = $request->id;
        $interval = $request->interval;
        $id_creator = $request->id_creator;
        if( $request->report == null ){
            $mess = 'Нет данных для создания отчета!';
        }
        else{
                $create_admin_report = Report::create([
                    'aspect'=>$aspect,
                    'aspect_id'=>$id,
                    'date_report'=>date('Y-m-d'),
                    'user_id'=>$id_creator,
                    'statistics'=>json_encode((object) $request->report, JSON_UNESCAPED_UNICODE),
                    'interval'=>$interval
                     ]);
                if($create_admin_report){
                    $mess = 'Успешное создание отчета!';
                    $res = true;
                                $role = $request->role;
                                $reports = false;
                                $aspect = $request->aspect != '' && $request->aspect != null ? $request->aspect : false;
                                if($role == 'admin'){
                                    $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval');
                                    if($aspect){
                                        $reports = $reports->where('aspect','=', $aspect);
                                    }
                                    $reports = $reports->get();
                                }
                                else if($role == 'manager'){
                                    $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval')->where('user_id', '=',$request->id_creator);
                                    // if($aspect){
                                    //     $reports = $reports->where('aspect','=', $aspect);
                                    // }
                                    $reports = $reports->get();
                                }
                                else if($role == 'worker'){
                                    $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval')->where('user_id', '=',$request->id_creator);
                                    // if($aspect){
                                    //     $reports = $reports->where('aspect','=', $aspect);
                                    // }
                                    $reports = $reports->get();
                                }
                }
                else{
                    $mess = 'Не удалось создать отчет!';
                }
            
            
        }
        return response()->json([
            'mess'=>$mess, 'res'=>$res, 'report'=>$reports, 
            'count'=>$request->report]);
        // return response()->json(json_encode((object) $request->report, JSON_UNESCAPED_UNICODE));
        // return response()->json($request);
    }

    public function get_reports(Request $request){
        $role = $request->role;
        $reports = false;
        $aspect = $request->aspect != '' && $request->aspect != null ? $request->aspect : false;
        if($role == 'admin'){
            $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval');
            if($aspect){
                $reports = $reports->where('aspect','=', $aspect);
            }
            $reports = $reports->get();
        }
        else if($role == 'manager'){
            $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval')->where('user_id', '=',$request->id_user);
            // if($aspect){
            //     $reports = $reports->where('aspect','=', $aspect);
            // }
            $reports = $reports->get();
        }
        else if($role == 'worker'){
            $reports = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval')->where('user_id', '=',$request->id_user);
            // if($aspect){
            //     $reports = $reports->where('aspect','=', $aspect);
            // }
            $reports = $reports->get();
        }
        return response()->json(['report'=> $reports]);
    }

    public function get_info_one_rep(Request $request){
        $report = DB::table('reports')->select('id','aspect', 'aspect_id', 'date_report', 'user_id', 'statistics', 'interval')->where('id', '=', $request->id)->get()[0];
        $creator = DB::table('users')->select('name')->where('id', '=', $report->user_id)->get()[0]->name;
        $title_or_name = '';
        if($report->aspect == 'worker'){
            $title_or_name = DB::table('users')->select('name')->where('id', '=', $report->aspect_id)->get()[0]->name;
        }else if($report->aspect == 'project'){
            $title_or_name = DB::table('projects')->select('title')->where('id', '=', $report->aspect_id)->get()[0]->title;
        }
        return response()->json([$creator, $report->date_report, $report->aspect, $report->statistics, $title_or_name, $report->interval]);
    }
    
}
