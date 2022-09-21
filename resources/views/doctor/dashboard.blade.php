@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-12 col-sm-12 col-md-10">
            <div class="card border-primary">
                <div class="card-header bg-primary bg-opacity-50 border-bottom border-primary"><b>{{ __('Dashboard') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Il login è avvenuto con successo, benvenuto!</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
