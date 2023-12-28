@extends('layouts.master')

@section('content')
    <!--start content-->
    <main class="page-content">

        <div class="row mb-5 ">
            <div class="col">
                <div class="card">
                    <div style="background-color:#233545; color:white;" class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <center><h3 style="margin-top:10px;font-size:50px">{{$school->school_name}}</h3></center>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                
                <div class="col-md-8">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <h5 class="mb-0" style="color:blueviolet">{{__('app.Status1')}}</h5>
                            <div id="chart1">
                            </div>
                        </div>
                    </div>
                </div>
                               
            </div>
        </div>
    </main>
@endsection



@push('js')
    <script>
        $(function() {
            "use strict";
            var datas  = <?php echo json_encode($datas);?>
          
        // chart 1
            var options = {
                series: [{
                    name: "Users",
                    data: datas
                }],
                chart: {
                    foreColor: '#9a9797',
                    type: "bar",
                    //width: 130,
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: 0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#3461ff"
                    },
                    sparkline: {
                        enabled: !1
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#7a00a7", "#7a00a7"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "40%",
                        endingShape: "rounded"
                    }
                },
                legend: {
                    show: false,
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: -20
                },
                dataLabels: {
                    enabled: !1
                },
                grid: {
                    show: false,
                    // borderColor: '#eee',
                    // strokeDashArray: 4,
                },
                stroke: {
                    show: !0,
                    // width: 3,
                    curve: "smooth"
                },
                colors: ["#7a00a7"],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return "" + val + ""
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);
            chart.render();

        });
    </script>
@endpush