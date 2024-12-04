$("document").ready(()=>{
    $("#login_api").submit((event)=>{
        event.preventDefault();
        $.ajax({
            url: "http://pm.b/login", 
            method: "POST", 
            data: $("#login_api").serialize(),
            success:(response)=>{
                    console.log(response);
                if(response.res){
                    sessionStorage.setItem('role',response.role);
                    sessionStorage.setItem('email',response.email);
                    sessionStorage.setItem('id',response.id);
                    sessionStorage.setItem('name', response.name);
                    location.href= response.role+'/tasks.php';
                    sessionStorage.setItem('mess', response.mess);
                }
                else{
                    alert(response.mess);
                }
            },
            error: ()=>{
                alert('Не удалось войти!');
            }
        })
    })
})