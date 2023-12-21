@extends('layouts.school.master')

@section('content')
<!--start content-->
<main class="page-content">

    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="box-shadow:4px 3px 13px  .13px #484748  !important;">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">{{__('app.Teacher')}} {{__('app.List')}}</h5>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-secondary btn-sm" title="{{__('app.Back')}}" onclick="history.back()"> <i class="bi bi-arrow-left-square"> Back</i></button>
                            @if(Request::segment(2) != 'teacher-salary')
                            <a href="{{route('teacher.create')}}" class="btn btn-primary btn-sm" title="{{__('app.Teacher')}} {{__('app.Create')}}"><i class="bi bi-plus-square"> Create</i></a>
                            @endif
                            <button class="btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()"><i class="bi bi-printer"> Print</i></button>
                        </div>
                    </div>
                </div>
                @if(hasPermission("Teacher Show|Teacher Salary Show"))

                @if (count($teacher) > 0)
                <div class="card-body" id="teacher_list">
                    <div class="table-responsive">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th id="action_table_th"><input type="checkbox" id="select_all_ids"></th>
                                    <th>{{__('app.nong')}}</th>
                                    <th>{{__('app.Teacher')}} {{__('app.Name')}}</th>
                                    {{-- <th>{{__('app.UniqueId')}}</th> --}}
                                    <th>{{__('app.Email')}} / {{__('app.Phone')}}</th>
                                    <th>{{__('app.Salery')}}</th>
                                    

                                    @if(Request::segment(2) == 'teacher-salary')
                                    <th id="action_table_th">{{__('app.Action')}}</th>
                                    @else
                                    <th>{{__('app.Status')}}</th>
                                    <th>Role</th>
                                    <th id="action_table_th">{{__('app.Action')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($teacher as $key => $data)
                                <tr id="teacher_ids{{$data->id}}">
                                    <td class="action_table_td"><input type="checkbox" class="check_ids" name="ids" value="{{$data->id}}"></td>
                                    <td>{{$key++ +1}}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{asset($data->image)}}" class="rounded-circle" width="44" height="44" alt="avatar">
                                            <div>
                                                <a href="{{route('single.view',['id'=>$data->id])}}" class="text-decoration-none" style="white-space: nowrap;">{{strtoupper($data->full_name)}}</a><br>
                                                {{ucwords($data->designation)}}
                                                <br>
                                                UID: {{$data->unique_id}}
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td>{{$data->unique_id}}</td> --}}
                                    <td>
                                        {{$data->email}} <br>
                                        {{$data->phone}}
                                    </td>
                                    <td>{{$data->salary}}</td>

                                    @if(Request::segment(2) == 'teacher-salary')
                                    <td class="action_table_td">
                                        <button class="btn btn-primary btn-sm mb-3" style="background-color: #7c00a7;color: white" onclick="showPaymentDetails('{{$data->id}}')">Payment Details</button>
                                    </td>
                                    @else
                                    <td>
                                        <select class="role-dropdown" data-teacher-id="{{ $data->id }}">
                                            <option value="" selected>NONE</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if($role->id == assignedRoleId('teacher', $data->id)) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('teacher.active',$data->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @if($data->active == 1)
                                            <input type="hidden" name="active" value="0">
                                            <button type="submit" style="border:none;"><span class="badge badge-primary" style="background-color: #7c00a7;color: white">Active</span></button>
                                            @else
                                            <input type="hidden" name="active" value="1">
                                            <button type="submit" style="border:none;"><span class="badge badge-danger" style="background-color: darkred;color: white">In-Active</span></button>
                                            @endif
                                        </form>
                                    </td>
                                    @endif

                                    @if(Request::segment(2) == 'teacher-salary')

                                    @else
                                    <td class="action_table_td">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">

                                            @if(Route::has('school.attendance.report.user'))
                                            <a href="{{route('school.attendance.report.user', ['teacher', $data->id])}}" class="btn-primary btn-sm" title="{{__('app.attendance_report')}}"><i class="bi bi-list-check"></i></a>
                                            @endif


                                            <a href="{{route('single.view',['id'=>$data->id])}}" class="btn btn-info btn-sm" title="{{__('app.View')}}"><i class="bi bi-eye"></i></a>
                                            <button type="button" class="btn btn-primary btn-sm" title="{{__('app.edit')}}" data-bs-toggle="modal" data-bs-target="#editModal{{$key}}"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" title="{{__('app.delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{$key}}"><i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </td>
                                    @endif


                                    <div class="modal fade" id="deleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="background:#FFF;">
                                                <div class="modal-header" style="background: #7c00a7">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">{{__('app.teacher')}} {{__('app.delete')}}</h5>
                                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="get" action="{{route('teacher.delete',['id'=>$data->id])}}">
                                                    <div class="modal-body">
                                                        <h5>{{__('app.surecall')}} ?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('app.no')}}</button>
                                                        <button type="submit" class="btn btn-primary">{{__('app.yes')}}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="editModal{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-xl" style="background:#FFF;">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: #7c00a7">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">{{__('app.teacher')}} {{__('app.Edit')}}</h5>
                                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body border ms-4 me-4 mt-4 mb-4">
                                                    <form class="row g-3 " method="post" action="{{ route('teacher.update', $data->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-12 mt-5">
                                                            <div class="row">
                                                                <div class="col-1"></div>
                                                                <div class="col-md-5"> <label class="form-label">{{ __('app.Name') }} <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" placeholder="{{ __('app.Name') }}" name="full_name" value="{{ $data->full_name }}">
                                                                </div>
                                                                <div class="col-md-5"> <label class="form-label">{{ __('app.Email') }} <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" placeholder="{{ __('app.Email') }}" name="email" value="{{ $data->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-1"></div>

                                                        </div>


                                                        <div class="col-12 mt-4">
                                                            <div class="row mt-2">
                                                                <div class="col-1"></div>

                                                                <div class="col-md-5"> <label class="form-label">{{ __('app.PhoneNumber') }} <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" placeholder="" name="phone" value="{{ $data->phone }}">
                                                                </div>
                                                                <div class="col-md-5"> <label class="form-label">{{ __('app.Nationality') }}</label>
                                                                    <input type="text" class="form-control" name="Nationality" value="{{ $data->Nationality }}" placeholder="{{ __('app.Bangladeshi') }}">
                                                                </div>
                                                                <div class="col-1"></div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <div class="row mt-2">
                                                                <div class="col-1"></div>

                                                                <div class="col-md-5"><label class="form-label">{{ __('app.sign4') }} <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" name="address" value="{{ $data->address }} " placeholder="">
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label">{{ __('app.salary') }}</label>
                                                                        <input type="text" name="salary" value="{{ $data->salary }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-md-5"> <label>{{ __('app.Image') }}</label>
                                                                <div class="input-group mb-1 ">
                                                                    <input type="file" class="form-control " name="image" placeholder="{{ __('app.Image') }}">
                                                                </div>
                                                                <img width="120px" class="mb-3" src="{{asset($data->image)}}" alt="">
                                                            </div> --}}

                                                            <div class="col-1"></div>



                                                        </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="row mt-2">
                                                        <div class="col-1"></div>

                                                        <div class="col-md-5">
                                                            <label class="select-form">{{ __('app.Gender') }} <span style="color:red;">*</span></label>
                                                            <select name="gender" class="form-control mb-3 js-select" id="formSelect">
                                                                <option value="" selected>Select One</option>
                                                                <option value="Female" {{ old('gender', $data->gender) == 'Female' ? 'selected' : '' }}>Female
                                                                </option>
                                                                <option value="Male" {{ old('gender', $data->gender) == 'Male' ? 'selected' : '' }}>Male
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5"> <label class="select-form">{{ __('app.Blood') }}
                                                                {{ __('app.Group') }}</label>
                                                            <select name="blood_group" class="form-control mb-3 js-select" id="formSelect">
                                                                <option value="" selected>Select One</option>
                                                                <option value="A+" {{ ($data->blood_group == 'A-') ? 'selected' : '' }}>A+</option>
                                                                <option value="A-" {{ ($data->blood_group == 'A-') ? 'selected' : '' }}>A-</option>
                                                                <option value="B+" {{ ($data->blood_group == 'B+') ? 'selected' : '' }}>B+</option>
                                                                <option value="B-" {{ ($data->blood_group == 'B-') ? 'selected' : '' }}>B-</option>
                                                                <option value="O+" {{ ($data->blood_group == 'O+') ? 'selected' : '' }}>O+</option>
                                                                <option value="O-" {{ ($data->blood_group == 'O-') ? 'selected' : '' }}>O-</option>
                                                                <option value="AB+" {{ ($data->blood_group == 'AB+') ? 'selected' : '' }}>AB+</option>
                                                                <option value="AB-" {{ ($data->blood_group == 'AB-') ? 'selected' : '' }}>AB-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-1"></div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="row mt-2">
                                                        <div class="col-1"></div>
                                                        <div class="col-md-5">
                                                            <label class="form-label">{{__('app.Shift')}}</label>
                                                            <select name="shift" class="form-control mb-3 js-select" id="formSelect">
                                                                <option value="" selected>Select One</option>
                                                                <option value="Morning" {{ old('shift', $data->shift) == 'Morning' ? 'selected' : '' }}>Morning</option>
                                                                <option value="Day" {{ old('shift', $data->shift) == 'Day' ? 'selected' : '' }}>Day</option>
                                                                <option value="Evening" {{ old('shift', $data->shift) == 'Evening' ? 'selected' : '' }}>Evening</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5"> <label class="select-form"><span style="color:black;">Marital Status</span></label>
                                                            <select name="M_status" class="form-control mb-3 js-select" id="formSelect">
                                                                <option value="" selected>Select One</option>
                                                                <option value="Married" {{ old('M_status', $data->M_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                                                <option value="Unmarried" {{ old('M_status', $data->M_status) == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-1"></div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <div class="row mt-2">
                                                        <div class="col-1"></div>

                                                        <div class="col-md-5">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.Designation') }} <span style="color:red;">*</span></label>
                                                                <input type="text" name="designation" value="{{ $data->designation }}" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.Department') }}</label>
                                                                <input type="text" name="department_name" value="{{ $data->department_name }}" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-1"></div>
                                                        <div class="col-1"></div>

                                                        <div class="col-md-5">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.entry_time') }} </label>
                                                                <input type="time" name="entry_time" value="{{ $data->entry_time }}" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.exit_time') }}</label>
                                                                <input type="time" name="exit_time" value="{{ $data->exit_time }}" class="form-control">
                                                            </div>
                                                        </div>


                                                        <div class="col-12 mt-4">
                                                            <div class="row">
                                                                <div class="col-1"></div>

                                                                <div class="col-md-5"> <label>{{ __('app.Image') }}</label>
                                                                    <div class="input-group mb-1 ">
                                                                        <input type="file" class="form-control " name="image" placeholder="{{ __('app.Image') }}">
                                                                    </div>
                                                                    <img width="120px" class="mb-3" src="{{asset($data->image)}}" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-4">
                                                                <div class="row">
                                                                    <div class="col-1"></div>
                                                                    <div class="col-md-8">
                                                                        <button type="submit" class="btn btn-primary">{{ __('app.Submit') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>
                    <div class="row" style="margin-top: -35px;margin-bottom: 10px;" id="hide_while_print">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-outline-danger btn-sm me-2" id="delete_button" data-bs-toggle="modal" data-bs-target="#delete_all_records">
                                {{__('app.deleteall')}}
                            </button>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>

                    {{-- {!!$teacher->links()!!} --}}
                </div>
                @else
                <center>
                    <div class="card">
                        <div class="card-body mb-3">
                            <img src="{{asset('images/no_data_found.svg')}}" alt="" width="200px;" height="200px;" srcset="">
                        </div>
                        <div class="text-muted">
                            <h5 style="padding: 0px;">No Data Found.</h5>
                        </div>

                    </div>
                </center>
                @endif

                <div style="display: none;">
                    <div id="printable_content" style="font-size:12px;"></div>
                </div>

            </div>
        </div>
    </div>
    </div>
</main>



{{-- Modal for showing salary details --}}
<div class="modal fade" id="payment_details">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Details</h5>
            </div>
            <div class="modal-body table-responsive">

            </div>
        </div>
    </div>
</div>


{{-- modal for salary payment --}}
<div class="modal fade" id="paySalaryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: #7c00a7">
                <h5 class="modal-title text-white" id="exampleModalLabel">Pay Salary</h5>
                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>



<!--Delete Modal -->
<div class="modal fade" id="delete_all_records" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#7c00a7;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">{{__('app.Teacher')}} {{__('app.Record')}}</h4>
                <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>
                    {{__('app.checkdelete')}}
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('app.no')}}</button>
                <button type="button" id="all_delete" class="btn btn-primary">{{__('app.yes')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="multiple_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>
                    are you sure to changed?
                </h3>
                <form method="post" action="" id="all_changed" enctype="multipart/form-data">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
$tutorialShow = getTutorial('teacher-show');
?>
@include('frontend.partials.tutorial')

@endsection
@push('js')
<script>
    const currency = '৳';

    let showPaymentDetails = (id) => {

        $.ajax({
            url: '/school/teacher-salary/history/' + id,
            type: 'get',
            success: (response) => {
                console.log(response);

                if (response.data.length) {
                    let paidAmount, dueAmount, salaryStatus, fixed_salary, paid_amount, month_name, last_update_at;

                    let element = ` <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Month Name</th>
                                                <th>Amount</th>
                                                <th>Due</th>
                                                <th>Last updated Date</th>
                                                @if(hasPermission("Teacher Salary Edit"))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>`;

                    response.data.forEach((item, key) => {

                        fixed_salary = Number(parseFloat(item['fixed_salary']));
                        paid_amount = item['paid_amount'];
                        month_name = item['month'];
                        last_updated_at = item['last_updated_at'];


                        if (paid_amount == 0) {
                            paidAmount = '<span class="badge bg-warning text-dark">UNPAID</span>';
                            dueAmount = fixed_salary;
                        } else {
                            paidAmount = paid_amount + currency;
                            dueAmount = fixed_salary - paid_amount;
                        }

                        if (paid_amount != fixed_salary) {
                            salaryStatus = `<button class="btn btn-primary btn-sm mb-3" onclick="paySalaryModal(${fixed_salary}, ${paid_amount}, '${month_name}', ${item['id']})">Pay Salary</button>`;
                        } else {
                            salaryStatus = `<button class="btn btn-primary btn-sm mb-3" style="pointer-events: none; background: #7c00a7;">Full Paid</button>`;
                        }


                        element += `<tr>
                                <td>${month_name}</td>
                                <td>${paidAmount}</td>
                                <td>${dueAmount} ${currency}</td>
                                <td>${last_updated_at}</td>
                                @if(hasPermission("Teacher Salary Edit"))
                                    <td>${salaryStatus}</td>
                                @endif
                            </tr>`
                    });

                    element += `</tbody></table>`;

                    $("#payment_details .modal-body").html(element);

                    $("#payment_details").modal('show');
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Not found',
                        text: "Record does not exists",
                    });
                }
            },
            error: (error) => {
                console.log(error);

                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: error.responseJSON.message,
                });
            },
        });

    }


    let paySalaryModal = (FixedSalary, PaidAmount, Month, RowId) => {

        let paidAmount = FixedSalary;

        if (PaidAmount != 0) {
            paidAmount = paidAmount - PaidAmount;
        }


        let element = `<form class="row g-3" method="post" enctype="multipart/form-data" id="paidSalaryForm" onsubmit="paidSalaryFormSubmit(event)">
                    @csrf
                    <input type="hidden" name="id" value="${RowId}"/>
                    <div class="col-12">
                        <label class="form-label text-dark">Pay For ${Month}</label>
                        <input type="text" class="form-control" name="amount" value="${paidAmount}" placeholder="${paidAmount}">
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>`;

        $("#paySalaryModal .modal-body").html(element);

        $("#paySalaryModal").modal("show");
    }


    let paidSalaryFormSubmit = (event) => {
        event.preventDefault();

        $.ajax({
            url: '{{route("school.teacher.salary.update")}}',
            type: 'POST',
            data: $("#paidSalaryForm").serialize(),
            success: (response) => {
                console.log(response);
                showPaymentDetails(response.data.id);

                $("#paySalaryModal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: response.message,
                });
            },
            error: (error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: error.responseJSON.message,
                });
            }
        });
    }




    $(function(e) {
        $("#select_all_ids").click(function() {
            $('.check_ids').prop('checked', $(this).prop('checked'));
        });
        $("#all_delete").click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });

            $.ajax({
                url: "{{route('teacher.Check.Delete')}}",
                type: "DELETE",
                data: {
                    ids: all_ids,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#teacher_ids' + val).remove();
                        window.location.reload(true);
                    });
                }
            });
        });
        $("#all_changed").click(function(e) {
            e.preventDefault();
            var all_status = [];
            $('input:checkbox[name=active]:checked').each(function() {
                all_status.push($(this).val());
            });
            //console.log(all_status);
            $.ajax({
                url: "{{route('teacher.multiple.active')}}",
                type: "POST",
                data: {
                    active: all_status,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_status, function(key, val) {
                        $('#teacher_ids' + val).changed();
                        window.location.reload(true);
                    });
                }
            });
        });
    });
