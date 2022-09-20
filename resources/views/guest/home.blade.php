<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BDoctors</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
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
    <nav class="navbar shadow-sm">
        {{-- <img class="logo mx-3" src="{{ asset('img/BDoctors_logo_2.svg') }}" alt="logo"> --}}
        <a class="navbar-brand mx-3" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}
            {{-- logo main --}}
            <img class="logo d-none d-sm-flex d-lg-flex" src="{{ asset('img/BDoctors_logo_2.svg') }}" alt="logo">
            {{-- logo responsive --}}
            <img class="logo d-flex d-sm-none d-lg-none" src="{{ asset('img/BDoctors_logo_2_resp.svg') }}" alt="logo-resp">
        </a>
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
    <div id="root"></div>
 
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-secondary text-light">
        
        {{-- upper footer  --}}
        <section class="pt-3">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        {{-- logo --}}
                        <a class="text-uppercase fw-bold mb-4" href="{{ url('/') }}">
                            <img class="logo d-sm-flex d-md-flex d-lg-flex" src="{{ asset('img/BDoctors_logo_2_resp.svg') }}" alt="logo-resp">
                        </a>
                        <p class="mt-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam repudiandae ad impedit quisquam, repellendus molestias doloribus.
                        </p>
                    </div>
                    {{-- contatti --}}
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contatti</h6>
                        <p>
                            <i class="fa-solid fa-location-dot me-3"></i> 
                            Roma, RO 00123, IT
                        </p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@bdoctors.com
                        </p>
                        <p>
                            <i class="fas fa-phone me-3"></i>
                            + 39 345 678 99
                        </p>
                        <p>
                            <i class="fas fa-print me-3"></i>
                            + 39 345 678 90
                        </p>
                    </div>
                    
                    {{-- azienda --}}
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                        Azienda
                        </h6>
                        <p>
                            <a href="{{ url('/about') }}" class="text-reset">About Us</a>
                        </p>
                        <p>
                            <a href="{{ url('/contacts') }}" class="text-reset">Contact Us</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Privacy</a>
                        </p>
                    </div>

                    {{-- link utili --}}
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                        link utili
                        </h6>
                        <p>
                            <a href="{{ url('/search') }}" class="text-reset">Ricerca avanzata</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- bottom footer -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Copyright: BDoctors Tutti i diritti riservati
        </div>
    </footer>
    <script src="{{ asset('js/front.js') }}"></script>
</body>

</html>
