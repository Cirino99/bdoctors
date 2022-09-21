@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($reviews as $review)
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger bg-gradient bg-opacity-75 border-bottom border-danger d-flex justify-content-between">
                        <div class="d-flex justify-content-baseline gap-2">
                            <img src="{{ asset('img/BDoctors_user_icon_2.svg') }}" alt="user-icon" style="max-width: 18px">
                            {{ $review->name }}
                        </div>
                        {{ __('recensione del ' . $review->date) }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul>
                            <li class="list-unstyled">
                                <span>Voto: {{$review->vote}}</span>
                                <p>{{$review->review}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
