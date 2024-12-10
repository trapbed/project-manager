console.log(sessionStorage);
let newClass ;
// console.log(sessionStorage.getItem('role'));
if(!sessionStorage.getItem('filter')){
    sessionStorage.setItem('filter', '');
}
if(!sessionStorage.getItem('page_id')){
    sessionStorage.setItem('page_id', '1');
}

function tasks_with_filter (){
    sessionStorage.setItem('filter',$("#priority_filter").val());
    console.log(sessionStorage.getItem('page_id'));
    console.log(sessionStorage.getItem('filter'));
}

$.ajax({
    type : "GET",
    url: "http://pm.b/tasks",
    data:{'role':sessionStorage.getItem('role'), 'id_user':sessionStorage.getItem('id')},
    success: (response)=>{
        render_tasks(response);
    },
    error: ()=>{
        window.sessionStorage.setItem('tasks', 'Нет задач!');
        alert('Нет задач!');
    }
})
function render_tasks(response){
    // console.log(response);
    $(".infoRow").remove();
    $(".btn_paginate").remove();
    if(response.count <= 0){
        let div = document.createElement('div');
        div.innerHTML = `У вас нет задач!`;
        $("#infoRows").append(div);
    }
    else{
           
        let tasks = response.tasks; 
        title = "";
        $.each(tasks, function(key, value){ 
                comms = value.comments;
                if(comms == null){
                    count_comm = 0;
                }
                else{
                    count_comm = Object.keys(JSON.parse(comms)).length;
                }

                last = value.finished_at;
                if(sessionStorage.getItem('role') == 'manager'){
                    last = Math.ceil((new Date(value.finished_at)-new Date())/86400000);
                    if(last<0 && value.status !== 'Завершен'){
                        last = 'Просрочен';
                    }
                    else if(last<0 && value.status == 'Завершен'){
                        last = value.status;
                    }
                    else if(last == 0){
                        last = 'Последний день!';
                    }
                }
                let tr = document.createElement('tr'); 
                tr.classList.add("infoRow");
                if(sessionStorage.getItem('role') == 'admin'){
                    newClass = 'blur'; 
                    title=`title = "админу не доступны инструменты управления!"`;
                }
                // actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png">`;
                // console.log( value.status);
                if(value.status == 'Назначена'){
                    actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png"><img onclick="delete_task(${value.tasks_id})" src="../img/delete.png">`;
                }
                else if(sessionStorage.getItem('role')== 'admin'){
                    actions=``;
                }
                else{
                    actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png"><div class="dummy_img"></div>`;
                }
                tr.innerHTML = `
                    <td class="taskN">${value.title_task}</td>
                    <td class="taskD" onclick= "modalTaskDesc(${value.tasks_id})">Подробнее</td>
                    <td class="taskNP">${value.title_project}</td>
                    <td class="taskW"> ${value.worker}</td>
                    <td class="taskP"><img src="../img/priority/${value.priority}.svg" alt="priority ${value.priority}">${value.priority}</td>
                    <td class="taskE">${last}</td>
                    <td class="taskS">${value.status}</td>
                    <td class="taskA"><div ${title} class="BTWAct ">${actions}<div class="line_comm" onclick="see_comments(this, event, ${value.tasks_id})"><img src="../img/worker/comm_dark.svg" alt="" class='comments_worker'><div>${count_comm}</div></div></div></td>`;
                $("#tasksTable").append(tr);
        });

        if(response.count>9){
            let paginate_d = $("#paginate");
            let pages = Math.ceil(response.count/9);
                for(let i=1; i<=pages; i++){
                    // console.log(i);
                    paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                }
            $("#session").append(paginate);
        }
    }
    
}

