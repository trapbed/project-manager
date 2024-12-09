<?php
    require 'layouts/header.php';
    // require "../js/users_api.js";
?>
<!-- <script src="../js/mess.js"></script> -->
<script src="../js/users_api.js"></script>
   <div class="back_modal">
        <div class="modal" id="modal_create_user">
            <img src="/img/x.svg" alt="" class="close_modal">
            <h1 class="title_modal">Создание пользователя</h1>
            <form method="post" id="form_create_user">
                <label>Имя пользователя
                    <input type="text" name="name">
                </label>
                <label>Почта
                    <input type="email" name="email">
                </label>
                <label>Роль
                    <select name="role" id="">
                        <option value="">Роль</option>
                        <option value="manager">manager</option>
                        <option value="worker">worker</option>
                    </select>
                </label>
                <label>Пароль
                    <input type="password" name="password" type="password">
                </label>
                <input class="submit_btn" type="submit" value="Создать">
            </form>
        </div>
   </div>
    

   <div id="left_block">
      <div id="search_select">
         <div class="create"><img src="/img/group 189.svg" alt=""></div>
      </div>

      <div id="infoRows" class="no_height">
         <table class="table" id="usersTable">
            <tr id="infoRowHeader" class="fixed">
               <td class="userN">Имя пользователя</td>
               <td class="userE">Почта</td>
               <td class="userR">Роль</td>
               <td class="userA">Действия</td>
            </tr>
            <!-- <tr class="infoRow">
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
            </tr> -->
         </table>
      </div>

      <div id="pagination">

        </div>
   </div>

<script src="../js/script.js"></script>
</body>
</html>