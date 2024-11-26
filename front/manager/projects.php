<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<!-- <script src=" ../js/projects_api.js"></script> -->

<div id="left_block">
   <div id="search_select">
      <form action="">
         <input type="search" name="" id=""> 
         <select name="" id="">
            <option value="">Статус</option>
            <option value="">Создан</option>
            <option value="">В процессе</option>
            <option value="">Завершен</option>
         </select>
      </form>
   </div>

   
   <div id="infoRows">
   <div class="oneProject">
            <div class="titleOneProject"></div>
            <div class="oneProjSeeMore more">
                Подробнее
            </div>
            <div class="moreOneProj">
                <hr class="BTWOneProj">
                <div class="oneProjMoreInfo">
                    <div class="dateStatusOne">
                        <div class="row1">Дата начала: </div>
                        <div class="row2">Дата окончания: </div>
                        <div class="row3">Осталось дней: </div>
                        <div class="row4">Статус: </div>
                    </div>
                    <div class="tasksOneProj">
                        
                        <div class="allinfoTasksOneProj">
                            <div class="row1">Задач: </div>
                            <div class="row2">Выполнено: </div>
                            <div class="row3">Осталось: </div>
                        </div>
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
                                    <tr class="taskRowOneProj">
                                        <td class="nameTaskProj"></td>
                                        
                                        <td class="workerTaskProj"></td>
                                        <td class="statusTaskProj"></td>
                                        <td class="endTaskProj"></td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div class="descOneProj">
                        <span>Описание:</span>
                        <span class="more descOneProjMore">Смотреть</span>
                        <div class="descOneProjHide"><span></span> <span class="more hideDescOneProj">Скрыть</span></div>
                    </div>
                    <div class="btnsOneProj">

                    </div>
                </div>
            </div>
        </div>
        
   <div id="paginate">
      
   </div> 
</div>
<script>
   // if(sessionStorage.getItem('role') != 'admin'){
   //    location.href = sessionStorage.getItem('role')+'tasks.php';
   // }
</script>
<script src="../js/script.js"></script>
</body>
</html>