</script>


// print

<script src="{{asset('js/printThis.js')}}"></script>

<script>
    function printDiv(printDiv) {
        toastr.success("Generating ...");

        $("#printable_content").html($("#teacher_list").html());
        $("#printable_content .action_table_td").remove();
        $("#printable_content #action_table_th").remove();
        $("#printable_content #delete_button").remove();
        $("#printable_content #example_length").remove();
        $("#printable_content #example_filter").remove();
        $("#printable_content .hide_while_print").remove();
        $("#printable_content #example_paginate").remove();

        $("#printable_content").printThis({
            header: `<div class="d-flex justify-content-center">
                        @if (File::exists(public_path(Auth::user()->school_logo)) && !is_null(Auth::user()->school_logo))
                            <img src="{{asset(Auth::user()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                        @endif                                                                                                                                                                 
                        <div class="text-center text-dark">
                            <h4 style="margin-bottom:0px;"> {{ strtoupper( Auth::user()->school_name) }} </h4>
                            <p style="margin-bottom:0px;"> {{ (Auth::user()->slogan )}} </p> 
                            <p style="margin-bottom:0px;"> {{ (Auth::user()->address )}} </p> 
                            <p style="font-size: 20px;"><b>{{__('app.Teacher')}} {{__('app.List')}}</b></p>                                       
                        </div>   
                    </div>`,
            footer: `<div class="d-flex justify-content-between">
                        <small class="m-0">This is auto generated copy.</small>
                        <small class="m-0">Powered by {{env('APP_NAME')}}</small>
                    </div>`
        });
    }
    $(document).ready(function() {
        $('.role-dropdown').change(function() {
            var teacherId = $(this).data('teacher-id');
            var roleId = $(this).val();

            $.ajax({
                url: '/school/update-permission',
                type: 'POST',
                data: {
                    teacher_id: teacherId,
                    role_id: roleId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                },
            });
        });
    });
</script>@endpush