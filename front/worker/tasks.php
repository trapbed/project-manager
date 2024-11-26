<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js\tasks_api.js"></script>

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
      <table class="table" id="tasksTable">
         <tr id="infoRowHeader">
            <td class="taskN">Название задачи</td>
            <td class="taskD">Описание</td>
            <td class="taskNP">Название проекта</td>
            <!-- <td class="taskM">Руководитель</td> -->
            <td class="taskW"> Исполнитель</td>
            <td class="taskP">Приоритет</td>
            <td class="taskE">Окончание</td>
            <td class="taskS">Статус</td>
            <td class="taskA">Действия</td>
         </tr>
      </table>
   </div>
   <div id="paginate">
      
   </div>
</div>

<script src="../js/script.js"></script>
</body>
</html>