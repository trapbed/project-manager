console.log(sessionStorage);
$.ajax({
    type: "POST",
    data: {'id': sessionStorage.getItem('id')},
    url: "http://pm.b/projects_info_admin",
    success:(response)=>{
        console.log(typeof response);
        console.log(response);
    },
    error:()=>{

    }
})