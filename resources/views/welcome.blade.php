<!DOCTYPE html> <html lang="{{ str_replace('_', '-', app()->getLocale
()) }}"> <head> <meta charset="utf-8"> <meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Registro de memorias de cátedra y planificaciones</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 50px;
    }

    .links > a {
        color: #010e14;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
</head>
<body>
<div class="flex-center position-ref full-height">
    
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}" class="text-sm text-black-700 dark:text-dark-500 underline">Inicio</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-black-700 dark:text-dark-500 underline">Acceder</a>
            <a href="{{ route('register') }}" class="text-sm text-black-700 dark:text-dark-500 underline">Registrarse</a>
        @endauth
    </div>

    <div class="content">
        <div>
            <img src="logo_full.jpg" style="width: center; height: 100%;">
        </div>
        
        <div class="title m-b-md">
            Planificaciones y Memorias de Cátedras
        </div>

    </div>
</div>
</body>
</html>

