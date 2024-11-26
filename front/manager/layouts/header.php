<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="\css\style.css">
    <script src="\js\jquery-3.7.1.min.js"></script>
    <script src="\js\script_api.js"></script>
    <script src="../js/mess.js"></script>
    <script src="../js/task_manager_api.js"></script>
</head>
<body>
<div class="background_blur" id="task_desc_more_info">
    <!-- <div id="modalTaskDesc">
        <div id="close_modal_task">
            <img onclick="close_tasks()" src="../img/x.svg" alt="close modal">
        </div> 
        <div id="headerTask">Название проекта название проекта название проекта название</div>
        <div id="usersTask"><span>Руководитель: </span><span>Исполнитель: </span></div>
        <div id="descTaskTitle">Описание:</div>
        <div id="descriptionTask">Название проекта название проекта название проекта название проекта  название проекта название проекта название проекта название проекта </div>
    </div> -->
</div>

    <div class="content">
        <div id="leftNavbar">
            <div id="topNavContent">
                <a href="tasks/" id="logoNav" class="backgroundNav">
                    <img src="/img/icons8-бизнес-сеть-100 1.svg" alt="">
                    <h1 class="mouseHid">Project- Manager</h1>
                </a>
                <div class="br1"></div>
                <div id="linksNav">
                        
                    <div class="br04"></div>
                    <a href="tasks.php" class="linkNav backgroundNav">
                        <img src="/img/contacts.png" alt="">
                        <h2 class="mouseHid">Задачи</h2>
                    </a>
                    <div class="br04"></div>
                    <a href="projects.php" class="linkNav backgroundNav">
                        <img src="/img/projects.png" alt="">
                        <h2 class="mouseHid">Проекты</h2>
                    </a>
                    <div class="br04"></div>
                    <a href="reports.php" class="linkNav backgroundNav">
                        <img src="/img/report.png" alt="">
                        <h2 class="mouseHid">Отчеты</h2>
                    </a>
                </div>
                </br>
            </div>
            <div id="accountNav" class="backgroundNav" onclick="logout()">
                <img src="/img/profile (1).png" alt="">
                <span class="mouseHid"> <script> document.write(sessionStorage.getItem('name')); </script></span>
            </div>
            
        </div>
        <script>

    function logout(){
        $.ajax({
            type:"POST",
            url: "http://pm.b/logout",
            success:(response)=>{
                alert(response);
                sessionStorage.clear();
                location.href='../index.php';
                // console.log(response);
            },
            error:()=>{
                alert('Не удалось выполнить запрос!');
            }
        })
    }


//    let no_this_role = ;            
    if(sessionStorage.getItem('role') != 'manager'){
        sessionStorage.setItem('mess', 'Вам не доступны возможности этого пользователя!');
        // alert();
        location.href= '../'+sessionStorage.getItem('role')+'/tasks.php';
    }
    </script>