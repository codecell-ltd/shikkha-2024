@extends('layouts.school.master')
@section('content')
<style>
    .recycle1:hover {
        background-color: blueviolet;
        border-color: blueviolet !important;
        color: white !important;
    }

    .recyclebtn {
        border-color: blueviolet !important;
        color: blueviolet !important;
    }

    .recyclebtn:hover {
        background-color: blueviolet;
        border-color: blueviolet !important;
        color: white !important;
    }
</style>
<main class="page-content">
    <div class="row">
        @if ($User->Empty()|| $resultCountablemark->Empty()||$fee->Empty()|| $assignFess->Empty()||$staffSalary->Empty()->Empty()||$TeacherSalary->Empty()||$expense->Empty()||$studentMontyFee->Empty()||$syllabus->Empty()||$resultSetting->Empty()||$section->Empty()||$Teacher->Empty()||$Result->Empty()||$fund->Empty()|| $admission->Empty()||$period->Empty()||$subject->Empty()|| $staff->Empty()||$class->Empty()||$borrowlist->Empty()||$booklist->Empty()||$bookType->Empty()||$question->Empty())

            @if ($class->isNotEmpty())
                <div class="col-md-3 mb-3">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Class</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-person-circle" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#class">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            @if ($User->isNotEmpty())
                <div class="col-md-3 mb-3">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Student</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-person-circle" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#student">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if ($Teacher->isNotEmpty())
                <div class="col-md-3 mb-3">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Teacher</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-person-video3" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#teacher">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if ($staff->isNotEmpty())
                <div class="col-md-3 mb-2">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Staff</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-person-fill" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#staff">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if ($Result->isNotEmpty()||$resultSetting->isNotEmpty()||$resultCountablemark->isNotEmpty())
                <div class="col-md-3 mb-3">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Result</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-file" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#result1">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if($fee->isNotEmpty() ||$assignFess->isNotEmpty()|| $studentMontyFee->isNotEmpty()|| $TeacherSalary->isNotEmpty()|| $staffSalary->isNotEmpty()||$expense->isNotEmpty()|| $fund->isNotEmpty())
                <div class="col-md-3 mb-3">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Finance</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-currency-dollar" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#finance">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if ($admission->isNotEmpty())
                <div class="col-md-3 mb-2">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Admission</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-input-cursor-text" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#admission">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if ($question->isNotEmpty())
                <div class="col-md-3 mb-2">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Question</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-journal-medical" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#question">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
            @if($bookType->isNotEmpty() ||$booklist->isNotEmpty()||$booklist->isNotEmpty())
                <div class="col-md-3 mb-2">
                    <div class="card  bg-white mb-0" style="box-shadow:4px 3px 13px  .7px #e5bff7;border-radius:18px;">
                        <h4 class="mb-0 text-center" style="margin-top:20px">Library</h4>
                        <div class="card-body text-center p-1">
                            <div class="card-body text-center">
                                <div class="widget-icon mx-auto mb-5">
                                    <i class="bi bi-book" style="font-size: 80px;color:blueviolet"></i>
                                </div>
                                <div class="d-grid gap-2 col-8 mx-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm recyclebtn" data-bs-toggle="modal" data-bs-target="#library">
                                        View
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif


        @else
            <center style="color: purple;">
                <h5>
                    This File is Empty
                </h5>
            </center>
        @endif


    </div>

