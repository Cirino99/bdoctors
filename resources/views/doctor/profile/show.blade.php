@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Show</h1>
                    <span>Nome: {{ $user->name }}</span><br>
                    <span>Cognome: {{ $user->lastname }}</span>
                    <ul>
                        @foreach ($user->specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection