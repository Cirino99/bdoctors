@extends('doctor.layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container">
        <div class="row justify-content-center text-center vh-100">
            <div class="col-12 col-sm-12 col-md-10 col-lg-7">
                <div class="card border-primary">
                    <div class="card-header bg-primary bg-opacity-50 border-bottom border-primary">
                        <b>{{ __('Dashboard') }}</b>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>Statistiche account</h2>

                        <div>
                            <canvas id="chartMessages"></canvas>
                            <canvas id="chartReviews"></canvas>
                        </div>

                        <script>
                            const messages = @json($messages);
                            const reviews = @json($reviews);
                            const numberMessages = Object.values(messages);
                            const numberReviews = Object.values(reviews);

                            const labels = [
                                'Gennaio',
                                'Febbraio',
                                'Marzo',
                                'Aprile',
                                'Maggio',
                                'Giugno',
                                'Luglio',
                                'Agosto',
                                'Settembre',
                                'Ottobre',
                                'Novembre',
                                'Dicembre'
                            ];

                            const dataMessages = {
                                labels: labels,
                                datasets: [{
                                    label: 'Statistiche messaggi per mese',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: numberMessages,
                                }]
                            };

                            const dataReviews = {
                                labels: labels,
                                datasets: [{
                                    label: 'Statistiche recensioni per mese',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: numberReviews,
                                }]
                            };

                            const configMessages = {
                                type: 'bar',
                                data: dataMessages,
                                options: {}
                            };

                            const configReviews = {
                                type: 'bar',
                                data: dataReviews,
                                options: {}
                            };

                            const chartMessages = new Chart(
                                document.getElementById('chartMessages'),
                                configMessages
                            );

                            const chartReviews = new Chart(
                                document.getElementById('chartReviews'),
                                configReviews
                            );
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
