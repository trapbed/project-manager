<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js\tasks_api.js"></script>
<script src="../js/task_manager_api.js"></script>
                  

<div id="left_block">
   <div id="search_select">
      <div id="create_something" onclick="create_task_modal()">
      <div class="create"><img src="/img/group 189.svg" alt=""></div>
   </div>
      <form >
         <select onchange="tasks_with_filter()" name="" id="">
            <option value="">Приоритет</option>
            <option value="Низкий">Низкий</option>
            <option value="Средний">Средний</option>
            <option value="Высокий">Высокий</option>
         </select>
      </form>
   </div>
   <div id="infoRows">
      <table class="table">
         <thead>
           <tr id="infoRowHeader">
            <td class="taskN">Название задачи</td>
            <td class="taskD">Описание</td>
            <td class="taskNP">Название проекта</td>
            <!-- <td class="taskM">Руководитель</td> -->
            <td class="taskW"> Исполнитель</td>
            <td class="taskP">Приоритет</td>
            <td class="taskE">Осталось</td>
            <td class="taskS">Статус</td>
            <td class="taskA">Действия</td>
         </tr> 
         </thead>
         
         <tbody id="tasksTable">

         </tbody>
      </table>
   </div>
   <div id="paginate">
      
   </div>
</div>

<script src="../js/script.js"></script>
</body>
</html>