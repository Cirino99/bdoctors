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
                        <h2>Il login è avvenuto con successo, benvenuto!</h2>

                        <div>
                            <canvas id="myChart"></canvas>
                        </div>

                        <script>
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

                            const data = {
                                labels: labels,
                                datasets: [{
                                    label: 'Statistiche messaggi per mese',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: [1,2,3,4],
                                }]
                            };

                            const config = {
                                type: 'line',
                                data: data,
                                options: {}
                            };

                            const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                            );
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
