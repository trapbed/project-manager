<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    //
    public function all_tasks(){
        $tasks = ['tasks'=>Task::paginate(10)];
        return view('pages/tasks', $tasks);
    }
}
