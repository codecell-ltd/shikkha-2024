@extends('layouts.school.master')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/color-calendar/dist/css/theme-basic.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/color-calendar/dist/css/theme-glass.css" />
@endpush

@section('content')
    <style>
        .btn1:hover {
            background-color: blueviolet;
            color: white !important;
        }
    </style>
    <!--start content-->
    <main class="page-content" id="updated-content">
       
        
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-lg-3 mb-3 ">
                        <a href="{{ route('student.attendance.show') }}">
                            <div class="card mb-0" style="background-image: linear-gradient(0deg, #fff4e1 0%, #D4145A 100%); border-radius: 20px">
                                <div class="card-body text-center">
                                    <div class="d-flex gap-2 align-items-center text-center mb-3">
                                        <img src="{{asset("assets/icons/1.svg")}}" alt="attendance" class="img-fluid"/>
                                        <h2 class="text-white m-0">{{ DailyAttendence() }}</h2>
                                    </div>
                                    <h6 class="text-dark fw-bolder">{{ __("app.Attendance") }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 mb-3 ">
                        <a href="{{ route('student.teacher.create.show') }}">
                            <div class="card mb-0" style="background-image: linear-gradient(0deg, #fff4e1 0%, #009245 100%); border-radius: 20px">
                                <div class="card-body text-center">
                                    <div class="d-flex gap-2 align-items-center mb-3">
                                        <img src="{{asset("assets/icons/2.svg")}}" alt="users" class="img-fluid"/>
                                        <h2 class="text-white m-0">{{ CountUser() }}</h2>
                                    </div>
                                    <h6 class="text-dark fw-bolder">{{ __('app.Student') }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 mb-3 ">
                        <a href="{{ route('teacher.Show') }}">
                            <div class="card mb-0" style="background-image: linear-gradient(0deg, #fff4e1 0%, #614385 100%); border-radius: 20px">
                                <div class="card-body text-center">
                                    <div class="d-flex gap-2 align-items-center mb-3">
                                        <img src="{{asset("assets/icons/3.svg")}}" alt="teachers" class="img-fluid"/>
                                        <h2 class="text-white m-0">{{ CountTeacher() }}</h2>
                                    </div>
                                    <h6 class="text-dark fw-bolder">{{ __('app.teacher') }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 mb-3 ">
                        <a href="{{ route('send.sms.student') }}">
                            <div class="card mb-0" style="background-image: linear-gradient(0deg, #fff4e1 0%, #EA8D8D 100%); border-radius: 20px">
                                <div class="card-body text-center">
                                    <div class="d-flex gap-2 align-items-center mb-3">
                                        <img src="{{asset("assets/icons/4.svg")}}" alt="sms" class="img-fluid"/>
                                        <h2 class="text-white m-0">{{getMessageCount(authUser()->id)}}</h2>
                                    </div>
                                    <h6 class="text-dark fw-bolder">{{__("app.SMS")}}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-lg-2 g-3 align-items-center">
                                    <div class="col">
                                        <h5 class="mb-0" style="color:blueviolet">{{ __('app.Status2') }}</h5>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex align-items-center justify-content-sm-end gap-3 cursor-pointer">
                                            <div class="font-13" style="color: blueviolet"><i
                                                    class="bi bi-circle-fill text-info"
                                                    style="color:blueviolet !important"></i><span
                                                    class="ms-2">{{ __('app.Status3') }}</span></div>
                                            <div class="font-13"><i class="bi bi-circle-fill"
                                                    style="color:rgb(250, 154, 65)"></i><span
                                                    class="ms-2">{{ __('app.Status4') }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart5"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    {{--Calendar Start --}}
                    <div class="col-md-6 mb-3">
                        <div class="calander-container"></div>
                    </div>
                    {{--Calendar End --}}

                    {{-- Attendance Card Start --}}
                    <div class="col-md-6 mb-3">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <h5>{{ __("app.Attendance") }}</h5>
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                    {{-- Attendance card End --}}

                    {{-- <div class="col-md-12">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <h4>List of Outstanding</h4>

                                <table class="table w-100">
                                    <tbody>
                                        @for ($i = 0; $i < 10; $i++)
                                            <tr>
                                                <td>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <img src="{{asset("d/shikkha.jpg")}}" alt="user" class="img-fluid rounded-circle" style="height: 30px; width: 30px">
                                                        <p class="m-0">Shahidul Islam</p>
                                                    </div>
                                                </td>
                                                <td>ID 98765436</td>
                                                <td>Class</td>
                                                <td>20398 ৳</td>
                                                <td>
                                                    <i class="bi bi-printer"></i>
                                                    <i class="bi bi-three-dots"></i>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <!--end row-->

                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <h5 class="mb-0" style="color:blueviolet">{{ __('app.Status1') }}</h5>
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="col-lg p-0">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="card-title fw-bolder">{{__("app.Notice")}}</h6>

                        <ul class="list-unstyled">

                            @forelse ($notices as $notice)
                            <li class="border-bottom py-2 cursor-pointer">
                                <p class="m-0">
                                {{ \Illuminate\Support\Str::limit($notice->topic, 50, '...') }}

                                (<small class="m-0">{{date("d-m-Y", strtotime($notice->created_at))}}</small>)</p>
                            </li>
                            @empty
                            <li class="border-bottom py-4 cursor-pointer">
                                <div class="text-center text-muted">
                                    <i class="bi bi-folder2-open" style="font-size: 46px"></i>
                                    <p class="m-0">No record found</p>
                                </div>
                            </li>
                            @endforelse
                        </ul>

                        @if (count($notices))
                        <a href="{{route('notice.school.admin.create.show')}}" class="btn btn-primary w-100 mt-3" style="border-radius: 20px">{{__("app.more")}} <i class="bi bi-arrow-right"></i> </a>                            
                        @endif
                    </div>


                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <h6 class="m-0 card-title fw-bolder">{{__("app.Student")}}</h6>
                                <small>{{__("app.you_have_total_student")}}</small>
                            </div>
                            <a href="{{route("student.create")}}"> <i class="bi bi-plus-circle-fill text-dark" style="font-size: 30px"></i> </a>
                        </div>

                        <ul class="list-unstyled">

                            @forelse ($students as $student)
                            <li class="border-bottom py-2">
                                <div class="d-flex gap-2">
                                    {{-- <div class="rounded-circle bg-secondary p-4"></div> --}}
                                    <img src="{{asset($student->image)}}" alt="image" width="50" class="img-thumbnail rounded img-fluid">
                                    <div>
                                        <p class="m-0 fw-bolder">{{$student->name}}</p>
                                        <p class="m-0">{{$student->class?->class_name}}, {{$student->section?->section_name}}</p>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="border-bottom py-4 cursor-pointer">
                                <div class="text-center text-muted">
                                    <i class="bi bi-folder2-open" style="font-size: 46px"></i>
                                    <p class="m-0">No record found</p>
                                </div>
                            </li>
                            @endforelse
                        </ul>

                        @if (count($students))
                        <a href="{{route("student.teacher.create.show")}}" class="btn btn-primary w-100 mt-3" style="border-radius: 20px">{{__("app.more")}} <i class="bi bi-arrow-right"></i> </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </main>
    <!--end page main-->

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('app.SendSms') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('send.fees.due.sms') }}">
                    @csrf
                    <div class="modal-body">
                        {{ __('app.sure') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('app.no') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('app.yes') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/color-calendar/dist/bundle.min.js"></script>

    <script>
        new Calendar({
            id: '.calander-container',
            // eventsData: myEvents, // myEvents is array
            theme: 'glass',
            primaryColor: '#8a2be2',
            headerColor: '#fff',
            headerBackgroundColor: '#8a2be2',
            startWeekday: 6,
        })

        // const myEvents = [
        //     {
        //         start: '2021-04-15T06:00:00',
        //         end: '2021-04-15T20:30:00',
        //         name: 'Event 1',
        //         url: 'https://www.cssscript.com',
        //         desc: 'Description 1',
        //         // more key value pairs here
        //     },{
        //         start: '2021-04-16T06:00:00',
        //         end: '2021-04-16T20:30:00',
        //         name: 'Event 2',
        //         url: 'https://www.cssscript.com',
        //     },{
        //         start: '2021-04-16T06:00:00',
        //         end: '2021-04-17T20:30:00',
        //         name: 'Event 3',
        //         url: 'https://www.cssscript.com',
        //     },
        // ],
    </script>

    <script>
        $(function() {
            "use strict";
            var datas = <?php echo json_encode($datas); ?>
            //

            // chart 1
            var options = {
                series: [{
                    name: '{{__("app.Attendance")}}',
                    data: {!! $attendanceChart !!}
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
                    categories: [
                        "Sat",
                        "Sun",
                        "Mon",
                        "Tue",
                        "Wed",
                        "Thu",
                        "Fri",
                    ]
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function(val) {
                            return "" + val + ""
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);
            chart.render();


            // chart 2
            var totalStudent = <?php echo json_encode($totalStudent); ?>

            var options = {
                series: [{
                    name: "Users",
                    data: [totalStudent, 12, 160]
                }],
                chart: {
                    foreColor: '#9a9797',
                    type: "bar",
                    //width: 130,
                    height: 170,
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
                        color: "#8a2be2"
                    },
                    sparkline: {
                        enabled: !1
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#8a2be2"],
                    strokeColors: "#8a2be2",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: 1,
                        columnWidth: "20%",
                        columnHeight: "20%",
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
                colors: ["#8a2be2"],
                xaxis: {
                    categories: ["Student", "Teacher", "Author"]
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function(val) {
                            return "" + val + ""
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();



            // chart 3

            var options = {
                series: [89, 45, 35, 62],
                chart: {
                    width: 340,
                    type: 'donut',
                },
                labels: ["Visitors", "Subscribers", "Contributor", "Author"],
                colors: ["#3361ff", "#e72e2e", "#12bf24", "#ff6632"],
                legend: {
                    show: false,
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: -20
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 260
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart3"), options);
            chart.render();




            // chart 4

            var options = {
                series: [68],
                chart: {
                    foreColor: '#9ba7b2',
                    height: 280,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        //startAngle: -130,
                        //endAngle: 130,
                        hollow: {
                            margin: 0,
                            size: '82%',
                            //background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: false,
                                top: 3,
                                left: 0,
                                blur: 4,
                                color: 'rgba(0, 169, 255, 0.15)',
                                opacity: 0.65
                            }
                        },
                        track: {
                            background: '#dfecff',
                            //strokeWidth: '67%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: false,
                                top: -3,
                                left: 0,
                                blur: 4,
                                color: 'rgba(0, 169, 255, 0.85)',
                                opacity: 0.65
                            }
                        },
                        dataLabels: {
                            showOn: 'always',
                            name: {
                                offsetY: -25,
                                show: true,
                                color: '#6c757d',
                                fontSize: '16px'
                            },
                            value: {
                                formatter: function(val) {
                                    return val + "%";
                                },
                                color: '#000',
                                fontSize: '45px',
                                show: true,
                                offsetY: 10,
                            }
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'horizontal',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#3361ff'],
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                colors: ["#3361ff"],
                labels: ['mc'],
            };

            var chart = new ApexCharts(document.querySelector("#chart4"), options);
            chart.render();



            // chart 5
            var incomeDatas = <?php echo json_encode($incomeDatas, JSON_NUMERIC_CHECK); ?>;
            var exDatas = <?php echo json_encode($exDatas, JSON_NUMERIC_CHECK); ?>

            var optionsLine = {
                chart: {
                    foreColor: '#9ba7b2',
                    height: 275,
                    type: 'line',
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 2,
                        blur: 4,
                        opacity: 0.1,
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ["#8a2be2", '#ff6632'],
                series: [{
                    name: "Income",
                    data: incomeDatas
                }, {
                    name: "Expense",
                    data: exDatas
                }],
                markers: {
                    size: 4,
                    strokeWidth: 0,
                    hover: {
                        size: 7
                    }
                },
                grid: {
                    show: true,
                    padding: {
                        bottom: 0
                    }
                },
                //labels: ['01/15/2002', '01/16/2002', '01/17/2002', '01/18/2002', '01/19/2002', '01/20/2002'],
                xaxis: {
                    //type: 'datetime',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -20
                }
            }
            var chartLine = new ApexCharts(document.querySelector('#chart5'), optionsLine);
            chartLine.render();






        });
    </script>
@endpush
