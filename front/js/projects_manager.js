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
            </div>
                `;
                $("#infoRows").append(div);

            })
        }
        else{
            div = document.createElement(`div`);
            div.setAttribute('id','noContentText');
            div.innerHTML = `У вас нет проектов!`;
            $(".content").append(div);
        }
        
    },
    error:()=>{
        alert('Не удалось загрузить проекты!');
    }
})

function delete_project(id){
    id_project = id;
    $.ajax({
        type: "POST",
        data: {"id_proj": id_project},
        url: "http://pm.b/delete_project",
        success:(response)=>{
            
        }, 
        error:()=>{
            alert('');
        }
    })
}

function update_project_modal(id){
    id_project = id;
    $.ajax({
        type: "POST",
        data: {"id_proj": id_project},
        url: "http://pm.b/update_project_info",
        success:(response)=>{
            console.log(response);

            project = response.project[0];
console.log(project);

            div_form = document.createElement(`div`);
            div_form.setAttribute('id','background_blur'); 
            selects = ``;
            div_form.innerHTML = `
            <div id="add_to_squad_modal">
                <div id='title_close'>
                    <span>Редактирование проекта : ${project.title}</span><img onclick='close_modal()' src='../img/x.svg' alt='close'>
                </div>
                    <form id='form_create_project_end' onsubmit='save_create_project(event)'>
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
                           <select class='fix_inp_width' name='priority'>
                               <option value="Создан">Создан</option>
                               <option value="В процессе">В процессе</option>
                               <option value="Завершен">Завершен</option>
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


function save_create_project(event){
    event.preventDefault();
    $.ajax({
        type: "POST",
        data: $().serialize(),
        url:"",
        success:()=>{

        },
        error:()=>{

        }
    })
}

// function create_project_modal(){

// }


// selects +=`<option value='${key}'>${value}</option>`;
// div_form.innerHTML = `
//         <div id='title_close'>
//         <span>Назначение задачи к проекту: ${info.title}</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
//             <form id='form_create_task_end' onsubmit='create_task(event)'>
//                 <input class='display_none' type='text' name='id_project' value='${info.id}'>
//                 <div>   
//                     <label for='user'>Заголовок:</label>
//                     <input name='title' id='str' type="text">
//                 </div>    
//                 <div>
//                     <label for='user'>Описание:</label>
//                     <input name='description' type="text">
//                 </div>      
//                 <div>   
//                     <label for='user'>Начало:</label>
//                     <input name='started_at' id='date_started_at' onchange="change_min_end()" type="date" min='${info.started_at}' max='${info.finished_at}'>
//                 </div>    
//                 <div> 
//                     <label for='user'>Конец:</label>
//                     <input name='finished_at' id='date_finished_at' type="date" min='${info.started_at}' max='${info.finished_at}'>
//                 </div>    
//                 <div>   
//                     <label for='user'>Исполнитель:</label>
//                     <select name='worker'>
//                         ${selects}
//                     </select>
//                 </div>    
//                 <div>   
//                     <label for='user'>Приоритет:</label>
//                     <select name='priority'>
//                         <option value="Низкий">Низкий</option>
//                         <option value="Высокий">Высокий</option>
//                         <option value="Средний">Средний</option>
//                     </select>
//                 </div>    
//                 <input type='submit' value='Назначить' id='submit_update_squad'>
//             </form>
//     </div> `;
// $('#background_blur').append(div_form);


function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}
