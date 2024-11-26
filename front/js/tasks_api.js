// console.log(sessionStorage.getItem('role'));
let newClass ;

$.ajax({
    type : "GET",
    url: "http://pm.b/tasks",
    success: (response)=>{
        let tasks = response.tasks; 
        // console.log(response);
        title = "";
            $.each(tasks, function(key, value){ 
                    let tr = document.createElement('tr'); 
                    tr.classList.add("infoRow");
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
                        title = title=`title = "админу не доступны инструменты управления!"`;
                    }
                    tr.innerHTML = `
                        <td class="taskN">${value.title_task}</td>
                        <td class="taskD" onclick= "modalTaskDesc(${value.tasks_id})">Подробнее</td>
                        <td class="taskNP">${value.title_project}</td>
                        <td class="taskW"> ${value.worker}</td>
                        <td class="taskP">${value.priority}</td>
                        <td class="taskE">${value.finished_at}</td>
                        <td class="taskS">${value.status}</td>
                        <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                    $("#tasksTable").append(tr);
            });

            if(response.count>10){
                let paginate_d = $("#paginate");
                let pages = Math.ceil(response.count/10);
                    for(let i=1; i<=pages; i++){
                        // console.log(i);
                        paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                    }
                $("#session").append(paginate);
            }
    },
    error: ()=>{
        window.sessionStorage.setItem('tasks', 'Нет задач!');
        console.log('NONO');
    }
})


function change_page(page_id){
    $.ajax({
        type : "POST",
        data: {page_id:page_id}, 
        url: "http://pm.b/page_tasks",
        success: (response)=>{
            $(".infoRow").remove();
            window.sessionStorage.setItem('tasks', response);
            let tasks = response; 
            title = "";
            $.each(tasks, function(key, value){
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
                        title = title=`title = "админу не доступны инструменты управления!"`;
                    }
                  let tr = document.createElement('tr'); 
                  tr.classList.add("infoRow");
                  tr.innerHTML = `
                    <td class="taskN">${value.title_task}</td>
                    <td class="taskD" onclick= "modalTaskDesc(${value.tasks_id})">Подробнее</td>
                    <td class="taskNP">${value.title_project}</td>
                    <td class="taskW"> ${value.worker}</td>
                    <td class="taskP">${value.priority}</td>
                    <td class="taskE">${value.finished_at}</td>
                    <td class="taskS">${value.status}</td>
                    <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                    // console.log(key);
                    $("#tasksTable").append(tr);
            });
            if(response.count>10){
                let paginate_d = $("#paginate");
                let pages = Math.ceil(response.count/10);
                console.log(pages);
                console.log(paginate_d);
                    for(let i=1; i<=pages; i++){
                        // console.log(i);
                        paginate.innerHTML += `<div class="btn_paginate" onclick="chage_page(${i})">${i}</div>`;
                    }
                $("#session").append(paginate);
            }
        },
        error: ()=>{
            window.sessionStorage.setItem('tasks', 'Нет задач!');
            console.log('NONO');
        }
    })  
}

function modalTaskDesc(id){
    $.ajax({
        type : "POST",
        url: "http://pm.b/oneDescTask",
        data: {id:id},
        success: (id)=>{
            $(".background_blur").css("display","flex");
            let tasks = [id];
                $.each(tasks, function(key, value){ 
                      let div = document.createElement('div'); 
                      div.setAttribute("id","modalTaskDesc");
                        div.innerHTML = `
                                <div id="close_modal_task">
                                    <img onclick="close_tasks()" src="../img/x.svg" alt="close modal">
                                </div> 
                                <div id="headerTask">${value.task_worker.title}</div>
                                <div id="usersTask"><span>Руководитель: ${value.boss.name}</span><span>Исполнитель: ${value.task_worker.name}</span></div>
                                <div id="descTaskTitle">Описание:</div>
                                <div id="descriptionTask">${value.task_worker.description} </div>`;

                        $("#task_desc_more_info").append(div);
                });
        },
        error: ()=>{
            alert('no task');
        }
    })
}

function close_tasks(){
    $("#modalTaskDesc").remove();
    $(".background_blur").css("display","none");
}