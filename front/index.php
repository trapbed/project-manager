<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\css\style.css">
    <script src="../js/jquery.min.js"></script>
</head>
<body>
    <!-- <script>
        console.log(sessionStorage);
    </script> -->

    <div id="backgrounfdModal">
        <div id="formLogin">
            <form id="login_api" method="POST">
                <h1>Войти</h1>
                <label>
                    Почта
                    <input type="text" name="email" class="form-control" >
                </label>
                <label>
                    Пароль
                    <input type="password" name="password" class="form-control" >
                </label>
                <input type="submit" value="Войти">
            </form>
        </div>
    </div>    
    <script src="\js\script_api.js"></script>
</body>
</html>