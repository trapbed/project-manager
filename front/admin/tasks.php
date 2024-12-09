<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js\tasks_api.js"></script>

<div id="left_block">
   <div class="instead_filter">
      
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
            <td class="taskE">Окончание</td>
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