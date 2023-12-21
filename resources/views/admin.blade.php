@extends('layouts.master')

@section('content')
    <main class="page-content">

        <div class="container ">
            <div class="row mt-5">
                <div class="col-4">
                    <div class="card radius-10 bg-info mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-mortarboard-fill"></i></div>
                                </div>
                                <div class="col-7">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $schools }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total School</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card radius-10 bg-warning mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-person-circle"></i></div>
                                </div>
                                <div class="col-7">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $teachers }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total Teacher </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card radius-10 bg-danger mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-people"></i></div>
                                </div>
                                <div class="col-7">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $students }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total Student </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <div class="card radius-10 bg-success mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-person-badge"></i></div>
                                </div>
                                <div class="col-7">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $stuff }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total Stuff</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card radius-10 bg-primary mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-envelope-check"></i></div>
                                </div>
                                <div class="col-7 ">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $messages }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total SMS </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card radius-10 bg-secondary mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-currency-dollar"></i></div>
                                </div>
                                <div class="col-7 ">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $payment }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total Payment </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-4">
                    <div class="card radius-10 bg-danger mb-0">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white" style="font-size:50px"><i
                                            class="bi bi-cash-coin"></i></div>
                                </div>
                                <div class="col-7">
                                    <h3 class="text-white text-center" style="font-size:25px">{{ $school_fees }}</h3>
                                    <p class="mb-0 text-white text-center" style="font-size:15px">Total School Fees</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4"></div>
            </div>
            <div class="mb-5">
                <h1 class="text-center">All School Activity</h1>
                <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>



    <script>
        var xValues = @json($xValues);
        var yValues = @json($yValues);
        var barColors = @json($colors);

        new Chart("myChart", {
            type: "horizontalBar",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'traffic',
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                }
            }
        });
    </script>
@endsection
