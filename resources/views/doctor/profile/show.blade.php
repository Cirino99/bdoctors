@extends('doctor.layouts.app')

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
                    @if ($user->photo != null)
                        <img id="preview" class="img-fluid rounded-circle" src="{{ asset('storage/' . $user->photo) }}">
                    @endif
                    <div><strong>Nome:</strong> {{ $user->name }}</div>
                    <div><strong>Cognome:</strong> {{ $user->lastname }}</div>
                    <div><strong>Specializzazioni:</strong></div>
                    <ul>
                        @foreach ($user->specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>

                    <div><strong>Email:</strong> {{ $user->email}}</div>
                    <div><strong>Via:</strong> {{ $user->address}}</div>
                    <div><strong>Città:</strong> {{ $user->city}}</div>
                    <div><strong>CAP:</strong> {{ $user->postal_code}}</div>
                    <div><strong>Servizi:</strong> {{ $user->service}}</div>
                    <div><strong>CV:</strong> {{ $user->cv}}</div>

                    <div class="d-flex justify-content-end">
                        <form data-action="{{ route('doctor.profile.destroy', ['profile' => $user]) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-secondary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
