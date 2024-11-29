console.log(sessionStorage);
$.ajax({
    type: "POST",
    data: {'id': sessionStorage.getItem('id')},
    url: "http://pm.b/projects_info_admin",
    success:(response)=>{
        count = response.count;
        projects = response.projects;
        if(count>0){
            $.each(projects, function(key,value){
                div = document.createElement(`div`);
                div.classList.add('oneProject');
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
                div.innerHTML = `
                <div class="titleOneProject">Заголовок проекта: <br><br>${value.title}</div>
                <div class="moreOneProj">
                    <hr class="BTWOneProj">
                    <div class="oneProjMoreInfo">
                        <div class="dateStatusOne">
                            <div class="row1">Дата начала: ${value.started_at}</div>
                            <div class="row2">Дата окончания: ${value.finished_at}</div>
                            <div class="row3">Осталось дней: ${last}</div>
                            <div class="row4">Статус: ${value.status}</div>
                        </div>
                        <div class="descOneProj">
                            <span>Описание:</span>
                            <div class="descOneProjMore"><span>${value.description}</span> </div>
                        </div>
                        <div class="btnsOneProj">
                            <button class="oneBTNproj update_project" onclick="update_project_modal(${value.id})">Редактировать</button>
                            <button class="oneBTNproj delete_project" onclick="delete_project(${value.id})">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>`;
                $("#infoRows").append(div);
            })
            if(count>2){
                paginate_func(count);
            }
        }
        else{
            div = document.createElement(`div`);
            div.setAttribute('id','noContentText');
            div.innerHTML = `У вас нет проектов!`;
            $("#infoRows").append(div);
        }
    },
    error:()=>{
        alert('Не удалось загрузить проекты!');
    }
})

