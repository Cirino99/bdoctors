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

                    <ul>
                        <li>
                            <a href="{{ route('doctor.profile.edit', ['profile' => Auth::id()]) }}">Edit</a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.profile.show', ['profile' => Auth::id()]) }}">Show</a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.messages.index') }}">Messaggi</a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.reviews.index') }}">Recensioni</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
