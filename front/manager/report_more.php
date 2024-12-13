<?php
    require 'layouts/header.php';
?>

<script>
    console.log(window.location.pathname);
    console.log(localStorage.getItem('one_report'))
</script>

<div id="left_block">
<div class="h1_75"></div>

    <a href="reports.php" class="backToReports">
            < Назад к отчетам
    </a>
    <div class="empty_actions_task">
   </div>
    <div id="one_report_block">
        <span id="rep_tit"></span><br>
        <span id="rep_dat"> От </span><br>
        <span id="rep_int">В интервале: </span><br>
        <span id="rep_cre">Создал: </span><br>
        <table id="table_report">
            <thead>
                <tr>
                    <td class="report_aspect">Заголовок</td>
                    <td class="report_id">Статус</td>
                    <td class="report_date">Начало</td>
                    <td class="report_interval">Завершение</td>
                </tr>
            </thead>
            <tbody id="report_table_body">

            </tbody>
        </table>
    </div>
</div>

<script>
    array_data =localStorage.getItem('one_report');
    array_data = JSON.parse(array_data);
    title = `nono`;
    if(array_data[2] == 'worker'){
        // console.log(array_data[2]);
        title = "Отчет по исполнителю: "+array_data[4];
    }
    else if(array_data[2] == 'project'){
        title = "Отчет по проекту: "+array_data[4];
    }
    interval = '';
    switch(array_data[5]){
        case 'year':
            interval = 'год';
            break;
        case 'month':
            interval = 'месяц';
            break;
        case 'week':
            interval = 'неделя';
            break;
    }    

    $("#rep_tit").append(title);
    $("#rep_dat").append(array_data[1]);
    $("#rep_int").append(interval);
    $("#rep_cre").append(array_data[0]);


    html_rep =``;
    report = JSON.parse(array_data[3]);
   
    $.each(report , function(key, value){
        console.log(value);
        html_rep += `
        <tr>
            <td class="report_aspect">${value[0]}</td>
            <td class="report_id">${value[1]}</td>
            <td class="report_date">${value[2]}</td>
            <td class="report_interval">${value[3]}</td>
        </tr>
        `;
    })

    let tbody = document.createElement('tbody');
    tbody.setAttribute('id', 'report_table_body');
    tbody.innerHTML = html_rep;
    $("#table_report").append(tbody);
</script>
