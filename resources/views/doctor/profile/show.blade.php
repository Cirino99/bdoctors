@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Il tuo Profilo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($user->photo != null)
                        <img id="preview" class="img-fluid rounded-circle my-4" src="{{ asset('storage/' . $user->photo) }}">
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
                        <button class="btn btn-sm btn-secondary mt-4" id="delete-js">Delete</button>
                    </div>
                </div>
            </div>
            <div class="my-delete d-none">
                <form data-action="{{ route('doctor.profile.destroy', ['profile' => $user]) }}" method="post" class="popup">
                    @csrf
                    @method('DELETE')

                    <label for="password" class="col-form-label text-md-right">Inserisci la tua password per eliminare il tuo profilo</label>
                    <input id="password" type="password" class="form-control mb-3" name="password" required autocomplete="current-password">
                    <button type="submit" class="btn btn-danger">
                        Si
                    </button>
                    <button id="cancel-btn" type="button" class="btn btn-warning">
                        Annulla
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
