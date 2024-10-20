@extends('layouts.left-navbar')
@section('title', 'Пользователи')
@section('content')
   <?php
   use App\Models\Task;
   use App\Models\Project;
   use App\Models\Report;
   use App\Models\User;
    //    dump(auth()->user());
   ?> 

   <div class="back_modal">
        <div class="modal" id="modal_create_user">
            <img src="/img/x.svg" alt="" class="close_modal">
            <h1 class="title_modal">Создание пользователя</h1>
            <form action="" id="form_create_user">
                <label>Имя пользователя
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
         <div class="create"><img src="/img/group 189.svg" alt=""></div>
      </div>

      <div id="infoRows">
         <table class="table">
            <tr id="infoRowHeader">
               <td class="userN">Имя пользователя</td>
               <td class="userE">Почта</td>
               <td class="userR">Роль</td>
               <td class="userA">Действия</td>
            </tr>
         @foreach ($users as $user)
            <tr class="infoRow">
                <td class="userN">{{$user->name}}</td>
                <td class="userE">{{$user->email}}</td>
                <td class="userR">{{$user->role}}</td>
                <td class="userA">
                    <div class="BTWAct">
                        <a href="edit/user/{{$user->id}}">
                            <img src="/img/edit-user.png" alt="">
                        </a>
                    
                        <a href="delete/user/{{$user->id}}">
                            <img src="/img/delete-document.png" alt="">
                        </a> 
                    </div>
                </td>
            </tr>
         @endforeach
         </table>
      </div>

      <div id="pagination">
         {{ $users->links('pagination::custom') }}
      </div>
   </div>
@endsection