function delete_project(id){
    question = confirm('Вы точно хотите удалить проект?');
    if(question){
        id_project = id;
        $.ajax({
            type: "POST",
            data: {"id_proj": id_project, "id_user":sessionStorage.getItem('id')},
            url: "http://pm.b/delete_project",
            success:(response)=>{
                alert(response.mess);
                $(".oneProject").remove();
                if(response.res == true){
                    count = response.count;
                    projects = response.projects;
                    if(count>0){
                        $.each(projects, function(key,value){ 
                            div = document.createElement(`div`);
                            div.classList.add('oneProject');
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
                            div.innerHTML = `
                            <div class="titleOneProject">Заголовок проекта: <br><br>${value.title}</div>
                            <div class="moreOneProj">
                                <hr class="BTWOneProj">
                                <div class="oneProjMoreInfo">
                                    <div class="dateStatusOne">
                                        <div class="row1">Дата начала: ${value.started_at}</div>
                                        <div class="row2">Дата окончания: ${value.finished_at}</div>
                                        <div class="row3">Осталось дней: ${last}</div>
                                        <div class="row4">Статус: ${value.status}</div>
                                    </div>
                                    <div class="descOneProj">
                                        <span>Описание:</span>
                                        <div class="descOneProjMore"><span>${value.description}</span> </div>
                                    </div>
                                    <div class="btnsOneProj">
                                        <button class="oneBTNproj update_project" onclick="update_project_modal(${value.id})">Редактировать</button>
                                        <button class="oneBTNproj delete_project" onclick="delete_project(${value.id})">Удалить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                            $("#infoRows").append(div);
                        })
                    }
                    else{
                        div = document.createElement(`div`);
                        div.setAttribute('id','noContentText');
                        div.innerHTML = `У вас нет проектов!`;
                        $("#infoRows").append(div);
                    }
                }
            }, 
            error:()=>{
                alert('');
            }
        })
    }else{
        alert('Проект еще существует!');
    }
}

function update_project_modal(id){
    id_project = id;
    $.ajax({
        type: "POST",
        data: {"id_proj": id_project},
        url: "http://pm.b/update_project_info",
        success:(response)=>{
            project = response.project[0];
            div_form = document.createElement(`div`);
            div_form.setAttribute('id','background_blur'); 
            selects = ``;
            statuses = ['Создан','В процессе','Завершен'];
            $.each(statuses, function(key, value){
                if(value === project.status){
                    selects += `<option selected value='${value}'>${value}</option>`;
                }
                else{
                    selects += `<option value='${value}'>${value}</option>`;
                }
            })
            div_form.innerHTML = `
            <div id="add_to_squad_modal">
                <div id='title_close'>
                    <span>Редактирование проекта : ${project.title}</span><img onclick='close_modal()' src='../img/x.svg' alt='close'>
                </div>
                    <form id='form_create_project_end' onsubmit='save_update_project(event)'>
                       <input class='display_none' type='text' name='id_user' value='${sessionStorage.getItem('id')}'>
                       <input class='display_none' type='text' name='id_project' value='${project.id}'>
                       <div>   
                           <label for='user'>Заголовок:</label>
                           <input class='fix_inp_width' name='title' id='str' type="text" value="${project.title}">
                       </div>    
                       <div>
                           <label for='user'>Описание:</label>
                           <textarea class='fix_inp_width mimax_w_ta' name='description'>${project.description}</textarea>
                       </div> 
                       <div>   
                           <label for='user'>Статус:</label>
                           <select class='fix_inp_width select_width' name='status'>
                               ${selects}
                           </select>
                       </div>    
                       <input type='submit' value='Изменить' id='submit_update_squad'>
                    </form>
                </div>`;
            $('.content').append(div_form);
        }, 
        error:()=>{
            alert('Не удалось загрузить форму!');
        }
    })
}

function save_update_project(event){
    event.preventDefault();
    $.ajax({
        type: "POST",
        data: $("#form_create_project_end").serialize(),
        url:"http://pm.b/save_update_proj",
        success:(response)=>{
            alert(response.mess);
            console.log(response);
            if(response.res == true){
                close_modal();
                $(".oneProject").remove();
                count = response.count;
                projects = response.projects;
                if(count>0){
                    $.each(projects, function(key,value){
                        div = document.createElement(`div`);
                        div.classList.add('oneProject');
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
                        div.innerHTML = `
                        <div class="titleOneProject">Заголовок проекта: <br><br>${value.title}</div>
                        <div class="moreOneProj">
                            <hr class="BTWOneProj">
                            <div class="oneProjMoreInfo">
                                <div class="dateStatusOne">
                                    <div class="row1">Дата начала: ${value.started_at}</div>
                                    <div class="row2">Дата окончания: ${value.finished_at}</div>
                                    <div class="row3">Осталось дней: ${last}</div>
                                    <div class="row4">Статус: ${value.status}</div>
                                </div>
                                <div class="descOneProj">
                                    <span>Описание:</span>
                                    <div class="descOneProjMore"><span>${value.description}</span> </div>
                                </div>
                                <div class="btnsOneProj">
                                    <button class="oneBTNproj update_project" onclick="update_project_modal(${value.id})">Редактировать</button>
                                    <button class="oneBTNproj delete_project" onclick="delete_project(${value.id})">Удалить</button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $("#infoRows").append(div);
                    })
                    if(count>2){
                        paginate_func(count);
                    }
                }
                else{
                    div = document.createElement(`div`);
                    div.setAttribute('id','noContentText');
                    div.innerHTML = `У вас нет проектов!`;
                    $(".content").append(div);
                }
            }
        },
        error:()=>{
            alert('Не удалось выполнить запрос!');
        }
    })
}

function modal_create_project(){
    div_form = document.createElement(`div`);
    div_form.setAttribute('id','background_blur'); 
    
    div_form.innerHTML = `
    <div id="add_to_squad_modal">
        <div id='title_close'>
            <span>Создание проекта : </span><img onclick='close_modal()' src='../img/x.svg' alt='close'>
        </div>
            <form id='form_create_project_end' onsubmit='save_create_project(event)'>
               <input class='display_none' type='text' name='id_user' value='${sessionStorage.getItem('id')}'>
               <div>   
                   <label for='user'>Заголовок:</label>
                   <input class='fix_inp_width' name='title' id='str' type="text" value="">
               </div>    
               <div>
                   <label for='user'>Описание:</label>
                   <textarea class='fix_inp_width mimax_w_ta' name='description'></textarea>
               </div> 
               <div>   
                   <label for='user'>Начало:</label>
                   <input class='fix_inp_width' name='title' id='str' type="date" value="">
               </div>
               <div>   
                   <label for='user'>Конец:</label>
                   <input class='fix_inp_width' name='title' id='str' type="date" value="">
               </div>
               <div>   
                   <label for='user'>Выберите исполнителей в команду:</label>
                   <select class='fix_inp_width select_width' name='status'>
                        <option value='Создан'>Создан</option>
                        <option value='В процессе'>В процессе</option>
                        <option value='Завершен'>Завершен</option>
                   </select>
               </div>
               <div>   
                   <label for='user'>Команда:</label>
                   
               </div>
               <input type='submit' value='Создать' id=''>
            </form>
        </div>`;
    $('.content').append(div_form);
}

function paginate_func(count){
    let paginate_d = $("#paginate");
    let pages = Math.ceil(count/2);
    for(let i=1; i<=pages; i++){
        console.log(i);
        paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
        console.log(paginate);
        paginate_d.append(paginate);
    }
}

function change_page_proj(page_id){
}

function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}

// function save_create_project(){
//     $.ajax({
//         type: "POST",
//         data: $("#").serialize(),
//         url: "https://pm.b/save_create_project",
//         success:()=>{

//         },
//         error:()=>{

//         }
//     })
// }