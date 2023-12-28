@extends('layouts.school.master')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@endpush
@section('content')



<main class="page-content">

    @if(count($dataAttendance))
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="box-shadow:4px 3px 13px  .7px #deaaf7;border-radius:5px">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">{{__('app.Teacher')}} {{__('app.Attendance')}}</h5>
                        <div class="ms-auto">
                            <button type="button" class="btn-secondary btn-sm" title="{{__('app.Back')}}" onclick="history.back()"><i class="bi bi-arrow-left-square"> Back</i></button>
                            <button class="btn-sm btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()" ><i class="bi bi-printer"> Print</i></button>
                            
                        </div>
                    </div>
                </div>
                <div class="card-body" id="attendance_body">

                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{__('app.Teacher')}} {{__('app.Name')}}</th>
                                    <th>{{__('app.UniqueId')}}</th>
                                    <th>{{__('app.entry_time')}} </th>
                                    <th>{{__('app.exit_time')}} </th>
                                    <th>{{__('app.Attendance')}}</th>
                                    {{-- <th>{{__('app.Comment')}}</th> --}}
                                    @if (hasPermission("teacher_attendance_take_edit"))                                    
                                        <th id="action_table_th">{{__('app.Action')}}</th>
                                    @endif
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($dataAttendance as $key => $data)
                                <tr>
                                    <td>{{\App\Models\Teacher::find($data->teacher_id)?->full_name}}</td>
                                    <td>{{\App\Models\Teacher::find($data->teacher_id)?->unique_id}}</td>
                                    <td>
                                        @if((\App\Models\Teacher::find($data->teacher_id)?->entry_time < $data->access_time) && ($data->access_time != Null))
                                            <span style="color: red">{{ (is_null($data->access_time)) ? '' : date("g:i:s A", strtotime($data->access_time)) }} (Late)</span>
                                        @else 
                                            {{ (is_null($data->access_time)) ? '' : date("g:i:s A", strtotime($data->access_time))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if((\App\Models\Teacher::find($data->teacher_id)?->exit_time > $data->exit_time) && ($data->exit_time != Null))
                                            <span style="color: red">{{ (is_null($data->exit_time)) ? '' : date("g:i:s A", strtotime($data->exit_time)) }} (Early)</span>
                                        @else
                                            {{ (is_null($data->exit_time)) ? '' : date("g:i:s A", strtotime($data->exit_time)) }}
                                        @endif
                                    </td>
                                    <td>@if($data->attendance == 1 ) <span class="badge bg-primary">Present</span> @elseif($data->attendance == 2) <span class="badge bg-warning">Late</span> @else <span class="badge bg-danger">Absent</span> @endif</td>
                                    {{-- <td>{{ is_null($data->comment) ? 'No comment' : $data->comment}}</td> --}}
                                    @if (hasPermission("teacher_attendance_take_edit"))
                                        <td class="action_table_td">
                                            <form method="post" action="{{route('Teacher.confirmabsentpresent',$data->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @if($data->attendance == 1)
                                                    <input type="hidden" name="attendance" value="0">
                                                    <button type="submit" class="btn btn-primary btn-sm">Make It Absent</button>
                                                @else
                                                    <input type="hidden" name="attendance" value="1">
                                                    <button type="submit" class="btn btn-danger btn-sm">Make It Present</button>
                                                @endif
                                            </form>
                                        </td>
                                    @endif
                                    {{-- @if(!is_null(Request::segment(6)))
                                    <td>{{Request::segment(6)}}</td>
                                    @endif --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    
    <!--end row-->
    @else
    <form class="row g-3" method="post" action="{{route('TeacherAttendance.post')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="segment_date" value="{{ Request::segment(6) }}">
        @if(Request::segment(6) <= date("Y-m-d"))
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="box-shadow:4px 3px 13px  .7px #deaaf7;border-radius:5px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Teacher Name</th>
                                        <th>Teacher Id</th>
                                        <th>Action</th>
                                        <th>Remarks/Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataShow as $key => $data)
                                    @php
                                    $attendance = getTeacherAttendance($data->id, Request::segment(6));
                                    @endphp
                                    <tr>
                                        <td>{{$key++ +1}}</td>
                                        <td>{{$data->full_name}}</td>
                                        <td>{{$data->unique_id}}</td>
                                        <td>
                                        <input class="form-check-input" type="radio" id="gridCheck{{$data->id}}" {{ $attendance == 1 ? "checked" : " " }} name="attendance[{{$data->id}}][]" value="1">
                                            <label class="form-check-label" for="gridCheck{{$data->id}}">
                                                Present
                                            </label>
                                            <input class="form-check-input" type="radio" id="gridCheck{{$data->id}}" {{ $attendance == 0 ? "checked" : " " }} name="attendance[{{$data->id}}][]" value="0">
                                            <label class="form-check-label" for="gridCheck{{$data->id}}">
                                                Absent
                                            </label>

                                           

                                            <input class="form-check-input" type="radio" id="gridCheck{{$data->id}}" {{ $attendance == 2 ? "checked" : " " }} name="attendance[{{$data->id}}][]" value="2">
                                            <label class="form-check-label" for="gridCheck{{$data->id}}">
                                                late
                                            </label>

                                            <input type="hidden" name="teacher_id[]" value="{{$data->id}}">
                                        </td>
                                        <td><input class="form-control" name="comment[]" placeholder="Give a Comment"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </div>
        <!--end row-->
        @else
            <p>Upcoming date attendance you can not uploaded</p>
        @endif
    </form>
    @endif

    <div style="display: none"><div id="printable_content"></div></div>
</main>


@endsection


@push('js')
    <script src="{{asset('js/printThis.js')}}"></script>
    <script>
        function printDiv(printDiv) {
            toastr.success("Generating ...");

            $("#printable_content").html($("#attendance_body").html());

            $("#printable_content #action_table_th").remove();
            $("#printable_content .action_table_td").remove();
            
            $("#printable_content").printThis({
                header: `<div class="d-flex justify-content-center mb-3">
                        @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                        @endif                                                                                                                                                                 
                        <div class="text-center text-dark">
                            <h4 class="m-0"> {{ strtoupper( authUser()->school_name) }} </h4>
                            <p class="m-0"> {{ (authUser()->slogan )}} </p> 
                            <p class="m-0">Teacher Attendance</p>
                            <p class="m-0">Date: {{$formattedDate}}</p>                                       
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
