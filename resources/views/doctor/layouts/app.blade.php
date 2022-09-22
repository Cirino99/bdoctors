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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm d-flex justify-content-between">
            <a class="navbar-brand mx-3" href="{{ url('/') }}">
                {{-- {{ config('app.name', 'Laravel') }} --}}
                {{-- logo main --}}
                <img class="logo d-none d-sm-flex d-lg-flex" src="{{ asset('img/BDoctors_logo_2.svg') }}" alt="logo">
                {{-- logo responsive --}}
                <img class="logo d-flex d-sm-none d-lg-none" src="{{ asset('img/BDoctors_logo_2_resp.svg') }}" alt="logo-resp">
            </a>
            <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown d-flex justify-content-center mx-3">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Esci') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="d-flex">
            <section class="left-menu d-flex justify-content-center">
                <div class="d-flex flex-column flex-shrink-0 mt-3" >
                    <ul class="nav nav-pills mb-auto flex-column d-flex align-content-center">
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.dashboard') }}" class="nav-link link-dark d-flex align-items-baseline gap-2" aria-current="page">
                          <i class="fa-solid fa-house-user fs-5 my-auto"></i>
                          <h6 class="d-none d-sm-block d-lg-block my-auto">Dashboard</h6>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.profile.edit', ['profile' => Auth::id()]) }}" class="nav-link link-dark d-flex align-items-baseline gap-2">
                          <i class="fa-solid fa-pen fs-5 my-auto"></i>
                          <h6 class="d-none d-sm-block d-lg-block my-auto col-sm-12">Modifica Profilo</h6>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.profile.show', ['profile' => Auth::id()]) }}" class="nav-link link-dark d-flex align-items-baseline gap-2">
                          <i class="fa-solid fa-eye fs-5 my-auto"></i>
                          <h6 class="d-none d-sm-block d-lg-block my-auto col-12">Visualizza Profilo</h6>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.messages.index') }}" class="nav-link link-dark d-flex align-items-baseline gap-2">
                          <i class="fa-solid fa-envelope fs-5 my-auto"></i>
                          <h6 class="d-none d-sm-block d-lg-block my-auto">Messaggi</h6>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.reviews.index') }}" class="nav-link link-dark d-flex align-items-baseline gap-2">
                            {{-- <img src="{{ asset('img/BDoctors_user_icon.svg') }}" alt="user-icon" style="max-width: 100%; height: 27px"> --}}
                            <i class="fa-solid fa-users fs-5 my-auto"></i>
                            <h6 class="d-none d-sm-block d-lg-block my-auto">Recensioni</h6>
                        </a>
                      </li>
                      <li class="side-nav-li">
                        <a href="{{ route('doctor.sponsorships.index') }}" class="nav-link link-dark">
                          <i class="fa-solid fa-message"></i>
                          Sponsorizzazioni
                        </a>
                      </li>
                    </ul>
                  </div>

            </section>
            <section class="right-content my-4">
                @yield('content')
            </section>

        </main>
    </div>
</body>
</html>
