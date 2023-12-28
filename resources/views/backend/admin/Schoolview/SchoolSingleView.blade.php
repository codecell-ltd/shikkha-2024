@extends('layouts.master')

@section('content')
    <style>
        .dropbtn {
            background-color: blue;
            color: white;
            padding: 8px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 12px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            color: #fff;
            background-color: rgb(8, 8, 224);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: blue;
        }
    </style>
    <!--start content-->
    <main class="page-content">
        <div class="row mt-3 mb-5">
            <div class="col">
                <div class="card">
                    <div style="background-color:#000000; color:white;" class="card-header">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="{{ asset($school->school_logo) }}" width="120" height="120" name="school_logo"
                                    class="rounded-circle shadow-8-strong"
                                    style="margin-left:50px; margin-top:10px; margin-bottom:8px;" alt="">
                            </div>
                            <div class="col-lg-10">
                                <center>
                                    <h3 style="margin-top:10px;font-size:40px">{{ $school->school_name }}</h3>
                                </center>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" style="margin-top:20px ; padding-bottom:30px">
                        <div class="row">
                            @if (!isset($SchoolEdit))
                                <div class="col-6">
                                    <table class="table table-striped table-bordered  ">
                                        <tbody>
                                            <tr>
                                                <th>school name</th>
                                                <td>{{ $school->school_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ein Number</th>
                                                <td>{{ $school->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email Address</th>
                                                <td>{{ $school->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number</th>
                                                <td>{{ $school->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Bill </th>
                                                <td>{{ $school->billing_add }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Number of Student</th>
                                                <td>{{ CountUser($school->id) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Teacher</th>
                                                <td>{{ CountTeacher($school->id) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Staff</th>
                                                <td>{{ CountStuff($school->id) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-striped table-bordered  ">
                                        <tbody>
                                            <tr>
                                                <th>School Slogan</th>
                                                <td>{{ $school->slogan }}</td>
                                            </tr>
                                            <th>School Slogan In Bangla</th>
                                            <td>{{ $school->slogan_bn ? $school->slogan_bn : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td>{{ $school->state }}</td>
                                            </tr>
                                            <tr>
                                                <th>city</th>
                                                <td>{{ $school->city }}</td>
                                            </tr>
                                            <tr>
                                                <th>Postcode</th>
                                                <td>{{ $school->postcode }}</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>Bangladesh</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $school->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-right">
                                        <a href="{{ route('School.edit', $school->id) }}" class="btn btn-primary ">Edit</a>
                                    </div>


                                </div>
                            @else
                                <div class="col-lg-12">
                                    <table class="table table-striped table-bordered  ">
                                        <tbody>
                                            <form class="form-group-lg"
                                                action="{{ route('School.update', $SchoolEdit->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <tr>
                                                    <th>school name</th>
                                                    <td>
                                                        <input value="{{ $SchoolEdit->school_name }}" name="school_name"
                                                            style="border:none;background:none;" class="form-control w-75"
                                                            type="text" placeholder="Please Input School Name">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>school name Bn</th>
                                                    <td>
                                                        <input
                                                            value="{{ $SchoolEdit->school_name_bn ? $school->school_name_bn : '' }}"
                                                            name="school_name_bn" style="border:none;background:none;"
                                                            class="form-control w-75" type="text"
                                                            placeholder="Please Input School Name Bangla">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Email Address</th>
                                                    <td><input name="email" name="school_name"
                                                            value="{{ $SchoolEdit->email }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input Email Address"></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td><input name="phone_number" value="{{ $SchoolEdit->phone_number }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input phone number"></td>
                                                </tr>
                                                <tr>
                                                    <th>Billing</th>
                                                    <td><input name="billing_add" value="{{ $SchoolEdit->billing_add }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="number" placeholder=""></td>
                                                </tr>
                                                <tr>
                                                    <th>Number of Student</th>
                                                    <td>{{ CountUser($SchoolEdit->id) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Teacher</th>
                                                    <td>{{ CountTeacher($SchoolEdit->id) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Staff</th>
                                                    <td>{{ CountStuff($SchoolEdit->id) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>School Logo</th>
                                                    <td>
                                                        <input type="file" name="school_logo" class="form-control">
                                                        <p style="font-size: 12px">image size 640px (width & height)</p>
                                                        @error('school_logo')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td><input name="state" value="{{ $SchoolEdit->state }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input State"></td>
                                                </tr>
                                                <tr>
                                                    <th>city</th>
                                                    <td><input name="city" value="{{ $SchoolEdit->city }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input City">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Postcode</th>
                                                    <td><input name="postcode" value="{{ $SchoolEdit->postcode }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input postcode"></td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>Bangladesh</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td><input name="address" value="{{ $SchoolEdit->address }}"
                                                            style="border:none;background:none;" class="form-control w-75 "
                                                            type="text" placeholder="Please Input Address"></td>
                                                </tr>
                                                <tr>
                                                    <th>Slogan</th>
                                                    <td> <input name="slogan" value="{{ $SchoolEdit->slogan }}"
                                                            style="border:none;background:none;" class="form-control w-100 "
                                                            type="text" placeholder="Please Input Slogan"></td>
                                                </tr>
                                                <tr>
                                                    <th>Slogan Bangla</th>
                                                    <td> <input name="slogan_bn" value="{{ $SchoolEdit->slogan_bn }}"
                                                            style="border:none;background:none;"
                                                            class="form-control w-100 " type="text"
                                                            placeholder="Please Input Slogan"></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-7">
            </div>
            <div class="col-5">
                <div class="dropdown" style="float:right;">
                    <button class="dropbtn"><a href="{{ route('School.SingleView', $school->id) }}"
                            style="color:#fff">Today</a></button>
                    <div class="dropdown-content">
                        <a href="{{ route('school.Chart.Yesterday', $school->id) }}">Yesterday</a>
                        <a href="{{ route('school.Chart.Lastweek', $school->id) }}">Lastweek</a>
                        <a href="{{ route('school.Chart.Lastmonth', $school->id) }}">LastMonth</a>
                        <a href="{{ route('school.Chart.Sixmonth', $school->id) }}">Last 6 Month</a>
                        <a href="{{ route('school.Chart.ThisYear', $school->id) }}">This Year</a>
                        <a href="{{ route('school.Chart.Total', $school->id) }}">Total</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <h1 class="text-center">School Activity</h1>
            <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
        </div>
        @if (isset($logs))
            <div class="row p-4 mb-5">
                <div class="card">
                    <h1 class="text-center">Today School Activity Details</h1>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Subject</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>Count</th>
                            <th>Date</th>
                        </tr>

                        @foreach ($logs as $key => $log)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $log->subject }}</td>
                                {{-- <td class="text-success">{{ $log->url }}</td> --}}
                                <td class="text-success">{{ Str::limit($log->url, 70) }}</td>
                                <td><label class="label label-info">{{ $log->method }}</label></td>
                                <td class="text-warning">{{ $log->ip }}</td>
                                <td class="text-danger">{{ $log->agent }}</td>
                                <td>{{ $log->count }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        @endif


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
    <!-- Modal -->
    {{-- <div class="modal fade" id="loginPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Student login </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form action="{{route('school.Password',$school->id)}}" method="post">
  @method('PUT')
  @csrf
    <div class="mb-3">
      <label for="password" class="col-form-label">New Password</label>
      <input type="text" name="password" class="form-control" id="password">
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
  <button type="submit" class="btn btn-success">Save</button>
</div>
</form>
</div>
</div>
</div> --}}
@endsection
