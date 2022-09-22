@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sponsorizzazioni') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user !== 0)
                        <h2>La tua sponsorizzazione finisce il {{$user[0]->sponsorships[0]->pivot->ending_date}}</h2>
                    @else
                    <ul>
                        @foreach ($sponsorships as $sponsorship)
                            <li>
                                <strong>Durata:</strong> {{$sponsorship->time}} ore - <strong>Prezzo:</strong> {{$sponsorship->price}}€
                                <a href="{{ route('doctor.sponsorships.show', ['sponsorship' => $sponsorship->id]) }}">
                                    Buy
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection