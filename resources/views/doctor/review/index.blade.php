@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-11 col-md-10 col-lg-10">
            @foreach ($reviews as $review)
                <div class="card border-success mb-3">
                    <div class="card-header bg-success bg-gradient bg-opacity-50 border-bottom border-success d-flex flex-wrap justify-content-between">
                        <div class="d-flex justify-content-baseline gap-2">
                            <img src="{{ asset('img/BDoctors_user_icon_2.svg') }}" alt="user-icon" style="max-width: 18px">
                            <span class="me-4">{{ $review->name }}</span>
                        </div>
                        {{ __('recensione del ' . $review->date) }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="p-0">
                            <li class="list-unstyled">
                                <span><b class="fst-italic">Voto: </b> {{$review->vote}}</span>
                                <p class="mt-2">{{$review->review}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
