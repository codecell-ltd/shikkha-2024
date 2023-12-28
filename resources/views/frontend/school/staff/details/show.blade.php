@extends('layouts.school.master')

@section('content')
<!--start content-->
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="mb-2 mb-sm-0">{{__('app.Stuff')}} {{__('app.List')}}</h5>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-secondary btn-sm" title="{{__('app.back')}}" onclick="history.back()"><i class="bi bi-arrow-left-square"> Back</i></button>
                            @if(Request::segment(2) != 'staff-salary')
                            @if (hasPermission("Staff List Create"))
                                <a href="{{route('school.staff.List.create')}}" class="btn btn-primary btn-sm" title="{{__('app.staff create')}}"><i class="bi bi-plus-square"> Create</i></a>
                            @endif
                            <button class="btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()"><i class="bi bi-printer"> Print</i></button>

                            @endif
                            {{-- <button type="button" title="{{__('app.Tutorial')}}" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="lni lni-youtube"> Tutorial</i> </button> --}}
                        </div>
                    </div>
                </div>
                @if(hasPermission("Staff List Show|Staff Salary Show"))
                @if (count($employee) > 0 AND isset($employee) )
                <div class="card-body" id="staff_list">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <button type="button" class="btn btn-danger btn-sm mb-2" id="delete_button" data-bs-toggle="modal" data-bs-target="#delete_all_records">
                                {{__('app.deleteall')}}
                            </button>

                            <thead>
                                <tr>
                                    <th id="action_table_th"><input type="checkbox" id="select_all_ids"></th>
                                    <th>{{__('app.nong')}}</th>
                                    <th>{{__('app.EmployeeName')}}</th>
                                    <th>{{__('app.Phone')}} </th>
                                    <th>{{__('app.UniqueId')}} </th>
                                    <th>{{__('app.position')}}</th>
                                    <th>{{__('app.shift')}}</th>
                                    <th id="action_table_th">{{__('app.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $key => $data)
                                <tr id="staff_ids{{$data->id}}">
                                    <td class="action_table_td"><input type="checkbox" class="check_id" name="ids" value="{{$data->id}}"></td>
                                    <td>{{$key++ +1}} </td>
                                    <td>
                                        <a href="{{route('staff.view',$data->id)}}" class="text-decoration-none">{{strtoupper($data->employee_name)}}</a>
                                    </td>
                                    <td>{{$data->phone_number}}</td>
                                    <td>{{$data->employee_id}}</td>

                                    <td>{{strtoupper($data->position)}}</td>
                                    <td>{{$data->shift}}</td>
                                    <td class="action_table_td">
                                        @if(Request::segment(2) == 'staff-salary')
                                            <button class="btn btn-primary btn-sm mb-3" onclick="showPaymentDetails('{{$data->id}}')">Payment Details</button>
                                        @else
                                            <div class="btn-group mr-2" role="group" aria-label="First group">

                                                @if(Route::has('school.attendance.report.user'))
                                                    <a href="{{route('school.attendance.report.user', ['staff', $data->id])}}" class="btn-primary btn-sm" title="{{__('app.attendance_report')}}"><i class="bi bi-list-check"></i></a>
                                                @endif

                                                <a href="{{route('staff.view',$data->id)}}" class="btn btn-info btn-sm" title="{{__('app.View')}}"><i class="bi bi-eye"></i></a>
                                                @if (hasPermission("Staff List Edit"))
                                                    <button type="button" class="btn btn-primary btn-sm" title="{{__('app.edit')}}" data-bs-toggle="modal" data-bs-target="#editModal{{$key}}"><i class="bi bi-pencil-square"></i></button>
                                                @endif
                                                @if (hasPermission("Staff List Delete"))
                                                    <button type="button" class="btn btn-danger btn-sm" title="{{__('app.Delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal{{$key}}"><i class="bi bi-trash-fill"></i></button>
                                                @endif
                                            </div>
                                        
                                        @endif
                                    </td>

                                    <div class="modal fade" id="editModal{{$key}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background: #7c00a7">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">{{__('app.Stuff')}}</h5>
                                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body border ms-4 me-4 mt-4 mb-4">
                                                    <form class="row g-3" method="post" action="{{ route('school.staff.List.create.update', $data->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-12 mt-4">
                                                            <label class="form-label">{{ __('app.EmployeeName') }} <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" required name="employee_name" value="{{ $data->employee_name }}" required>
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <label class="form-label">{{ __('app.phone') }} <span style="color:red;">*</span></label>
                                                            <input type="integer" class="form-control" required name="phone_number" value="{{ $data->phone_number }}" required>
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <label class="form-label">{{ __('app.PositionName') }} <span style="color:red;">*</span></label>
                                                            <select class="form-select mb-3" aria-label="Default select example" name="position" required>
                                                                @foreach ($position_name as $item)
                                                                <option value="{{ $data->position}}" {{ ($data->position == $item->position_name) ? 'selected' : '' }}>
                                                                    {{ $item->position_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <label class="select-form">{{ __('app.Gender') }} <span style="color:red;">*</span></label>
                                                            <select name="gender" class="form-control mb-3 js-select" id="formSelect">
                                                                <option value="" selected>Select One</option>
                                                                <option value="Female" {{ old('gender', $data->gender) == 'Female' ? 'selected' : '' }}>Female
                                                                </option>
                                                                <option value="Male" {{ old('gender', $data->gender) == 'Male' ? 'selected' : '' }}>Male
                                                                </option>
                                                            </select>
                                                        </div>


                                                        <div class="col-12 mt-4">
                                                            <label class="form-label">{{ __('app.Address') }}<span style="color:red;">*</span></label>
                                                            <input type="text" required class="form-control" name="address" value="{{$data->address}}">
                                                        </div>
                                                        <div class="col-12 mt-4">
                                                            <label class="select-form">{{ __('app.Shift') }}</label>
                                                            <select class="form-control mb-3 js-select" name="shift" id="shift" required>
                                                                <option value="Morning" {{ ($data->shift == 'Morning') ? 'selected' : '' }}>{{ __('app.morning') }}</option>
                                                                <option value="Day" {{ ($data->shift == 'Day') ? 'selected' : '' }}>{{ __('app.day') }}</option>
                                                                <option value="Evening" {{ ($data->shift == 'Evening') ? 'selected' : '' }}>{{ __('app.evening') }}</option>
                                                            </select>
                                                        </div>

                                                        {{-- <div class="col-12 mt-4">
                                                                    <label class="form-label">{{ __('app.Address') }}<span style="color:red;">*</span></label>
                                                        <input type="text" required class="form-control" name="address" value="{{ $data->address }}">
                                                </div> --}}
                                                <div class="col-12 mt-4">
                                                    <label class="select-form">{{ __('app.Shift') }}</label>
                                                    <select class="form-control mb-3 js-select" name="shift" id="shift" required>
                                                        <option value="Morning" {{ ($data->shift == "Morning") ? 'selected' : '' }}>{{ __('app.morning') }}</option>
                                                        <option value="Day" {{ ($data->shift == "Day") ? 'selected' : '' }}>{{ __('app.day') }}</option>
                                                        <option value="Evening" {{ ($data->shift == "Evening") ? 'selected' : '' }}>{{ __('app.evening') }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <label class="form-label">{{ __('app.Salary') }}<span style="color:red;">*</span></label>
                                                    <input type="text" required class="form-control" placeholder="{{ __('app.Salary') }}" name="salary" value="{{$data->salary}}">
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.entry_time') }} </label>
                                                                <input type="time" name="entry_time" value="{{ $data->entry_time }}" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('app.exit_time') }}</label>
                                                                <input type="time" name="exit_time" value="{{ $data->exit_time }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <label>{{ __('app.image') }}</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" id="image-file" name="image" placeholder="image" accept="image/*">
                                                        <img src="{{ asset($data->image) }}" alt="" width="100">
                                                    </div>
                                                </div>


                                            </div>



                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">{{ __('app.Submit') }}</button>
                                                </div>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #7c00a7">
                                <h5 class="modal-title text-white" id="exampleModalLabel">{{__('app.Stuff')}} {{__('app.Delete')}}</h5>
                                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="get" action="{{route('school.staff.delete',$data->id)}}">
                                <div class="modal-body">
                                    <h5>{{__('app.surecall')}} ?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('app.No')}}</button>
                                    <button type="submit" class="btn btn-primary">{{__('app.yes')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
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
        @endif

        <div style="display: none">
            <div id="printable_content"></div>
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

<!-- Delete All Modal -->
<div class="modal fade" id="delete_all_records" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#7c00a7;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">{{__('app.Stuff')}} {{__('app.Record')}}</h4>
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

<?php
$tutorialShow = getTutorial('staff-salary-show');
?>
@include('frontend.partials.tutorial')

@endsection

@push('js')
<script>
    const currency = '৳';

    let showPaymentDetails = (staffId) => {

        $.ajax({
            url: '/school/staff-salary/history/' + staffId,
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
                                            @if (hasPermission("Staff Salary Edit"))
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
                            @if (hasPermission("Staff Salary Edit"))
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
            url: '{{route("school.staff.salary.update")}}',
            type: 'POST',
            data: $("#paidSalaryForm").serialize(),
            success: (response) => {
                console.log(response);
                showPaymentDetails(response.data.staffId);

                $("#paySalaryModal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: response.message,
                });
            },
            error: (error) => {
                console.log(error);

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
            $('.check_id').prop('checked', $(this).prop('checked'));
        });
        $("#all_delete").click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            // console.log(all_ids);
            $.ajax({
                url: "{{route('staff.Check.delete')}}",
                type: "DELETE",
                data: {
                    ids: all_ids,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#staff_ids' + val).remove();
                        window.location.reload(true);
                    });
                }
            });

        });
    });
</script>

<script src="{{asset('js/printThis.js')}}"></script>

<script>
    function printDiv(printDiv) {
        toastr.success("Generating ...");

        $("#printable_content").html($("#staff_list").html());
        $("#printable_content .action_table_td").remove();
        $("#printable_content #action_table_th").remove();
        $("#printable_content #delete_button").remove();
        $("#printable_content #example_length").remove();
        $("#printable_content #example_filter").remove();
        $("#printable_content .hide_while_print").remove();
        $("#printable_content #example_paginate").remove();

        $("#printable_content").printThis({
            header: `<div class="d-flex justify-content-center">
                        @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                            <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                        @endif                                                                                                                                                                 
                        <div class="text-center text-dark">
                            <h4 style="margin-bottom:0px;"> {{ strtoupper( authUser()->school_name) }} </h4>
                            <p style="margin-bottom:0px;"> {{ (authUser()->slogan )}} </p> 
                            <p style="margin-bottom:0px;"> {{ (authUser()->address     )}} </p> 
                            <p style="font-size: 20px;"><b>{{__('app.Stuff')}} {{__('app.List')}}</b></p>                                       
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