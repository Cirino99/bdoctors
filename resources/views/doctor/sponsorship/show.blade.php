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
                    <div id="sponsorship"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.user = @json(Auth::user()->id);
    window.sponsorship = @json($sponsorship->id);
</script> 
<script src="{{ asset('js/payment.js') }}"></script>
@endsection