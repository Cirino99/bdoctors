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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/back.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
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
            {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                Default dropdown
            </button> --}}

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        <li class="nav-item dropdown d-flex justify-content-end me-3">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu flex-end" aria-labelledby="navbarDropdown">
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
                <div class="d-flex flex-shrink-0 mt-3" >
                    <ul class="nav nav-pills mb-auto d-flex flex-column align-content-center">
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.dashboard') }}" class="nav-link link-dark d-flex align-items-baseline" aria-current="page">
                          <i class="fa-solid fa-house-user fs-5 my-auto"></i>
                          <span class="d-none d-sm-block d-lg-block my-auto ms-2">Dashboard</span>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.profile.edit', ['profile' => Auth::id()]) }}" class="nav-link link-dark d-flex align-items-baseline">
                          <i class="fa-solid fa-pen fs-5 my-auto"></i>
                          <span class="d-none d-sm-block d-lg-block my-auto ms-2 col-sm-12">Modifica Profilo</span>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.profile.show', ['profile' => Auth::id()]) }}" class="nav-link link-dark d-flex align-items-baseline">
                          <i class="fa-solid fa-eye fs-5 my-auto"></i>
                          <span class="d-none d-sm-block d-lg-block my-auto ms-2 col-12">Visualizza Profilo</span>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.messages.index') }}" class="nav-link link-dark d-flex align-items-baseline">
                          <i class="fa-solid fa-envelope fs-5 my-auto"></i>
                          <span class="d-none d-sm-block d-lg-block my-auto ms-2">Messaggi</span>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.reviews.index') }}" class="nav-link link-dark d-flex align-items-baseline">
                            <i class="fa-solid fa-users fs-5 my-auto"></i>
                            <span class="d-none d-sm-block d-lg-block my-auto ms-2">Recensioni</span>
                        </a>
                      </li>
                      <li class="side-nav-li my-1">
                        <a href="{{ route('doctor.sponsorships.index') }}" class="nav-link link-dark d-flex align-items-baseline">
                          <i class="fa-solid fa-cart-shopping fs-5 my-auto"></i>
                          <span class="d-none d-sm-block d-lg-block my-auto ms-2">Sponsorizzazioni</span>
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
