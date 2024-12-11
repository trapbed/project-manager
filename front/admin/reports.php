<?php
    require 'layouts/header.php';
?>

<script>sessionStorage.removeItem('page_id');</script>
<script src="../js/reports_api_admin.js"></script>
   

<div id="left_block">
    <div id="search_select">
      <div id="create_something" onclick="first_step_create_project()"><div class="create"><img src="/img/group 189.svg" alt=""></div></div>
   </div>
   
   <div id="main_block_reports">
        <div id="reports_for_btns"><button onclick="change_page_reports()">Все</button><button onclick="change_page_reports('worker')">По пользователям</button><button onclick="change_page_reports('project')">По проектам</button></div>
        <div id="content_reports">
            <table id="table_report">
                <thead>
                    <tr>
                        <td class="report_aspect">Аспект</td>
                        <td class="report_id">ID создателя</td>
                        <td class="report_date">Дата создания</td>
                        <td class="report_interval">В промежутке</td>
                        <td class="report_statistics">Статистика</td>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>


</div>

<script src="../js/script.js"></script>
</body>
</html>