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
                                value="{{ old('lastname', $user->lastname) }}"                            >
                            @error('lastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror"
                                type="text"
                                name="email"
                                id="email"
                                value="{{ old('email', $user->email) }}"                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                
                        <div class="mb-3">
                            <label class="form-label" for="photo">Photo</label>
                            <input class="form-control @error('photo') is-invalid @enderror"
                                type="text"
                                name="photo"
                                id="photo"
                                {{-- value="{{ old('name', $user->name) }}"                             --}}
                                >
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="phone">Numero di telefono</label>
                            <input class="form-control @error('phone') is-invalid @enderror"
                                type="text"
                                name="phone"
                                id="phone"
                                 {{-- value="{{ old('name', $user->name) }}"                             --}}
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
                                {{-- value="{{ old('name', $user->name) }}"                             --}}
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
                                value="{{ old('address', $user->address) }}"                            >
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
                                value="{{ old('city', $user->city) }}"                            >
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
                                value="{{ old('postal_code', $user->postal_code) }}"                            >
                            @error('postal_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                
                        {{-- <div class="mb-3">
                            <label class="form-label" for="excerpt">Excerpt</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                
                       <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection