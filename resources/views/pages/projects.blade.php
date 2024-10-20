@extends('layouts.left-navbar')
@section('title', 'Проекты')
@section('content')

<?php
    use App\Models\User;
    use App\Models\Task;
?>

<div class="back_modal">
    <div class="modal" id="modal_create_user">
        <img src="/img/x.svg" alt="" class="close_modal">
        <h1 class="title_modal">Создание проекта</h1>
        <form action="" id="form_create_user">
            <label>Название проекта
                <input type="text">
            </label>
            <label>Почта
                <input type="text">
            </label>
            <label>Роль
                <select name="" id="">
                    <option value="">Роль</option>
                    <option value="admin">admin</option>
                    <option value="manager">manager</option>
                    <option value="worker">worker</option>
                </select>
            </label>
            <label>Пароль
                <input type="pass">
            </label>
            <input class="submit_btn" type="submit" value="Создать">
        </form>
    </div>
</div>


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
    @if (Auth::user()->role == 'manager')
        <div id="search_select">
            <div class="create"><img src="/img/group 189.svg" alt=""></div>
        </div>
    @endif



      <div id="infoRows" class="scroll">
            @if (Auth::user()->role != 'manager')
            
            <table class="table">
                <tr id="infoRowHeader">
                <td class="taskN">Название проекта</td>
                <td class="taskD">Описание</td>
                <td class="taskM">Руководитель</td>
                <td class="taskW">Статус</td>
                <td class="taskP">Дата начала</td>
                <td class="taskE">Дата окончания</td>
                <td class="taskS">Подробнее</td>
                <td class="taskA">Действия</td>
                </tr>

                @foreach ($projects as $project)
                    <tr class="infoRow">
                        <td class="taskN">{{$project->title}}</td>
                        <td class="taskD"><a href="desc/project/{{$project->id}}">Описание</a></td>
                        <?php
                            $name_manager = User::where('id', $project->user_id)->get('name');
                            foreach($name_manager as $manager){
                                $manager_name = $manager->name;
                            }
                        ?>
                        <td class="taskM">{{$manager_name}}</td>
                        <td class="taskW">{{$project->status}}</td>
                        <td class="taskP">{{date("d. m. Y", strtotime($project->started_at))}}</td>
                        <td class="taskE">{{date("d. m. Y", strtotime($project->finished_at))}}</td>
                        <td class="taskS"><a href="more/project/{{$project->id}}">Подробнее</a></td>
                        <td class="taskA">
                            <div class="BTWAct">
                                <a href="edit/user/{{$project->id}}">
                                    <img src="/img/edit.png" alt="">
                                </a>
                            
                                <a href="delete/user/{{$project->id}}">
                                    <img src="/img/delete.png" alt="">
                                </a> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
        <?php
            $count_now = 0;
        ?>
        @foreach ($projects as $project)

        <div class="oneProject">
            <div class="titleOneProject">{{$project->title}}</div>
            <div class="oneProjSeeMore more">
                Подробнее
            </div>
            <div class="moreOneProj">
                <hr class="BTWOneProj">
                <div class="oneProjMoreInfo">
                    <div class="dateStatusOne">
                        <div class="row1">Дата начала: {{$project->started_at}}</div>
                        <div class="row2">Дата окончания: {{$project->finished_at}}</div>
                        <?php
                        if(date('Y-m-d', strtotime($project->finished_at)) < date('Y-m-d')){
                            $days = 'Завершен';
                        }
                        else if(date('Y-m-d', strtotime($project->finished_at)) == date('Y-m-d')){
                            $days = 'Последний день!';
                        }
                        else{
                            $days_sec = strtotime( $project->finished_at)-strtotime( date('Y-m-d'));
                            $days = $days_sec/(24*60*60);
                        }
                            
                        ?>
                        <div class="row3">Осталось дней: {{$days}}</div>
                        <div class="row4">Статус: {{$project->status}}</div>
                    </div>
                    <div class="tasksOneProj">
                        <?php
                            // $count = 
                            $tasks = Task::where('project_id', $project->id)->get();
                            $count = count($tasks);
                            $passed = count(Task::where('project_id', $project->id)->where('status', 'Выполняется')->get());
                            $processed = $count-$passed;
                        ?>
                        <div class="allinfoTasksOneProj">
                            <div class="row1">Задач: {{$count}}</div>
                            <div class="row2">Выполнено: {{$passed}}</div>
                            <div class="row3">Осталось: {{$processed}}</div>
                        </div>
                        @if(count($tasks) != 0)
                        <div class="scheudleTasksOneProj">
                            <span class="more seeTasks">Смотреть задачи &#9650;</span>
                            <!--  -->
                            <table class="tasksOneProject">
                                <tr>
                                    <td class="nameTaskProj">Название задачи</td>
                                    <td class="workerTaskProj">Исполнитель</td>
                                    <td class="statusTaskProj">Статус</td>
                                    <td class="endTaskProj">Окончание</td>
                                </tr>
                                @foreach ($tasks as $task)
                                    <tr class="taskRowOneProj">
                                        <td class="nameTaskProj">{{$task->title}}</td>
                                        <?php
                                            $user_n = User::where('id', $task->user_id)->get('name');
                                            foreach($user_n as $user){
                                                $user_name = $user->name;
                                            }
                                        ?>
                                        <td class="workerTaskProj">{{$user_name}}</td>
                                        <td class="statusTaskProj">{{$task->status}}</td>
                                        <td class="endTaskProj">{{date('d. m. Y', strtotime($task->finished_at))}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @endif
                    </div>
                    <?php
                        $count_now++;
                    ?>
                    <div class="descOneProj">
                        <span>Описание:</span>
                        <span class="more descOneProjMore">Смотреть</span>
                        <div class="descOneProjHide"><span>{{$project->description}}</span> <span class="more hideDescOneProj">Скрыть</span></div>
                    </div>
                    <div class="btnsOneProj">

                    </div>
                </div>
            </div>
        </div>
        
        @if (count($projects) > $count_now)
            <div class="BTWonProj"></div>
        @endif

        @endforeach

        @endif
      </div>


</div>
<script src="js/projects_script.js"></script>

@endsection('content')

