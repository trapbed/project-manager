<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js/projects_api.js"></script>

<div id="left_block">
   <div class="instead_filter">
      
   </div>
   
   <div id="infoRows" class="no_height">
        <table class="table" id="projectsTable">
            <tr id="infoRowHeader" class="fixed">
            <td class="taskN">Название проекта</td>
            <td class="taskD">Описание</td>
            <td class="taskM">Руководитель</td>
            <td class="taskW">Статус</td>
            <td class="taskP">Дата начала</td>
            <td class="taskE">Дата окончания</td>
            <td class="taskS">Подробнее</td>
            <td class="taskA">Действия</td>
            </tr>
    <!-- <table class="table" id="tasksTable">
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
      </table>
   </div>-->
   </table>
</div>
<div id="paginate">
      
 </div> 

<script src="../js/script.js"></script>
</body>
</html>