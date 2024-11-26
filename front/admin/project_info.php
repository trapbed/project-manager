<?php
    require 'layouts/header.php';
   //  require "js/tasks_api.js";
?>
<script src=" ../js/project_api.js"></script>

<div id="left_block">
    <div id="infoRows">
        <div class="h1_75"></div>

        <a href="projects.php" class="backToProjects">
            < Назад к проектам
        </a>
        <div class="h1_75"></div>

        <div class="oneProject">
                <div class="titleOneProject"></div>
                
                <div class="moreOneProj">
                    <hr class="BTWOneProj">
                    <div class="oneProjMoreInfo">
                        <div class="dateStatusOne">
                            <div class="row1">Дата начала: </div>
                            <div class="row2">Дата окончания: </div>
                            
                            <div class="row3">Осталось дней: </div>
                            <div class="row4">Статус: </div>
                        </div>
                        
                        <div class="descOneProj">
                            <span>Описание:</span>
                            <!-- <span class="more descOneProjMore">Смотреть</span> -->
                            <!-- <div class="descOneProjHide"> -->
                                <span id="descProj"></span> 
                            <!-- <span class="more hideDescOneProj">Скрыть</span></div> -->
                        </div>
                        <div id="squad">
                            <div id="one_project_M">
                                <span id="one_pm">Руководитель:</span>
                                <span id="one_current_m"></span>
                                <!-- <div id="change_pm"><button>Изменить</button></div> -->
                            </div>
                            <div id="one_project_S">
                                <span id="one_squad">Команда:</span>
                                <div id="current_squad">
                                    
                                </div>
                                <div id="change_sq"><button></button></div>    
                            </div>
                        </div>
                        <div class="btnsOneProj">

                        </div>
                    </div>
                </div>
        </div>
            

    <!-- Проект: Название, описание, начато, срок окончания, статус, руководитель, команда -->
    

    </a>
<script src="../js/script.js"></script>
<script src="../js/projects_script.js"></script>
</body>
</html>