</main>


    <!-- Modal of student -->
    <div class="modal fade " id="student" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Student Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                @if ($User->isNotEmpty())
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>


                                @else
                                <center style="color: purple;">
                                    <h5>No data available</h5>
                                </center>
                                @endif
                            </thead>
                            <tbody class="data-row">
                                @foreach ($User as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    {{-- @dd($data->id) --}}
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_student({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_student({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            {{-- <a href="{{ route('restore.student', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a> --}}
                                            {{-- <a href="{{ route('Pdelete.student', $data->id) }}" class="btn btn-outline-danger btn-sm " ><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}
                                        </div>
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

    <!-- Modal of for Finance -->
    <div class="modal fade " id="finance" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Finance Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        @if($fee->isNotEmpty() ||$assignFess->isNotEmpty()||
                        $studentMontyFee->isNotEmpty()||
                        $TeacherSalary->isNotEmpty()||
                        $staffSalary->isNotEmpty()||$expense->isNotEmpty()||
                        $fund->isNotEmpty())

                        {{-- Fees type --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>

                                @if ($fee->isNotEmpty())
                                <center style="color: purple;">
                                    <h5>School Fee Type</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row-fees-type">
                                @foreach ($fee as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->title }}</td>
                                    <td>{{ ($data->deleted_at)->format('Y-m-d') }}</td>
                                    <td>{{ ($data->created_at)->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_student_fees_type({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="permanent_delete-button" onclick="delete_student_fees_type({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            {{-- <a href="{{route('restore.fee', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a> --}}
                                            {{-- <a href="{{route('pdelete.fee', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End fees type --}}

                        {{-- Start Assign Fees --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if ($assignFess->isNotEmpty())
                                <h5>Assign Fee</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row">
                                @foreach ($assignFess as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->fees_details}}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.assignFess', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.assignFess', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End Assign Fees --}}

                        {{-- Start Student Monthly Fees --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            
                            <thead>
                                @if ($studentMontyFee->isNotEmpty())
                                <h5>Student Monthly Fee</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>{{ __('Month Name') }}</th>
                                    <th>{{ __('Fees') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="student-monthly-fees">
                                
                                @foreach ($studentMontyFee as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>
                                        Name: {{$data->user?->name}} <br>
                                        Class: {{$data->user?->class?->class_name}} <br>
                                        Section: {{$data->user?->section?->section_name}} <br>
                                        Roll: {{$data->user?->roll_number}} <br>
                                        UID: {{$data->user?->unique_id}} <br>
                                    </td>
                                    <td>{{ $data->month_name }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_student_monthly_fees({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="permanent-delete-button" onclick="pdelete_student_monthly_fees({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            {{-- <a href="{{ route('restore.studentMontyFee', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.studentMontyFee', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- End Student Monthly Fees --}}

                        {{-- Start Teacher Salary --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if ($TeacherSalary->isNotEmpty())
                                <h5>Teache Salary</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row">
                                @foreach ($TeacherSalary as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->month_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.TeacherSalary', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.TeacherSalary', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End Teacher Salary --}}

                        {{-- Start Staff Salary --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if ($staffSalary->isNotEmpty())
                                <h5>Staff Salary</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row">
                                @foreach ($staffSalary as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->month_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.staffSalary', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.staffSalary', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End Teacher Salary --}}

                        {{-- Start Expense --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if ($expense->isNotEmpty())
                                <h5>Expense</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row-expense-list">
                                @foreach ($expense as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->purpose }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_school_expense({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="permanent_delete-button" onclick="delete_school_expense({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>

                                            {{-- <a href="{{ route('restore.expense', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.expense', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End Expense --}}

                        {{-- Start Fund --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>

                                @if ($fund->isNotEmpty())
                                <h5>Fund List</h5>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="data-row-fund-list">
                                @foreach ($fund as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->purpose }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_school_fund({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="permanent_delete-button" onclick="delete_school_fund({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            
                                            {{-- <a href="{{ route('restore.fund', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.fund', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- End Fund --}}

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal of teacher -->
    <div class="modal fade " id="teacher" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Teacher Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>
                                @if ($Teacher->isNotEmpty())
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @else
                                <center style="color: purple;">
                                    <h5>No data available</h5>
                                </center>
                                @endif
                            </thead>
                            <tbody class="data-row_teacher">
                                @foreach ($Teacher as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    <td>{{ $data->full_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_teacher({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_teacher({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>

                                            {{-- <a href="{{ route('restore.teacher', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.teacher', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
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


    {{-- Modal of library --}}
    <div class="modal fade " id="library" tabindex="-1" aria-labelledby="exampleModalLabel"  data-bs-backdrop="static"aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Library Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">

                        {{-- book type --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            @if($bookType->isNotEmpty() ||$booklist->isNotEmpty()||$booklist->isNotEmpty())
                            <thead>
                                @if($bookType->isNotEmpty())
                                <center style="color: purple;">
                                    <h4>BooK Type</h4>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody class="library-book-type">
                                @foreach ($bookType as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->book_type }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_book_type({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_type({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            
                                            {{-- <a href="{{ route('restore.booktype', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.booktype', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        {{-- book list --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if($booklist->isNotEmpty())
                                <center style="color: purple;">
                                    <h4>Book List</h4>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody class="library-book-list">
                                @foreach ($booklist as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->book_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_book_list({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_list({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            
                                            {{-- <a href="{{ route('restore.book', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.book', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        {{-- borrower list --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if($borrowlist->isNotEmpty())
                                <center style="color: purple;">
                                    <h4>Borrower List</h4>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody class="borrower_list">
                                @foreach ($borrowlist as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->studentRelation?->name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_borrower({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_borrower({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            
                                            {{-- <a href="{{ route('restore.borrower', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('pdelete.borrower', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            @else
                            <center style="color: purple;">
                                <h5>No data available</h5>
                            </center>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal of class -->
    <div class="modal fade " id="class" tabindex="-1" aria-labelledby="exampleModalLabel"data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Class Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        {{-- Class --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            @if($class->isNotEmpty()||$section->isNotEmpty()||$subject->isNotEmpty()||$period->isNotEmpty())
                            <thead>
                                @if($class->isNotEmpty())
                                <center>
                                    <h4>Class</h4>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($class as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->class_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.class', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.class', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        {{-- Section --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            
                            <thead>
                                @if($section->isNotEmpty())
                                <center>
                                    <h5>Section</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($section as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->section_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.section', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.section', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- Class Period --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            
                            <thead>
                                @if($period->isNotEmpty())
                                <center>
                                    <h5>Class Period</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($period as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.period', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.period', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- Subjecct --}}
                        <table id="example" class="table  table-bordered" style="width:100%">

                            <thead>
                                @if($subject->isNotEmpty())
                                <center>
                                    <h5>Subject</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($subject as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->subject_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.subject', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.subject', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{-- Syllabus --}}
                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>
                                @if($syllabus->isNotEmpty())
                                <center>
                                    <h5>syllabus</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                else
                                <div></div>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($syllabus as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->Syllabus }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.syllabus', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.syllabus', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>


                        </table>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal of Reault Setting -->
    <div class="modal fade " id="result" tabindex="-1" aria-labelledby="exampleModalLabel"data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Result Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>

                                @if($resultSetting->isNotEmpty())
                                <center style="color:purple;">
                                    <h5>Result Setting</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>


                                @endif
                            </thead>
                            <tbody>
                                @foreach ($resultSetting as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.resultSetting', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.resultSetting', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i> Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <table id="example" class="table  table-bordered" style="width:100%">
                            @if($Result->isNotEmpty()||$resultSetting->isNotEmpty()||$resultCountablemark->isNotEmpty()||$period->isNotEmpty())

                            <thead>

                                @if($Result->isNotEmpty())
                                <center style="color:purple;">
                                    <h5>Result</h5>
                                </center>

                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody>
                                @foreach ($Result as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->gpa }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.result', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.result', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>

                                @if($resultCountablemark->isNotEmpty())
                                <center style="color:purple;">
                                    <h5>Result Countable Mark</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>


                                @endif
                            </thead>
                            <tbody>
                                @foreach ($resultCountablemark as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->grade }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.resultCountablemark', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.resultCountablemark', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <center style="color: purple;">
                                <h5>No data available</h5>
                            </center>
                            @endif
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal of Reault -->
    <div class="modal fade " id="result1" tabindex="-1" aria-labelledby="exampleModalLabel"  data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Result Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        @if($Result->isNotEmpty()||$resultSetting->isNotEmpty()||$resultCountablemark->isNotEmpty()||$period->isNotEmpty())

                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>

                                @if($Result->isNotEmpty())
                                <center style="color:purple;">
                                    <h5>Result</h5>
                                </center>

                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Roll') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @endif
                            </thead>
                            <tbody>
                                @foreach ($Result as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->student_roll_number }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.result', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.result', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                


                        <table id="example" class="table  table-bordered" style="width:100%">
                            <thead>

                                @if($resultCountablemark->isNotEmpty())
                                <center style="color:purple;">
                                    <h5>Result Countable Mark</h5>
                                </center>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Subject') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>


                                @endif
                            </thead>
                            <tbody>
                                @foreach ($resultCountablemark as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{App\Models\Subject::find($data->subject_id)?->subject_name}}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.resultCountablemark', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.resultCountablemark', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                            <center style="color: purple;">
                                <h5>No data available</h5>
                            </center>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal of Online Admission --}}
    <div class="modal fade " id="admission" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Admission Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            {{-- <button type="button" style="background-color: blueviolet;border-color:blueviolet"
                            class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#delete_all_records">
                            Delete All
                        </button> --}}
                            <thead>
                                @if($admission->isNotEmpty())
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Student') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @else
                                <center style="color: purple;">
                                    <h5>No data available</h5>
                                </center>
                                @endif
                            </thead>
                            <tbody class="data-row_online_admission">
                                @foreach ($admission as $key => $data)
                                {{-- @dd($data) --}}
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{$data->name}}</td>

                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_online_admission_student({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_online_admission({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                            {{-- <a href="{{ route('restore.admission', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.admission', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
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

    {{-- Modal of Question --}}
    <div class="modal fade " id="question" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Question Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            {{-- <button type="button" style="background-color: blueviolet;border-color:blueviolet"
                            class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#delete_all_records">
                            Delete All
                        </button> --}}
                            <thead>
                                @if($question->isNotEmpty())
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.title') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>
                                @else
                                <center style="color: purple;">
                                    <h5>No data available</h5>
                                </center>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($question as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{$data->type}}</td>

                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <a href="{{ route('restore.question', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('Pdelete.admission', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a>

                                        </div>
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

    {{-- Modal of Staff --}}
    <div class="modal fade " id="staff" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blueviolet;color:white">
                    <h5 class="modal-title" id="exampleModalLabel">Staff Data</h5>
                    <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table  table-bordered" style="width:100%">
                            
                            <thead>
                                @if($staff->isNotEmpty())
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    {{-- <th>{{ __('app.n') }}</th> --}}
                                    <th>{{ __('app.Name') }}</th>
                                    <th>Data Deleted</th>
                                    <th>Data Modified</th>
                                    <th>{{ __('app.action') }}</th>
                                </tr>

                                @else
                                <center style="color: purple;">
                                    <h5>No data available</h5>
                                </center>
                                @endif
                            </thead>
                            <tbody class="data-row_staff">
                                @foreach ($staff as $key => $data)
                                <tr>
                                    <td><input type="checkbox" class="check_id" name="ids" value=""></td>
                                    {{-- <td>{{++$key}}</td> --}}
                                    <td>{{ $data->employee_name }}</td>
                                    <td>{{ $data->deleted_at }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <button class="restore-button" onclick="restore_staff({{$data->id}})" data-id="{{ $data->id }}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                            <button class="student-permanent-delete-button" onclick="Permanent_delete_staff({{$data->id}})" data-id="{{ $data->id }}"><i class="bi bi-trash2"></i> Parmanent Delete</button>

                                            {{-- <a href="{{ route('restore.staff', $data->id) }}" class="btn btn-outline-primary btn-sm recycle1" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</a>
                                            <a href="{{ route('p.delete.staff', $data->id) }}" class="btn btn-outline-danger btn-sm "><i class="bi bi-trash2"></i>Parmanent Delete</a> --}}

                                        </div>
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


@endsection

@push('js')
<script>
    $(function(e) {
        $("#select_all_ids").click(function() {
            $('.check_id').prop('checked', $(this).prop('checked'));
        });
        //  $("#all_delete").click(function(e){
        //     e.preventDefault();
        //     var all_ids=[];
        //     $('input:checkbox[name=ids]:checked').each(function(){
        //         all_ids.push($(this).val());
        //     });
        //    // console.log(all_ids);
        //     // $.ajax({
        //     //     url:"{{ route('stafftype.Check.delete') }}",
        //     //     type:"DELETE",
        //     //     data:{
        //     //         ids:all_ids,
        //     //         _token:"{{ csrf_token() }}"
        //     //     },
        //     //     success:function(response){
        //     //         $.each(all_ids,function(key,val){
        //     //             $('#stafftype_ids'+val).remove();
        //     //             window.location.reload(true);
        //     //         });
        //     //     }
        //     // });

        //  });
    });

    
</script>


{{-- Start Student Restore and Permanent delete --}}

<script>    
    function restore_student(id){
        // alert('hi');
        // var dataId = $(this).data('id');
        var dataId = id;
       
        $.ajax({
            url: '/school/student/restorestudent/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_student(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_student(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row').append(newRow);
            });
        }
    };

    function Permanent_delete_student(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/student/Pdeletestudent/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_student(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_student(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row').append(newRow);
            });
        }
    };
</script>

{{-- End Student Restore and Permanent delete --}}

{{-- Start Teacher Restore and Permanent delete --}}

<script>    
    function restore_teacher(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/teacher/restoreteacher/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_teacher').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_teacher(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_teacher(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.full_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_teacher').append(newRow);
            });
        }
    };

    function Permanent_delete_teacher(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/teacher/Pdeleteteacher/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_teacher').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_teacher(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_teacher(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.full_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_teacher').append(newRow);
            });
        }
    };
</script>

{{-- End Teacher Restore and Permanent delete --}}

{{-- Start Staff Restore and Permanent delete --}}

<script>    
    function restore_staff(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/staff/restorestaff/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_staff').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                <button class="restore-button" onclick="restore_staff(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                                <button class="student-permanent-delete-button" onclick="Permanent_delete_staff(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                            </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.employee_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_staff').append(newRow);
            });
        }
    };

    function Permanent_delete_staff(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/staff/PDelete/staff/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_staff').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                <button class="restore-button" onclick="restore_staff(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                                <button class="student-permanent-delete-button" onclick="Permanent_delete_staff(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                            </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.employee_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_staff').append(newRow);
            });
        }
    };
</script>

{{-- End Staff Restore and Permanent delete --}}

{{-- Start Student Finance --}}
    
    <script>  
    
            // Student Fees type start
        function restore_student_fees_type(id){

            var dataId = id;
        
            $.ajax({
                url: '/school/finance/feerestore/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    // alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error restoring data: ' + error);
                }
            });

            function updateDataTable(data) {
                $('.data-row-fees-type').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button class="restore-button" onclick="restore_student_fees_type(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                    <button class="permanent_delete-button" onclick="delete_student_fees_type(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.title + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-fees-type').append(newRow);
                });
            }
        };

        function delete_student_fees_type(id){
            var dataId = id;
        
            $.ajax({
                url: '/school/finance/feepdelete/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    // alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error deleting data: ' + error);
                }
            });

            function updateDataTable(data) {
                $('.data-row-fees-type').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button class="restore-button" onclick="restore_student_fees_type(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                    <button class="permanent_delete-button" onclick="delete_student_fees_type(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                            </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.title + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-fees-type').append(newRow);
                });
            }
        }; 
            //  Student Fees type end


            //  Student Monthly Fees start 
        function restore_student_monthly_fees(id){
            // alert(id);
            var dataId = id;       
            $.ajax({
                url: '/school/finance/studentMontyFeerestore/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);                
                },
                error: function(xhr, status, error) {
                    alert('Error restoring data: ' + error);
                }
            });

            function updateDataTable(data) {
                $('.student-monthly-fees').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button class="restore-button" onclick="restore_student_monthly_fees(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                    <button class="permanent-delete-button" onclick="pdelete_student_monthly_fees(${item.id})" data-id="${item.id}"><i class="bi bi-recycle"></i> Parmanent Delete</button>
                                </div>`;
                    let student_info = `Name: ${item['user']['name']} <br>
                            Class: ${item['user']['class']['class_name']} <br>
                            Section: ${item['user']['section']['section_name']} <br>
                            Roll: ${item['user']['roll_number']} <br>
                            UID: ${item['user']['unique_id']} <br>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + student_info + '</td>'+
                            '<td>' + item.month_name + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.student-monthly-fees').append(newRow);
                });
            }
        };

        function pdelete_student_monthly_fees(id){
            var dataId = id;
        
            $.ajax({
                url: '/school/finance/studentMonthlyFeepdelete/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error restoring data: ' + error);
                }
            });

            function updateDataTable(data) {
                // alert('hi');
                $('.student-monthly-fees').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button class="restore-button" onclick="restore_student_monthly_fees(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                    <button class="permanent-delete-button" onclick="pdelete_student_monthly_fees(${item.id})" data-id="${item.id}"><i class="bi bi-recycle"></i> Parmanent Delete</button>
                                </div>`;

                    let student_info = `Name: ${item['user']['name']} <br>
                            Class: ${item['user']['class']['class_name']} <br>
                            Section: ${item['user']['section']['section_name']} <br>
                            Roll: ${item['user']['roll_number']} <br>
                            UID: ${item['user']['unique_id']} <br>`;

                            // alert(student_info);
                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + student_info + '</td>'+
                            '<td>' + item.month_name + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.student-monthly-fees').append(newRow);
                });
            }
        };
            // Student Monthly Fees end


        // School Expense start
        function restore_school_expense(id){

            var dataId = id;

            $.ajax({
                url: '/school/finance/expenserestore/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error restoring data: ' + error);
                }
            });

            function updateDataTable(data) {
                
                $('.data-row-expense-list').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button class="restore-button" onclick="restore_school_expense(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                        <button class="permanent_delete-button" onclick="delete_school_expense(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.purpose + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-expense-list').append(newRow);
                });
            }
        };

        function delete_school_expense(id){
            var dataId = id;

            $.ajax({
                url: '/school/finance/expensepdelete/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error deleting data: ' + error);
                }
            });

            function updateDataTable(data) {
                
                $('.data-row-expense-list').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button class="restore-button" onclick="restore_school_expense(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                        <button class="permanent_delete-button" onclick="delete_school_expense(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                            </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.purpose + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-expense-list').append(newRow);
                });
            }
        }; 
        //  School Expense end


        // School Fund start
        function restore_school_fund(id){

            var dataId = id;

            $.ajax({
                url: '/school/finance/fundrestore/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error restoring data: ' + error);
                }
            });

            function updateDataTable(data) {
                
                $('.data-row-fund-list').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button class="restore-button" onclick="restore_school_fund(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                        <button class="permanent_delete-button" onclick="delete_school_fund(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                                </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.purpose + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-fund-list').append(newRow);
                });
            }
        };

        function delete_school_fund(id){
            var dataId = id;

            $.ajax({
                url: '/school/finance/fundpdelete/' + dataId,
                type: 'PATCH',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    updateDataTable(response.data);
                    
                },
                error: function(xhr, status, error) {
                    alert('Error deleting data: ' + error);
                }
            });

            function updateDataTable(data) {
                
                $('.data-row-fund-list').empty();
                $.each(data, function(index, item) {
                    let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button class="restore-button" onclick="restore_school_fund(${item.id})" data-id="${item.id}" style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i> Restore</button>
                                        <button class="permanent_delete-button" onclick="delete_school_fund(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                            </div>`;

                    var newRow = '<tr>' +
                            '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                            '<td>' + item.purpose + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.deleted_at + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' + actions + '</td>'+
                        '</tr>';
                    $('.data-row-fund-list').append(newRow);
                });
            }
        }; 
        //  School Fund end
    </script>

{{-- End Student Finance delete --}}


{{-- Start Online admission Restore and Permanent delete --}}

<script>    
    function restore_online_admission_student(id){
        // alert('hi');
        // var dataId = $(this).data('id');
        var dataId = id;
       
        $.ajax({
            url: '/restorAdmission/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_online_admission').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_online_admission_student(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_online_admission(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_online_admission').append(newRow);
            });
        }
    };

    function Permanent_delete_online_admission(id){
        var dataId = id;
       
        $.ajax({
            url: '/pdeleteAdmission/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.data-row_online_admission').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_online_admission_student(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_online_admission(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.data-row_online_admission').append(newRow);
            });
        }
    };
</script>

{{-- End Online Admission Restore and Permanent delete --}}



{{-- Start library Restore and Permanent delete --}}

<script>  
    // book type  
    function restore_book_type(id){
        // alert('hi');
        // var dataId = $(this).data('id');
        var dataId = id;
       
        $.ajax({
            url: '/school/booksTyperestore/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.library-book-type').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_book_type(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_type(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.book_type + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.library-book-type').append(newRow);
            });
        }
    };

    function Permanent_delete_book_type(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/booksType/P/Delete/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.library-book-type').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_book_type(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_type(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.book_type + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.library-book-type').append(newRow);
            });
        }
    };



    // Book list
    function restore_book_list(id){
        // alert('hi');
        // var dataId = $(this).data('id');
        var dataId = id;
       
        $.ajax({
            url: '/school/books/restore/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.library-book-list').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_book_list(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_list(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.book_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.library-book-list').append(newRow);
            });
        }
    };

    function Permanent_delete_book_list(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/books/P/Delete/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.library-book-list').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_book_list(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_book_list(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + item.book_name + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.library-book-list').append(newRow);
            });
        }
    };



    // borrower list
    function restore_borrower(id){
        // alert('hi');
        // var dataId = $(this).data('id');
        var dataId = id;
       
        $.ajax({
            url: '/school/borrowe/restore/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.borrower_list').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_borrower(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_borrower(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                let studentName = ` ${item['student_relation']['name']} `;

                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + studentName + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.borrower_list').append(newRow);
            });
        }
    };

    function Permanent_delete_borrower(id){
        var dataId = id;
       
        $.ajax({
            url: '/school/borrower/P/Delete/' + dataId,
            type: 'PATCH',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                updateDataTable(response.data);
                
            },
            error: function(xhr, status, error) {
                alert('Error restoring data: ' + error);
            }
        });

        function updateDataTable(data) {
            $('.borrower_list').empty();
            $.each(data, function(index, item) {
                let actions = `<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="restore-button" onclick="restore_borrower(${item.id})" data-id="${item.id}"  style="border-color:blueviolet !important;color:blueviolet"><i class="bi bi-recycle"></i>Restore</button>
                            <button class="student-permanent-delete-button" onclick="Permanent_delete_borrower(${item.id})" data-id="${item.id}"><i class="bi bi-trash2"></i> Parmanent Delete</button>
                        </div>`;

                        
                let studentName = ` ${item['student_relation']['name']} `;
                var newRow = '<tr>' +
                        '<td>'  +'<input type="checkbox" class="check_id" name="ids" value="">'+  '</td>' +
                        '<td>' + studentName + '</td>' +
                        '<td>' + item.deleted_at + '</td>' +
                        '<td>' + item.created_at + '</td>' +
                        '<td>' + actions + '</td>'+
                    '</tr>';
                $('.borrower_list').append(newRow);
            });
        }
    };
</script>

{{-- End library Restore and Permanent delete --}}
@endpush



