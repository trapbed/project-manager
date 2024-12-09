function first_step_create_project(){
    let div = document.createElement('div');
    div.setAttribute('id','background_blur');
    div.innerHTML = `
        <div id='add_to_squad_modal'>
            <div id='title_close'>
                <span>Создание отчета</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                <form id='form_update_squad' onsubmit='second_step_create_report(event)'>
                    <label for='user'>Параметр:
                        <select required name='aspect'>
                            <option value="">Выберите по какому параметру делать отчет</option>
                            <option value="worker">Исполнитель</option>
                            <option value="project">Проект</option>
                        </select>
                    </label>
                    <input type='submit' value='Создать' id='submit_update_squad'>
                </form>
            </div>
        </div>
    `;
    $(".content").append(div);
}

function second_step_create_report(event){
    event.preventDefault();
    aspect = $("#form_update_squad").serialize().replace('aspect=','');
    $.ajax({
        type:"POST", 
        data:{'aspect':aspect},
        url: "http://pm.b/get_data_for_report",
        success:(response)=>{
            console.log(response);
            switch(aspect){
                case 'worker':
                    title = 'исполнителю';
                    label = 'Выберите исполнителя:';
                    break;
                case 'project':
                    title = 'проекту';
                    label = 'Выберите проект:';
                    break;
            }
            select_data = ``;
            // console.log($("#form_update_squad").serialize());
            $.each(response, function(key, value){
                console.log(value.id);
                console.log(value.name);
                select_data += `<option value='${value.id}'>${value.name}</option>`;
            })
            // if(sessionStorage.getItem('role') ==''){

            // }
            // else{

            // }
            // console.log(sessionStorage);
            $("#add_to_squad_modal").remove();
            let div = document.createElement('div');
            div.setAttribute('id','add_to_squad_modal');
            div.innerHTML = `
                <div id='title_close'>
                    <span>Создание отчета по ${title}</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                    <form id='form_update_squad' onsubmit='get_data_to_create_report(event)'>
                        <input type="hidden" name="id_creator" value="${sessionStorage.getItem('id')}">
                        <input type='hidden' value="${aspect}" name="aspect">
                        <label for='data'>${label}
                            <select name='data'>
                                <option value="">${label}</option>
                                ${select_data}
                            </select>
                        </label>
                        <label for='time'>Сроки:
                            <select name='time'>
                                <option value="">Выберите промежуток времени</option>
                                <option value="year">Год</option>
                                <option value="month">Месяц</option>
                                <option value="week">Неделя</option>
                            </select>
                        </label>
                        <div id='btns_create_project'>
                            <button onclick="go_back(event, '${aspect}')">Назад</button>
                            <input type='submit' value='Создать' id='submit_update_squad'>
                        </div>
                        
                    </form>
                </div>
            `;
            $(".content").append(div);
        },
        error:()=>{

        }
    })
}

function go_back(event, aspect){
    event.preventDefault();
    $("#add_to_squad_modal").remove();
    aspects = {'worker':'Исполнитель','project':'Проект'};
    options = ``;
    $.each(aspects, function(key, value){ 
        if(aspect == key){
            options += `<option selected value="${key}">${value}</option>`;
        }
        else{
            options += `<option value="${key}">${value}</option>`;
        }
    })
    let div = document.createElement('div');
    div.setAttribute('id','add_to_squad_modal');
    div.innerHTML = `
            <div id='title_close'>
                <span>Создание отчета</span><img onclick='close_modal()' src='../img/x.svg' alt='close'></div>
                <form id='form_update_squad' onsubmit='second_step_create_report(event)'>
                    <label for='user'>Параметр:
                        <select required name='aspect'>
                            ${options}
                        </select>
                    </label>
                    <input type='submit' value='Создать' id='submit_update_squad'>
                </form>
            </div>
    `;
    $(".content").append(div);
}

function get_data_to_create_report(event){
    event.preventDefault();
    $.ajax({
        type:"POST",
        data:$("#form_update_squad").serialize(),
        url:"http://pm.b/get_data_to_create_report",
        success:(response)=>{
            create_report(response);
        },
        error:()=>{
            alert('Не удалось собрать данные!');
        }
    })
}
function create_report(response){
    console.log(response.report);
    array_with_arrays = [];
    $.each(response.report, function(key, value){
        array2 = [];
        count = 1;
        $.each(value, function(key1, value1){
            // array2[key1] = value1;
            array2.push(value1);
            // count++;
        })
        array_with_arrays[key] = array2;
        // array_with_arrays.push(array2);
    })
    console.log(array_with_arrays);
    console.log(array_with_arrays.length);
    $.ajax({
        type:"POST", 
        data:{'report':JSON.stringify(array_with_arrays), 'aspect': response.aspect,'id':response.id,'id_creator': sessionStorage.getItem('id')},
        url:"http://pm.b/create_report",
        success:(response)=>{
            // console.log(array_with_arrays);
            console.log(response);
        },
        error:()=>{
            alert('Не удалось создать отчет!');

        }
    })
}

function close_modal(){
    $("#background_blur").remove();
    $("#add_to_squad_modal").remove();
}

