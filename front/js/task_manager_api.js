function create_task_modal(){
    $.ajax({
        type: "POST", 
        url: "http://pm.b/get_projects_title",
        success:(response)=>{
            let options =  ``;
            projects = response;
            $.each(projects, function(key, value){
                options+=`<option value='${value.id}'>${value.title}</option>`;
            })
            let div = document.createElement(`div`);
            div.setAttribute('id', 'background_blur');
            div.innerHTML = `
            <div id='add_to_squad_modal'>
                <div id='title_close'>
                    <span>Назначение задачи</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                    <form id='form_create_task' onsubmit='choose_proj_to_task(event)'>    
                    <div>   
                        <label for='user'>К проекту:</label>
                        <select name='id_project'>
                            ${options}
                        </select>
                    </div>    
                        <input type='submit' value='Выбрать' id='submit_update_squad'>
                    </form>
                </div>
            </div>`;
            $('.content').append(div);
        },
        error:()=>{
            alert('Не получилось загрузить форму!');
        }
    })
      
}

function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}

function choose_proj_to_task(event){
    event.preventDefault();
    data = $("#form_create_task").serialize();
    $.ajax({
        type:"POST",
        data:{"project_id":data},
        url:"http://pm.b/get_info_form_create_task",
        success:(response)=>{
            info = response.info[0];
            div_form = document.createElement(`div`);
            div_form.setAttribute('id','add_to_squad_modal');
            console.log(response);
            selects = ``;
            $.each(response.arr, function(key, value){
                selects +=`<option value='${key}'>${value}</option>`;
            });
            div_form.innerHTML = `
                    <div id='title_close'>
                    <span>Назначение задачи к проекту: ${info.title}</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                        <form id='form_create_task_end' onsubmit='create_task(event)'>
                            <input class='display_none' type='text' name='id_project' value='${info.id}'>
                            <div>   
                                <label for='user'>Заголовок:</label>
                                <input name='title' id='str' type="text">
                            </div>    
                            <div>
                                <label for='user'>Описание:</label>
                                <input name='description' type="text">
                            </div>      
                            <div>   
                                <label for='user'>Начало:</label>
                                <input name='started_at' id='date_started_at' onchange="change_min_end()" type="date" min='${info.started_at}' max='${info.finished_at}'>
                            </div>    
                            <div> 
                                <label for='user'>Конец:</label>
                                <input name='finished_at' id='date_finished_at' type="date" min='${info.started_at}' max='${info.finished_at}'>
                            </div>    
                            <div>   
                                <label for='user'>Исполнитель:</label>
                                <select name='worker'>
                                    ${selects}
                                </select>
                            </div>    
                            <div>   
                                <label for='user'>Приоритет:</label>
                                <select name='priority'>
                                    <option value="Низкий">Низкий</option>
                                    <option value="Высокий">Высокий</option>
                                    <option value="Средний">Средний</option>
                                </select>
                            </div>    
                            <input type="hidden" name='manager_id' value="${sessionStorage.getItem("id")}">
                            <input type='submit' value='Назначить' id='submit_update_squad'>
                        </form>
                </div> `;
            $('#background_blur').append(div_form);
        },
        error:()=>{
            alert('Не удалось прогрузить форму!');
        }
    })
}

function change_min_end(){
    change = document.querySelectorAll("input")[4].value;
    plus_day = new Date(change);
    plus_day.setDate(plus_day.getDate() + 1);
    plus_day = plus_day.getFullYear()+"-"+(plus_day.getMonth()+1)+"-"+plus_day.getDate();
    $("input")[5].setAttribute('min', plus_day);
}


function create_task(event){
    event.preventDefault();
    data_cr_task = $("#form_create_task_end").serialize();
    $.ajax({
        type: "POST",
        data: data_cr_task,
        url: "http://pm.b/save_create_task",
        success:(response)=>{
            if(response.res == true){
                close_modal();
                alert(response.mess);
                render_tasks(response);
            }
        },
        error:()=>{
            alert('Не удалось создать задачу');
        }
    })
}

function edit_task(id_task){
    $.ajax({
        type:"POST",
        data:{"id_task": id_task},
        url:"http://pm.b/get_info_to_edit_task",
        success:(response)=>{
            console.log(response);
            task = response.info;
            dates = response.dates;
            selects = ``;
            div = document.createElement(`div`);
            div.setAttribute('id','background_blur');
            div.innerHTML = `
                <div id="add_to_squad_modal">
                    <div id='title_close'>
                    <span>Изменение задачи: </span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                        <form id='form_update_task_end' onsubmit='update_task(event)'>
                            <input class='display_none' type='text' name='id_task' value='${task.id}'>
                            <div>   
                                <label for='user'>Заголовок:</label>
                                <input name='title' id='str' type="text" value="${task.title}">
                            </div>    
                            <div>
                                <label for='user'>Описание:</label>
                                <input name='description' type="text" value="${task.description}">
                            </div>      
                            <div>   
                                <label for='user'>Начало:</label>
                                <input name='started_at' id='date_started_at' onchange="change_min_end_in_update()" type="date" min='${dates.started_at}' max='${dates.finished_at}' value="${task.started_at}">
                            </div>    
                            <div> 
                                <label for='user'>Конец:</label>
                                <input name='finished_at' id='date_finished_at' type="date" min='${dates.started_at}' max='${dates.finished_at}' value="${task.finished_at}">
                            </div>  
                            <input type="hidden" name='manager_id' value="${sessionStorage.getItem('id')}">
                            <input type='submit' value='Назначить' id='submit_update_squad'>
                        </form>
                    </div>
                </div> `;
            $('.content').append(div);
        },
        error:()=>{
            alert('Не удалось прогрузить форму!');
        }
    })
}

function update_task(event){
    event.preventDefault();
    form_data = $("#form_update_task_end").serialize();
    $.ajax({
        type: "POST",
        data: form_data,
        url: "http://pm.b/update_task",
        success:(response)=>{
            if(response.res == true){
                close_modal();                
                render_tasks(response);
            }
            alert(response.mess);
        },
        error:()=>{
            // VOID
        }
    })
}

function change_min_end_in_update(){
    change = document.querySelectorAll("input")[4].value;
    console.log(change);
    plus_day = new Date(change);
    plus_day.setDate(plus_day.getDate() + 1);
    plus_day = plus_day.getFullYear()+"-"+(plus_day.getMonth()+1)+"-"+plus_day.getDate();
    $("input")[5].setAttribute('min', plus_day);
}

function delete_task(id_task){
    ask_delete = confirm('Вы точно хотите удалить задачу? Восстановить ее нельзя будет!');
    if(ask_delete){
        $.ajax({
            type: "POST",
            data: {"id_task": id_task},
            url: "http://pm.b/delete_task",
            success:(response)=>{
                console.log(response);
                if(response.res == true){
                    let tasks = response.tasks;
                    render_tasks(response);
                }
                alert(response.mess);
            },
            error:()=>{
                alert('Не удалось удалить задачу!');
            }
        })
    }
    else{

    }
}
function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}