<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!--favicon-->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
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
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
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
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            <img src="{{ asset('img/logo.png') }}" alt="" style="height: 100px">
            <br>
            {{ config('app.name') }}
        </div>

        <div class="links">
            <p>This is a laravel demo app, for testing purposes please use this credentials</p>
            <ul type="none">
                <li>Lecturer Credentials</li>
                <li><a href="{{ route('admin.login') }}">Lecturer Login</a> <br>Use <b>Email/Password</b> <i>(lecturer@test.com)</i>
                </li>
            </ul>
            <br>
            <ul type="none">
                <li>Student Credentials</li>
                <li><a href="{{ route('login') }}">Student Login</a> <br>Use <b>Email/Password</b>
                    <i>(student@test.com)</i></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
