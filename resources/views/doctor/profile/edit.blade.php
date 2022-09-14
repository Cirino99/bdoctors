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

                    <h1>Edit</h1>
                    <form action="{{ route('doctor.profile.update', ['profile' => $user]) }}" method="post" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('put')
                
                        <div class="mb-3">
                            <label class="form-label" for="name">Nome</label>
                            <input class="form-control @error('name') is-invalid @enderror"
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $user->name) }}"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="lastname">Cognome</label>
                            <input class="form-control @error('lastname') is-invalid @enderror"
                                type="text"
                                name="lastname"
                                id="lastname"
                                value="{{ old('lastname', $user->lastname) }}"
                            >
                            @error('lastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror"
                                type="text"
                                name="email"
                                id="email"
                                value="{{ old('email', $user->email) }}"
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label" for="photo">Photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror"
                                type="file"
                                name="photo"
                                id="photo"
                                accept="image/*"
                                value="{{ old('photo', $user->photo) }}"                            
                            >
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <img id="preview" class="img-fluid rounded-circle" src="{{ asset('storage/' . $user->photo) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="phone">Numero di telefono</label>
                            <input class="form-control @error('phone') is-invalid @enderror"
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone', $user->phone) }}"                            
                            > 
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="service">Prestazione</label>
                            <input class="form-control @error('service') is-invalid @enderror"
                                type="text"
                                name="service"
                                id="service"
                                value="{{ old('service', $user->service) }}"                            
                            >
                            @error('service')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="address">Via</label>
                            <input class="form-control @error('address') is-invalid @enderror"
                                type="text"
                                name="address"
                                id="address"
                                value="{{ old('address', $user->address) }}"
                            >
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="city">Città</label>
                            <input class="form-control @error('city') is-invalid @enderror"
                                type="text"
                                name="city"
                                id="city"
                                value="{{ old('city', $user->city) }}"
                            >
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="postal_code">Codice Postale</label>
                            <input class="form-control @error('postal_code') is-invalid @enderror"
                                type="text"
                                name="postal_code"
                                id="postal_code"
                                value="{{ old('postal_code', $user->postal_code) }}"
                            >
                            @error('postal_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label" for="cv">CV</label>
                            <textarea class="form-control @error('cv') is-invalid @enderror" name="cv" id="cv">{{ old('cv', $user->cv) }}</textarea>
                            @error('cv')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> 

                        <fieldset class="mb-3">
                            <legend>Specializzazioni</legend>
                            @foreach ($specializations as $specialization)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="specializations[]"
                                        value="{{ $specialization->id }}"
                                        id="specialization-{{ $specialization->id }}"
                                        @if(in_array($specialization->id, old('specializations', $user->specializations->pluck('id')->all()) ?: [])) checked @endif
                                    >
                                    <label class="form-check-label" for="specialization-{{ $specialization->id }}">{{ $specialization->name }}</label>
                                </div>
                            @endforeach
                
                            @foreach ($errors->get('specializations.*') as $messages)
                                @foreach ($messages as $message)
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endforeach
                        </fieldset>
                
                       <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection