<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/back.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/back.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img class="logo" src="{{ asset('img/BDoctors_logo.svg')}}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 d-flex">
            <section class="left-menu">
                
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" >
                    <ul class="nav nav-pills flex-column mb-auto">
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.dashboard') }}" class="nav-link link-dark" aria-current="page">
                          Dashboard
                        </a>
                      </li>
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.profile.edit', ['profile' => Auth::id()]) }}" class="nav-link link-dark">
                          Edit
                        </a>
                      </li>
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.profile.show', ['profile' => Auth::id()]) }}" class="nav-link link-dark">
                          Show
                        </a>
                      </li>
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.messages.index') }}" class="nav-link link-dark">
                          Messaggi
                        </a>
                      </li>
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.reviews.index') }}" class="nav-link link-dark">
                          Recensioni
                        </a>
                      </li>
                    </ul>
                  </div>

            </section>
            <section class="right-content">
                @yield('content')
            </section>
            
        </main>
    </div>
</body>
</html>