function change_page(page_id){
    console.log(page_id);
    $.ajax({
        type : "POST",
        data: {'page_id':page_id, 
               'role':sessionStorage.getItem('role'), 
               'id_user':sessionStorage.getItem('id'),
                'filter': sessionStorage.getItem('filter')}, 
        url: "http://pm.b/page_tasks",
        success: (response)=>{
            console.log(response);
            $(".infoRow").remove();
            let tasks = response.tasks; 
            title = "";
            $.each(tasks, function(key, value){
                comms = value.comments;
                if(comms == null){
                    count_comm = 0;
                }
                else{
                    count_comm = Object.keys(JSON.parse(comms)).length;
                }
                last = value.finished_at;
                if(sessionStorage.getItem('role') == 'manager'){
                    last = Math.ceil((new Date(value.finished_at)-new Date())/86400000);
                    if(last<0 && value.status !== 'Завершен'){
                        last = 'Просрочен';
                    }
                    else if(last<0 && value.status == 'Завершен'){
                        last = value.status;
                    }
                    else if(last == 0){
                        last = 'Последний день!';
                    }
                }
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
                        title = title=`title = "админу не доступны инструменты управления!"`;
                    }
                  let tr = document.createElement('tr'); 
                  tr.classList.add("infoRow");
                  actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png">`;
                //   console.log( value.status);
                if(sessionStorage.getItem('role')== 'admin'){
                    actions=``;
                }
                else{
                    if(value.status == 'Назначена'){
                        actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png"><img onclick="delete_task(${value.tasks_id})" src="../img/delete.png">`;
                    }
                    else{
                        actions =  `<img onclick="edit_task(${value.tasks_id})" src="../img/edit.png"><div class="dummy_img"></div>`;
                    }
                }
                
                  tr.innerHTML = `
                    <td class="taskN">${value.title_task}</td>
                    <td class="taskD" onclick= "modalTaskDesc(${value.tasks_id})">Подробнее</td>
                    <td class="taskNP">${value.title_project}</td>
                    <td class="taskW"> ${value.worker}</td>
                    <td class="taskP"><img src="../img/priority/${value.priority}.svg" alt="priority ${value.priority}">${value.priority}</td>
                    <td class="taskE">${last}</td>
                    <td class="taskS">${value.status}</td>
                    <td class="taskA"><div ${title} class="BTWAct ">${actions}<div class="line_comm" onclick="see_comments(this, event, ${value.tasks_id})"><img src="../img/worker/comm_dark.svg" alt="" class='comments_worker'><div>${count_comm}</div></div></div></td>`;
                    $("#tasksTable").append(tr);
            });
            if(response.count>9){
                $(".btn_paginate").remove();
                let paginate_d = $("#paginate");
                let pages = Math.ceil(response.count/9);
                // console.log(pages);
                // console.log(paginate_d);
                    for(let i=1; i<=pages; i++){
                        paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                    }
                $("#session").append(paginate);
            }
        },
        error: ()=>{
            alert('Не удалось прогрузить задачи!');
        }
    })  
}
function see_comments( elem, event, id){
    // console.log(last);
    event.preventDefault();
    elem.setAttribute('id', 'set_one_comments');
    $.ajax({
        type: "POST",
        data: {'id_task':id},
        url:"http://pm.b/get_comments_for_task",
        success:(response)=>{
            // console.log(response);
            
            comments_blocks = render_comments(response);
            let background_blur = document.createElement(`div`);
            background_blur.setAttribute('id','background_blur');
            background_blur.innerHTML = `
                <div id="block_comments">
                    <div id="close_modal_comm">
                            <div>Название задачи: "${response.title}"</div><img onclick="close_modal_comm()" src="../img/x.svg" alt="close modal">
                    </div>
                    <div id='comments_block'>
                    ${comments_blocks}
                    </div>
                    
                </div> 
            `; 
            $(".content").append(background_blur);
        },
        error:()=>{
            alert('Не удалось прогрузить комментарии!');
        }
    })
}
function render_comments(response){
    console.log(response);
    if(!response.res || response.act == 'delete'){
        arr_comm = $.parseJSON(response.comments);
    }
    else{
        arr_comm = response.comments;
    }
    let comments_blocks = ``;
    if(arr_comm == null){
        comments_blocks = `Пока нет комментариев!`;
    }
    else{
        id_comm = 0;
        $.each(arr_comm, function(key, value){
             comments_blocks += `
             <div class="one_comment">
                
                <div class="content_comment">${value}</div>
                <div class="date_comment">${key}</div>
            </div>
             `;
             id_comm++;
        })
    }
    return comments_blocks;
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
function close_modal_comm(){
    $("#block_comments").remove();
    $("#background_blur").remove();
}