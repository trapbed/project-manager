<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="\css\style.css">
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="content">
        <div id="leftNavbar">
            <div id="topNavContent">
                <div id="logoNav" class="backgroundNav">
                    <img src="img/icons8-бизнес-сеть-100 1.svg" alt="">
                    <h1 class="mouseHid">Project- Manager</h1>
                </div>
                <div class="br1"></div>
                <div id="linksNav">
                    <div class="linkNav backgroundNav">
                        <img src="/img/team-leader.png" alt="">
                        <h2 class="mouseHid">Пользователи</h2>
                    </div>
                    <div class="br04"></div>
                    <div class="linkNav backgroundNav">
                        <img src="/img/contacts.png" alt="">
                        <h2 class="mouseHid">Задачи</h2>
                    </div>
                    <div class="br04"></div>
                    <div class="linkNav backgroundNav">
                        <img src="/img/projects.png" alt="">
                        <h2 class="mouseHid">Проекты</h2>
                    </div>
                    <div class="br04"></div>
                    <div class="linkNav backgroundNav">
                        <img src="/img/report.png" alt="">
                        <h2 class="mouseHid">Отчеты</h2>
                    </div>
                </div>
                </br>
            </div>
            <div id="accountNav" class="backgroundNav">
                <img src="/img/profile (1).png" alt="">
                @guest
                <span class="mouseHid">Войти</span>
                @endguest

                @auth
                <span class="mouseHid">Аккаунт</span>
                @endauth
            </div>
        </div>

        @yield('content')
    </div>

<script src="/js/script.js"></script>
</body>
</html>