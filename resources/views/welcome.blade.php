<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BDoctors</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: calc(100vh - 80px);
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

        .links>a {
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

        .logo {
            width: auto;
            height: 60px;
        }

        .navbar{
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar">

        <img class="logo" src="{{ asset('img/BDoctors_logo.svg') }}" alt="logo">

        <div class="flex-center">

            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ route('doctor.dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Accedi</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrati</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </nav>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                BDoctors
            </div>
        </div>
    </div>
</body>

</html>
