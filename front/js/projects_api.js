// Добавить действие из подробнее в редактирвоание (админ)
// Добавить удаление из команды (желательно найти код) 

$.ajax({
    type: "post",
    url: "http://pm.b/projects",
    success:(response)=>{
        let projects = response.projects;
        title = ""; 
        console.log(response);
            $.each(projects, function(key, value){ 
                    let tr = document.createElement('tr'); 
                    tr.classList.add('infoRow');
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
                        title = title=`title = "админу не доступны инструменты управления!"`;
                    }
                    tr.innerHTML = `
                    <td class="taskN">${value.title}</td>
                    <td class="taskD">${value.description}</td>
                    <td class="taskM">${value.name}</td>
                    <td class="taskW">${value.status}</td>
                    <td class="taskP">${value.started_at}</td>
                    <td class="taskE">${value.finished_at}</td>
                    <td class="taskS" onclick="get_info_one_project(${value.project_id})">Подробнее</td>
                        <td class="taskA"><div ${title} class="BTWAct"><img onclick="get_info_one_project(${value.project_id})" src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                    $("#projectsTable").append(tr);
            });

            // if(response.count>10){
            //     let paginate_d = $("#paginate");
            //     let pages = Math.ceil(response.count/10);
            //         for(let i=1; i<=pages; i++){
            //             console.log(i);
            //             paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
            //             paginate_d.append(paginate);
            //         }
            //     // paginate_d.append(paginate);
            // }
    },
    error:()=>{
        alert('Не удалось получить данные о проектах!');
    }
})


function change_page(page_id){
    $.ajax({
        type : "POST",
        data: {page_id:page_id}, 
        url: "http://pm.b/page_projects",
        success: (response)=>{
            $(".infoRow").remove();
            $(".btn_paginate").remove();
            title = "";
            let projects = response.projects; 
            console.log(response);
            $.each(projects, function(key, value){ 
                    let tr = document.createElement('tr'); 
                    tr.classList.add('infoRow');
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
                        title = `title = "админу не доступны инструменты управления!"`;
                    }
                    tr.innerHTML = `
                    <td class="taskN">${value.title}</td>
                    <td class="taskD">${value.description}</td>
                    <td class="taskM">${value.name}</td>
                    <td class="taskW">${value.status}</td>
                    <td class="taskP">${value.started_at}</td>
                    <td class="taskE">${value.finished_at}</td>
                    <td class="taskS" onclick="get_info_one_project(${value.project_id})">Подробнее</td>
                        <td class="taskA"><div ${title} class="BTWAct"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                    $("#projectsTable").append(tr);
            });

            // if(response.count>10){
            //     let paginate_d = $("#paginate");
            //     let pages = Math.ceil(response.count/10);
            //         for(let i=1; i<=pages; i++){
            //             console.log(i);
            //             paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
            //             paginate_d.append(paginate);
            //         }
            //     // paginate_d.append(paginate);
            // }
        },
        error: ()=>{
            window.sessionStorage.setItem('tasks', 'Нет задач!');
            alert('Не удалось получить больше проектов!');
        }
    })  
}


function get_info_one_project(project_id){
    $.ajax({
        type: "POST",
        data: {project_id:project_id},
        success:(response)=>{
            location.href='project_info.php';
            sessionStorage.setItem('project_id', project_id);
        },
        error:()=>{
            alert('Не удалось перейти к подробной информации проекта!');
        }
    })
}