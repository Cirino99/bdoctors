@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center flex-wrap">
        <div class="col-md-12 col-lg-12">
            <div class="card p-3">
                {{-- <div class="card-header bg-gradient fw-bold" style="background: #00c7ff; border-color: #00c7ff; ">{{ __('Sponsorizzazioni') }}</div> --}}
                <h2 class="p-3 m-auto">Sponsorizzazioni</h2>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user !== 0)
                        <h2>La tua sponsorizzazione finisce il {{$user[0]->sponsorships[0]->pivot->ending_date}}</h2>
                    @else
                        <!-- abbonamenti -->
                        <div class="d-flex justify-content-center flex-wrap text-center">
                            @foreach ($sponsorships as $sponsorship)
                                <div class="card bg-light shadow m-5 bg-white rounded" style="max-width: 18rem; min-width: 18rem;">
                                    @if ($sponsorship->id == 1)
                                        <div class="card-header">
                                            <h4 class="my-0">Base</h4>
                                        </div>
                                    @elseif ($sponsorship->id == 2)
                                        <div class="card-header" style="background: #FDBC44">
                                            <h4 class="my-0">Avanzato</h4>
                                        </div>
                                    @else
                                        <div class="card-header" style="background: #19CBCE">
                                            <h4 class="my-0">Pro</h4>
                                        </div>
                                    @endif
                                    <div class="card-body bg-white">
                                        <h1 class="card-title fst-italic">
                                            {{$sponsorship->price}} <small>€</small>
                                            <small class="text-muted h3">/ {{$sponsorship->time}} ore</small>
                                        </h1>
                                        <p class="card-text">Sponsorship</p>
                                        <div class="list-unstyled mt-3 mb-4">
                                            <li>Comparsa in HomePage</li>
                                            <li class="mt-2">Comparsa tra i primi risultati di ricerca</li>
                                        </div>
                                        <a href="{{ route('doctor.sponsorships.show', ['sponsorship' => $sponsorship->id]) }}"
                                        class="btn bg-secondary bg-gradient rounded-pill border-0 p-2 px-3 text-light">
                                            Abbonati
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <ul>
                            @foreach ($sponsorships as $sponsorship)
                                <li>
                                    <strong>Durata:</strong> {{$sponsorship->time}} ore - <strong>Prezzo:</strong> {{$sponsorship->price}}€
                                    <a href="{{ route('doctor.sponsorships.show', ['sponsorship' => $sponsorship->id]) }}">
                                        Buy
                                    </a>
                                </li>
                            @endforeach
                        </ul> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
