console.log(sessionStorage.getItem('project_id'));
$.ajax({
    type: "post",
    data: {'project_id':sessionStorage.getItem('project_id')},
    url: "http://pm.b/one_project",
    success:(response)=>{
        let project = response.project;
            $.each(project, function(key, value){ 
                    id_proj = value.id;
                    finish = Math.floor(Date.parse(value.finished_at)/86400000);
                    today = Math.floor(Date.now()/86400000);
                    if(finish == today){
                        diff = 'Последний день!';
                    }
                    else if(finish > today){
                        diff = finish-today;
                    }
                    else{
                        diff = 'Просрочено!';
                    }
                    $(".titleOneProject").append(value.title);
                    $(".row1").append(value.started_at);
                    $(".row2").append(value.finished_at);
                    $(".row3").append(diff);
                    $(".row4").append(value.status);
                    $("#descProj").append(value.description);
                    $("#one_current_m").append(value.name);
            });
            squad = response.squad;

            let arr_from_squad = [];
            $.each(squad, function(key, value){
                console.log(key);
                arr_from_squad.push(key);
                let div = document.createElement('div');
                div.classList.add('worker');
                div.innerHTML = `${value} <img src='../img/x_white.svg' alt='' onclick(delete_from_squad(${key}))>`;
                $("#current_squad").append(div);
            })
            let btn_add_squad = document.createElement('div');
            btn_add_squad.classList.add('updateSquad');
            btn_add_squad.setAttribute('onclick', 'add_to_squad_modal(['+arr_from_squad+'], '+id_proj+')');
            btn_add_squad.innerHTML = `+`;
            $("#current_squad").append(btn_add_squad);
            

    },
    error:()=>{
        console.log('ggg');
    }
})

// function delete_from_squad(id){
//     $.ajax({
//         type: "post",
//         data: {'id':id},
//         url: "http://pm.b/one_project",
//         success:(response)=>{
            
//         },
//         error:()=>{
//             console.log('ggg');
//         }
//     })
    
// }

function add_to_squad_modal(arr_squad){
    console.log('qwert');
    $.ajax({
        type: "post",
        data: {'squad':arr_squad},
        url: "http://pm.b/update_squad",
        success:(response)=>{
            console.log(response.users);
            let selects;
            selects = `<option value=''>Выберите исполнителя</option>`;
            $.each(response.users, function(key, value){
                selects += `<option value='${value.id}'>${value.name}</option>`;
            })

            let div = document.createElement('div');
            div.setAttribute('id','background_blur');
            div.innerHTML = `
                <div id='add_to_squad_modal'>
                    <div id='title_close'>
                        <span>Добавление исполнителя в команду</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                        <form id='form_update_squad' onsubmit='save_update_squad(event)'>
                            <label for='user'>Добавить:
                                <select name='user'>
                                    ${selects}
                                </select>
                            </label>
                            <input type='submit' value='Добавить' id='submit_update_squad'>
                        </form>
                    </div>
                </div>
            `;
            $(".content").append(div);
        },
        error:()=>{
            console.log('lol');
        }
    })
}

function save_update_squad(event){
    event.preventDefault();
    form_data = $("#form_update_squad").serialize();
    $.ajax({
        data:{'project_id':sessionStorage.getItem('project_id'), 'form_data':form_data},
        url:'http://pm.b/save_update_squad',
        type: 'POST',
        success:(response)=>{
            alert(response.mess);
            console.log(response);
            $("#background_blur").remove();
            $("#add_to_squad_modal").remove();
            $(".updateSquad").remove();
            $(".worker").remove();
            let project = response.project;
            $.each(project, function(key, value){ 
                    id_proj = value.id;
                    finish = Math.floor(Date.parse(value.finished_at)/86400000);
                    today = Math.floor(Date.now()/86400000);
                    if(finish == today){
                        diff = 'Последний день!';
                    }
                    else if(finish > today){
                        diff = finish-today;
                    }
                    else{
                        diff = 'Просрочено!';
                    }
                    $(".titleOneProject").empty();
                    $(".titleOneProject").append(value.title);
                    $(".row1").empty();
                    $(".row1").append(`Дата начала: ${value.started_at}`);
                    $(".row2").empty();
                    $(".row2").append(`Дата окончания: ${value.finished_at}`);
                    $(".row3").empty();
                    $(".row3").append(`Осталось дней: ${diff}`);
                    $(".row4").empty();
                    $(".row4").append(`Статус: ${value.status}`);
                    $("#descProj").empty();
                    $("#descProj").append(`Описание:<br> ${value.description}`);
                    $("#one_current_m").empty();
                    $("#one_current_m").append(`Руководитель: ${value.name}`);
            });
            squad = response.squad;

            let arr_from_squad = [];
            $.each(squad, function(key, value){
                console.log(key);
                arr_from_squad.push(key);
                let div = document.createElement('div');
                div.classList.add('worker');
                div.innerHTML = `${value} <img src='../img/x_white.svg' alt='' onclick(delete_from_squad(${key}))>`;
                $("#current_squad").append(div);
            })
            let btn_add_squad = document.createElement('div');
            btn_add_squad.classList.add('updateSquad');
            btn_add_squad.setAttribute('onclick', 'add_to_squad_modal(['+arr_from_squad+'], '+id_proj+')');
            btn_add_squad.innerHTML = `+`;
            $("#current_squad").append(btn_add_squad);
        },
        error:()=>{

        }
    })
}

// $("#form_update_squad").submit(function(event){
//     alert('qwerty');
//     sessionStorage.setItem('resp', 'yes');
//     // event.preventDefault();
//     // $.ajax({
//     //     url: 'http://pm.b/save_update_squad',
//     //     type: 'post',
//     //     data: $('#form_update_squad').serialize(),
//     //     success:(response)=>{
//     //         sessionStorage.setItem('resp', 'yes');
//     //         // Whatever you want to do after the form is successfully submitted
//     //     }
//     // });
// })

// $("#form_update_squad").on('submit', function(e){
//     e.preventDefault();
//     form_data = $(this).serialize();
//     $.ajax({
//         type: "POST",
//         data: {'project_id':sessionStorage.getItem('project_id'), 'form':form_data}, 
//         url: 'http://pm.b/save_update_squad', 
//         success: (response)=>{
//             console.log(response);
//             return false;
//         },
//         error:()=>{
//             console.log('bad');
//         }
//     })
// });



// $(document).ready(function(){
//     $("#form_update_squad").on('submit', function(event){
//         event.preventDefault();
//         // let data = $(this).serialize();
//         $.ajax({
//             type: "POST", 
//             data: {'data':$("#form_update_squad").serialize()},
//             url:'http://pm.b/save_update_squad',
//             success:(response)=>{
//                 console.log(response);
//             },
//             error:()=>{

//             }

//         })
//     })
// })



// $("document").ready(()=>{
//     $("#form_update_squad").submit((e)=>{
//     e.preventDefault();
// function form_update_squad(event){
//     event.preventDefault();
//     $.ajax({
//         url: "http://pm.b/save_update_squad", 
//         method: "POST", 
//         data: $("#form_update_squad").serialize(),
//         success:(response)=>{
//             alert('yes');
//             console.log(response);
//         },
//         error:()=>{
//             alert('no');
//             console.log('nono');
//         }
//     })
// }
        
        
//     })
// })

function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}