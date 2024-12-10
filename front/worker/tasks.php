<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js\tasks_worker_api.js"></script>


<div id="left_block">
   <div id="search_select">
      <form >
         <select onchange="tasks_with_filter()" name="" id="priority_filter">
            <option value="">Приоритет</option>
            <option value="Низкий">Низкий</option>
            <option value="Средний">Средний</option>
            <option value="Высокий">Высокий</option>
         </select>
      </form>
   </div>

   <div id="infoRows">
      <table class="table" id="tasksTable">
         <tr id="infoRowHeader">
            <td class="taskN worker_task_N">Название задачи</td>
            <td class="taskD worker_task_D">Осталось дней</td>
            <td class="taskNP worker_task_P">Приоритет</td>
            <!-- <td class="taskM">Руководитель</td> -->
            <td class="taskW worker_task_S"> Статус</td>
            <td class="taskP worker_task_M">Подробнее</td>
            <td class="taskE worker_task_C">Комментарии</td>
         </tr>
      </table>
   </div>
   <div id="paginate">
      
   </div>
</div>

<script src="../js/script.js"></script>
</body>
</html>