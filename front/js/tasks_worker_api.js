console.log(sessionStorage);
$.ajax({
    type:"POST",
    data: {"id_worker": sessionStorage.getItem('id')},
    url: "http://pm.b/tasks_worker",
    success:(response)=>{
        if(sessionStorage.getItem('page_id') && sessionStorage.getItem('page_id') != 1 && sessionStorage.getItem('page_id') != 'null'){
            change_page(sessionStorage.getItem('page_id'));
        }
        else{
            render_tasks(response);
        }
        paginate_tasks(response);
    },
    error:()=>{
        alert('Не удалось прогрузить задачи!');
    }
})

let newClass;
console.log(sessionStorage.getItem('page_id'));

function render_tasks(response){
    $(".infoRow").remove();
    if(sessionStorage.getItem('role') != 'worker'){
        $(".btn_paginate").remove();
    }
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
        actions = `<div class='empty_actions_task'></div>`;
        
        today = new Date();
        today.setDate(today.getDate() + 1);
        today = today.getFullYear()+"-"+today.getMonth()+"-"+today.getDate();
        // console.log(value.finished_at);
        if(value.finished_at < today){
            actions = ``;
        }
        else{
            if(value.status == 'Назначена'){
                actions = `<img class="start_task_worker" onclick="change_status(${value.id}, 'Выполняется')" src="../img/worker/start.png" alt="Начать">`;
            }
            else if(value.status == 'Выполняется'){
                actions = `<img onclick="change_status(${value.id}, 'Завершена')" src="../img/worker/complete.png" alt="Завершить">`;
            }
        }
        
        let tr = document.createElement('tr');
        tr.classList.add("infoRow");
        
        let last = Math.ceil((new Date(value.finished_at)-new Date())/86400000);
        tr.innerHTML = `
            <td class="taskN worker_task_N">${value.title}</td>
            <td class="taskD worker_task_D">${last}</td>
            <td class="taskNP worker_task_P">${value.priority}</td>
            <td class="taskW worker_task_S"> ${value.status}</td>
            <td class="taskP worker_task_M" onclick="modalTaskDesc(${value.id})">Смотреть</td>
            <td class="taskE worker_task_C"><div class="actions_task_worker">
                                                ${actions}
                                                <div class="line_comm" onclick="see_comments(this, event, ${value.id})"><img src="../img/worker/comm_dark.svg" alt="" class='comments_worker'><div>${count_comm}</div></div>
                                            </div></td>
            `;
            console.log(value.id);
        $("#tasksTable").append(tr);
    });
}

function change_page(page_id){
    sessionStorage.setItem('page_id',page_id);
    $.ajax({
        type : "POST",
        data: {'page_id':page_id, 'role':sessionStorage.getItem('role'), 'id_worker':sessionStorage.getItem('id')}, 
        url: "http://pm.b/page_tasks",
        success: (response)=>{
            console.log(response);
            render_tasks(response);
            paginate_tasks(response);
        },
        error: ()=>{
            alert('Не удалось загрузить задачи!');
        }
    })  
}

function change_status(id_task, status){
    $.ajax({
        type: "POST",
        data: {'id_task':id_task, 'status':status, "id_worker": sessionStorage.getItem('id'), 'page':sessionStorage.getItem('page_id')},
        url: "http://pm.b/change_status",
        success:(response)=>{
            render_tasks(response);
            alert(response.mess);
        },
        error:()=>{
            alert('Не удалось изменить статус!');
        }
    })
}

function paginate_tasks(response){
    $(".btn_paginate").remove();
    if(response.count>10){
        let paginate_d = $("#paginate");
        let pages = Math.ceil(response.count/10);
            for(let i=1; i<=pages; i++){
                paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
            }
        $("#session").append(paginate);
    }
}

function see_comments(elem, event, id){
    elem.setAttribute('id', 'set_one_comments');
    $.ajax({
        type: "POST",
        data: {'id_task':id},
        url:"http://pm.b/get_comments_for_task",
        success:(response)=>{
            console.log(response);
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
                    <div id="for_form_comm">
                        <form id="form_create_comment" onsubmit="create_comment(event)"> 
                            <input type="hidden" name="id_task" value="${response.id_task}">
                            <div id='block_input_comment'><input type="text" id='input_to_search_comm' name="content_comment"><img onclick="create_comment(event)" src="../img/worker/send.png" alt="click to sent"></div>
                        </form>
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
                <img onclick="delete_comment(${response.id_task}, ${id_comm})" src="../img/x.svg" alt="delete_comment">
                <div class="content_comment">${value}</div>
                <div class="date_comment">${key}</div>
            </div>
             `;
             id_comm++;
        })
    }
    return comments_blocks;
}

function close_modal_comm(){
    $("#block_comments").remove();
    $("#background_blur").remove();
}

function create_comment(event){
    event.preventDefault();
    $.ajax({
        type:"POST",
        data: $("#form_create_comment").serialize(),
        url: "http://pm.b/create_comm",
        success:(response)=>{
            if(response.res == true){
                $("#comments_block").empty();
                freshed_comments = render_comments(response);
                $("#comments_block").append(freshed_comments);
                $("#set_one_comments").find("div").remove();
                let div = document.createElement(`div`);
                div.innerHTML= `${response.amount}`;
                $("#set_one_comments").append(div);
                $("#input_to_search_comm").val('');
            }
            alert(response.mess);
        },
        error:()=>{
            alert("Комментарий не создан!");
        }
    })
}

function delete_comment(id_task, id_comm){
    $.ajax({
        type:"POST",
        data:{'id_task':id_task,'id_comm':id_comm},
        url:"http://pm.b/delete_comment",
        success:(response)=>{
            if(response.res == true){
                $(".one_comment").remove();
                freshed_comments = render_comments(response);
                $("#comments_block").append(freshed_comments);
                $("#set_one_comments").find("div").remove();
                let div = document.createElement(`div`);
                div.innerHTML= `${response.amount}`;
                $("#set_one_comments").append(div);
            }
            alert(response.mess);
        },
        error:()=>{
            alert('Не удалось удалить комментарий!');
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