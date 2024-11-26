console.log(sessionStorage.getItem('role'));
console.log(sessionStorage.getItem('email'));
console.log(sessionStorage.getItem('id'));
let newClass ;
let title;

$.ajax({
    type: 'post',
    url: 'http://pm.b/users',
    success:(response)=>{
        let users = response.users; 
        console.log(response);
            $.each(users, function(key, value){ 
                let img_block = 'block_user';
                let src_block = '';
                if(value.blocked == '1'){
                    img_block = 'unblock_user';
                }
                    let tr = document.createElement('tr'); 
                    tr.classList.add("infoRow");
                    
                    if(sessionStorage.getItem('role') != 'admin'){
                        newClass = 'blur'; 
                        title = 'title="Aдмину не доступны инструменты управления!"';
                    }
                    if(sessionStorage.getItem('id') == value.id){
                        src_block = '';
                    }
                    else{
                        src_block = `<div onClick="block_user(${value.id}, ${value.blocked})"><img  src="../img/${img_block}.svg"></div>`;
                    }
                    tr.innerHTML = `
                        <td class="userN">${value.name}</td>
                        <td class="userE">${value.email}</td>
                        <td class="userR">${value.role}</td>
                        <td class="taskA"><div class="BTWAct ${newClass}">${src_block}</div></td>`;

                        // <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                    $("#usersTable").append(tr);
                    // console.log(value.blocked);
            });

            if(response.count>10){
                let paginate_d = $("#paginate");
                let pages = Math.ceil(response.count/10);
                    for(let i=1; i<=pages; i++){
                        console.log(i);
                        paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                    }
                $("#session").append(paginate);
                alert(response.mess);
                sessionStorage.removeItem('mess');
            }
    },
    error: ()=>{
        window.sessionStorage.setItem('tasks', 'Нет пользователей!');
        console.log('NONO');
    }
})
function change_page(page_id){
    $.ajax({
        type : "POST",
        data: {page_id:page_id}, 
        url: "http://pm.b/page",
        success: (response)=>{
            $(".infoRow").remove();
            window.sessionStorage.setItem('tasks', response);
            let tasks = response; 
            $.each(tasks, function(key, value){
                    if(sessionStorage.getItem('role') == 'admin'){
                        newClass = 'blur'; 
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
                    <td class="taskA"><div class="BTWAct ${newClass}"><img src="../img/block_user.png"></div></td>`;
                    // console.log(key);
                    $("#tasksTable").append(tr);
            });
            if(response.count>10){
                let paginate_d = $("#paginate");
                let pages = Math.ceil(response.count/10);
                console.log(pages);
                console.log(paginate_d);
                    for(let i=1; i<=pages; i++){
                        console.log(i);
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
function block_user(id, now_blocked){
    // console.log(id, now_blocked);
    $.ajax({
        type: 'POST',
        url: 'http://pm.b/blocked_user',
        data: {"id":id, "now_blocked":now_blocked},
        success:(response)=>{
            $(".infoRow").remove();
            // let new_src = 'unblock_user';
            // if(now_blocked == 1){
            //     new_src = 'block_user';
            // }
            // $(this).attr('src', new_src+'.svg');




            let users = response.users; 
            console.log(response);
                $.each(users, function(key, value){ 
                    let img_block = 'block_user';
                    let src_block = '';
                    if(value.blocked == '1'){
                        img_block = 'unblock_user';
                    }
                        let tr = document.createElement('tr'); 
                        tr.classList.add("infoRow");
                        
                        if(sessionStorage.getItem('role') != 'admin'){
                            newClass = 'blur'; 
                            title = 'title="админу не доступны инструменты управления!"';
                        }
                        if(sessionStorage.getItem('id') == value.id){
                            src_block = '';
                        }
                        else{
                            src_block = `<div onClick="block_user(${value.id}, ${value.blocked})"><img  src="../img/${img_block}.svg"></div>`;
                        }
                        tr.innerHTML = `
                            <td class="userN">${value.name}</td>
                            <td class="userE">${value.email}</td>
                            <td class="userR">${value.role}</td>
                            <td class="taskA"><div class="BTWAct ${newClass}">${src_block}</div></td>`;
    
                            // <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                        $("#usersTable").append(tr);
                        // console.log(value.blocked);
                });
    
                if(response.count>10){
                    let paginate_d = $("#paginate");
                    let pages = Math.ceil(response.count/10);
                        for(let i=1; i<=pages; i++){
                            console.log(i);
                            paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                        }
                    $("#session").append(paginate);
                } 
                alert(response.mess);
                sessionStorage.removeItem('mess');
        },
        error:()=>{

        }
    })
        // $.ajax({
        //     type: 'post',
        //     url: 'http://pm.b/users',
        //     success:(response)=>{
        //         $("#usersTable").empty();
        //         let users = response.users; 
        //         console.log(response);
        //             $.each(users, function(key, value){ 
        //                 let img_block = 'block_user';
        //                 if(value.blocked == '1'){
        //                     img_block = 'unblock_user';
        //                 }
        //                     let tr = document.createElement('tr'); 
        //                     tr.classList.add("infoRow");
                            
        //                     if(sessionStorage.getItem('role') != 'admin'){
        //                         newClass = 'blur'; 
        //                         title = 'title="админу не доступны инструменты управления!"';
        //                     }
        //                     tr.innerHTML = `
        //                         <td class="userN">${value.name}</td>
        //                         <td class="userE">${value.email}</td>
        //                         <td class="userR">${value.role}</td>
        //                         <td class="taskA"><div class="BTWAct ${newClass}"><div onClick="block_user(${value.id}, ${value.blocked})"><img  src="../img/${img_block}.svg"></div></div></td>`;
        
        //                         // <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
        //                     $("#usersTable").append(tr);
        //                     console.log(value.blocked);
        //             });
        
        //             if(response.count>10){
        //                 let paginate_d = $("#paginate");
        //                 let pages = Math.ceil(response.count/10);
        //                     for(let i=1; i<=pages; i++){
        //                         console.log(i);
        //                         paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
        //                     }
        //                 $("#session").append(paginate);
        //             }
        //     },
        //     error: ()=>{
        //         window.sessionStorage.setItem('tasks', 'Нет пользователей!');
        //         console.log('NONO');
        //     }
        // })

}

$("document").ready(()=>{
    $("#form_create_user").submit((event)=>{
        event.preventDefault();
        $.ajax({
            url: "http://pm.b/create_user", 
            method: "POST", 
            data: $("#form_create_user").serialize(),
            success:(response)=>{
                $(".back_modal").css('display','none');
                $(".infoRow").remove();
                // let new_src = 'unblock_user';
                // if(now_blocked == 1){
                //     new_src = 'block_user';
                // }
                // $(this).attr('src', new_src+'.svg');
    
    
    
    
                $(".infoRow").remove();
                // let new_src = 'unblock_user';
                // if(now_blocked == 1){
                //     new_src = 'block_user';
                // }
                // $(this).attr('src', new_src+'.svg');
    
    
    
    
                let users = response.users; 
                console.log(response);
                    $.each(users, function(key, value){ 
                        let img_block = 'block_user';
                        let src_block = '';
                        if(value.blocked == '1'){
                            img_block = 'unblock_user';
                        }
                            let tr = document.createElement('tr'); 
                            tr.classList.add("infoRow");
                            
                            if(sessionStorage.getItem('role') != 'admin'){
                                newClass = 'blur'; 
                                title = 'title="админу не доступны инструменты управления!"';
                            }
                            if(sessionStorage.getItem('id') == value.id){
                                src_block = '';
                            }
                            else{
                                src_block = `<div onClick="block_user(${value.id}, ${value.blocked})"><img  src="../img/${img_block}.svg"></div>`;
                            }
                            tr.innerHTML = `
                                <td class="userN">${value.name}</td>
                                <td class="userE">${value.email}</td>
                                <td class="userR">${value.role}</td>
                                <td class="taskA"><div class="BTWAct ${newClass}">${src_block}</div></td>`;
        
                                // <td class="taskA"><div ${title} class="BTWAct ${newClass}"><img src="../img/edit.png"><img src="../img/delete.png"></div></td>`;
                            $("#usersTable").append(tr);
                            // console.log(value.blocked);
                    });
        
                    if(response.count>10){
                        let paginate_d = $("#paginate");
                        let pages = Math.ceil(response.count/10);
                            for(let i=1; i<=pages; i++){
                                console.log(i);
                                paginate.innerHTML += `<div class="btn_paginate" onclick="change_page(${i})">${i}</div>`;
                            }
                        $("#session").append(paginate);
                    }
                    alert(response.mess);
                    sessionStorage.removeItem('mess');
                },
            error: ()=>{
                alert('Не удалось создать пользователя!');
            }
        })
    })
})