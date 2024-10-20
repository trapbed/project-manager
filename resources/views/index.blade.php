<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="\css\style.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div id="backgrounfdModal">
        <div id="formLogin">
            <form action="{{route('login')}}" method="post">
                @csrf
                <h1>Войти</h1>
                <label>
                    Почта
                    <input type="text" name="email" class="form-control @error('title') is-invalid @enderror" >
                </label>
                <label>
                    Пароль
                    <input type="password" name="pass" class="form-control @error('content') is-invalid @enderror" >
                </label>
                <input type="submit" value="Войти">
            </form>
        </div>
    </div>    
</body>
</html>