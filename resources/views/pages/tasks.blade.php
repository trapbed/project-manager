@extends('layouts.left-navbar')
@section('title', 'Задачи')
@section('content')
   <?php
   use App\Models\Task;
   use App\Models\Project;
   use App\Models\Report;
   use App\Models\User;
      //  dump(Auth::user()->name);
   ?> 

   <div id="left_block">
      <div id="search_select">
         <form action="">
            <input type="search" name="" id=""> 
            <select name="" id="">
               <option value="">Рейтинг</option>
               <option value="">Высокий</option>
               <option value="">Средний</option>
               <option value="">Низкий</option>
            </select>
         </form>
      </div>

      <div id="infoRows">
         <table class="table">
            <tr id="infoRowHeader">
               <td class="taskN">Название задачи</td>
               <td class="taskD">Описание</td>
               <td class="taskNP">Название проекта</td>
               <td class="taskM">Руководитель</td>
               <td class="taskW"> Исполнитель</td>
               <td class="taskP">Приоритет</td>
               <td class="taskE">Окончание</td>
               <td class="taskS">Статус</td>
               <td class="taskA">Действия</td>
            </tr>
         @foreach ($tasks as $task)
            <!-- {{$task->title}} -->
            <tr class="infoRow">
               <td class="taskN">{{$task->title}}</td>
               <td class="taskD"><a href="desc/task/{{$task->id}}">Смотреть</a></td>
               <?php
                   $project = Project::where('id', $task->project_id)->get('title');
                   foreach($project as $row){
                     $name_proj = $row -> title;
                   }
               ?>
               <td class="taskNP">{{$name_proj}}</td>
               <td class="taskM">{{$task->user->name}}</td>
               <?php
                  $manager = User::where('id', $task->project_id)->get('name');
                  foreach($manager as $prop){
                     $manager= $prop->name;
                  }
               ?>
               <td class="taskW">{{$manager}}</td>
               <td class="taskP">
                  <div class="onlyTaskPriority">
                     <img src="/img/priority/{{$task->priority}}.svg" alt="">
                     <span>{{$task->priority}}</span>
                  </div>
               </td>
               <td class="taskE">{{date('d. m. Y', strtotime($task->finished_at))}}</td>
               <td class="taskS">{{$task->status}}</td>
               <td class="taskA">
                  @if ($manager  ==  Auth::user()->name)
                     <div class="BTWAct">
                           <a href="edit/user/{{$task->id}}">
                              <img src="/img/edit.png" alt="">
                           </a>
                     
                           <a href="delete/user/{{$task->id}}">
                              <img src="/img/delete.png" alt="">
                           </a> 
                     </div>
                  @endif
               </td>
            </tr>
         @endforeach
         </table>
      </div>

      <div id="pagination">
         {{ $tasks->links('pagination::custom') }}
      </div>
   </div>
@endsection