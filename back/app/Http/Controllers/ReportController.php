<?php

namespace App\Http\Controllers;

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
    
    public function create_report(Request $request){
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
            $report = DB::table('tasks')->select('title','status','started_at', 'finished_at')->where('user_id', '=',$id)->where('started_at', '>', $x_ago)->where('status', '!=', 'Назначена')->where('started_at', '<', $today) ->get();
            
        }
        else if($aspect == 'project'){
            $abc = 'b';
            $report = DB::table('tasks')->select('title','status','started_at','finished_at')->where('project_id', '=',$id)->where('started_at', '>', $x_ago)->where('status', '!=', 'Назначена')->where('started_at', '<', $today) ->get();
            
        }
        


        // return response()->json([$time, $aspect, $today, $x_ago]);
        return response()->json(['report'=>$report, 'abc'=>$abc, 'id'=>$id]);
    }
    
}
