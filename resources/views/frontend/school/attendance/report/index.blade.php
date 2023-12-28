@extends('layouts.school.master')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush

@section('page_title', __('app.attendance_report'))

@section('content')
<main class="page-content">
    {{-- <center> --}}
        <h3 class="text-primary">@yield('page_title')</h3>
        @isset($teacher)
            <h5 class="m-0"> {{$teacher->full_name}} (<small>{{$teacher->designation}}</small>) </h5>
        @endisset
        @isset($user)
            <h5 class="m-0"> {{$user->name}}</h5>
        @endisset
        @isset($staff)
            <h5 class="m-0"> {{$staff->employee_name}} <br><small>{{$staff->position}}</small></h5>
        @endisset
    {{-- </center> --}}

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md mb-3">
                                <label class="form-label">From</label>
                                <input type="text" class="form-control datepicker" name="from" required value="{{Request::input('from')}}"/>
                            </div>
                            <div class="col-md mb-3">
                                <label class="form-label">To</label>
                                <input type="text" class="form-control datepicker" name="to" required value="{{Request::input('to')}}"/>
                            </div>

                            <div class="col-md">
                                <button class="btn btn-primary"> <i class="bi bi-list-check"></i> Report Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(isset($attendances) && count($attendances))
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    @if(Request::has('from') && Request::has('to'))
                    {{-- <h5> Report of {{$days_in_different}} days </h5> --}}
                    @else
                    <h5>{{ __('app.report_of_last_30_days') }}</h5>
                    @endif
                    <button class="btn-primary btn-sm" title="Print" onclick="printDiv()"><i class="bi bi-printer"> Print</i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="print-area">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Entry Time</th>
                                        <th>Exit Time</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $item)
                                        <tr>
                                            <td> {{date("M d, Y", strtotime($item->created_at))}} </td>
                                            <td>
                                                {{-- @dd($userType) --}}
                                                @if ($userType == 'teacher')
                                                    @if(($teacher->entry_time < $item->access_time) && ($teacher->entry_time != Null) )                                                
                                                        <span style="color: red">{{ date('h:i:s A', strtotime($item->access_time)) }} (Late)</span>    
                                                    @elseif($item->entry_time != Null)
                                                        {{ date('h:i:s A', strtotime($item->access_time)) }}
                                                    @else
                                                        {{$item->access_time}} 
                                                    @endif

                                                @elseif ($userType == 'staff')
                                                    @if(($staff->entry_time < $item->access_time) && ($staff->entry_time != Null) )                                                
                                                        <span style="color: red">{{ date('h:i:s A', strtotime($item->access_time)) }}(Late)</span>    
                                                    @elseif($item->entry_time != Null)
                                                        {{ date('h:i:s A', strtotime($item->access_time)) }}
                                                    @else 
                                                        {{$item->access_time}} 
                                                    @endif
                                                    
                                                @elseif ($userType == 'user')
                                                    
                                                @endif
                                                
                                            </td>
                                            <td>
                                                @if ($userType == 'teacher')
                                                    @if(($teacher->exit_time > $item->exit_time) && ($teacher->exit_time != Null) && ($item->exit_time != Null))
                                                        <span style="color: red">{{ date('h:i:s A', strtotime($item->exit_time)) }} (Early)</span> 
                                                    @elseif($item->exit_time != Null) 
                                                        {{ date('h:i:s A', strtotime($item->exit_time)) }}
                                                    @else
                                                        {{$item->exit_time}}
                                                    @endif

                                                @elseif ($userType == 'staff')
                                                    @if(($staff->exit_time > $item->exit_time) && ($staff->exit_time != Null) && ($item->exit_time != Null))
                                                        <span style="color: red">{{ date('h:i:s A', strtotime($item->exit_time)) }} (Early)</span> 
                                                    @elseif($item->exit_time != Null) 
                                                        {{ date('h:i:s A', strtotime($item->exit_time)) }}
                                                    @else
                                                    {{$item->exit_time}}
                                                    @endif

                                                @elseif ($userType == 'user')
                                                    
                                                @endif
                                                
                                                </td>
                                            <td> 
                                                @if($item->attendance)    
                                                <span class="badge bg-success">PRESENT</span>
                                                @else
                                                <span class="badge bg-danger">ABSENT</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</main>


@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{asset('js/printThis.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
            });
        })

        function printDiv() {
            toastr.success("Generating ...");

            $("#print-area").printThis({
                header: `<div class="d-flex justify-content-center">
                            @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                            @endif                                                                                                                                                                 
                            <div class="text-center text-dark">
                                <h4 style="margin-bottom:0px;"> {{ strtoupper( authUser()->school_name) }} </h4>
                                <p style="margin-bottom:0px;"> {{ (authUser()->slogan )}} </p> 
                                <p style="margin-bottom:0px;"> {{ (authUser()->address )}} </p> 
                                <p style="font-size: 20px;"><b>@yield('page_title')</b></p>
                                @if(isset($teacher))
                                <p>{{$teacher->full_name}} ({{$teacher->designation}})</p>
                                @elseif(isset($user))
                                <p>{{$user->name}}</p>
                                @endif
                            </div>   
                        </div>`,
                footer: `<div class="d-flex justify-content-between">
                            <small class="m-0">This is auto generated copy.</small>
                            <small class="m-0">Powered by {{env('APP_NAME')}}</small>
                        </div>`
            });
        }
    </script>
@endpush