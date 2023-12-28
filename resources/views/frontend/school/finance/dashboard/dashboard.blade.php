@extends('layouts.school.master')

@section('content')
    <main class="page-content">

        <div class="row">
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{ route('teacher.salary.Show') }}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">
                            {{ __('app.Total Teacher Salary') }}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{ number_format($teacherSalary) }} </h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{ route('teacher.salary.Show') }}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">
                            {{ __('app.Total Teacher Salary Paid') }}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{ number_format($teacherPaidSalary) }} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{ route('teacher.salary.Show') }}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">
                            {{ __('app.Total Teacher Salary Due') }}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format ($teacherSalary - $teacherPaidSalary) }} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.staff.salary.List')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Staff Salary')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($StaffSalary)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.staff.salary.List')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Staff Salary Paid')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($StaffPaidSalary)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.staff.salary.List')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">
                            {{ __('app.Staff Salary Due') }}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($StaffSalary - $StaffPaidSalary)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('expense.show')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Total Expense')}} {{__('app.This Month')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($ExpenseThisMonth)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.finance.userlist')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Total Student Fee')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($TotalFees)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.finance.userlist')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Collected Fee')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($colected)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('school.finance.userlist')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Due Fee')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{$due}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('fund.show')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Fund Receive')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($sumFund)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="#">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Accesories')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($accesories)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('expense.show')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Total Expense')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($Expense)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="{{route('fund.show')}}">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Fund Receive')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($totalSchoolFund)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @if ($profit > '0')
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="#">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Total Profit')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format($profit)}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else 
            <div class="col-xl-4 mb-2 mx-auto">
                <a href="#">
                    <div class="card  bg-white mb-0" style="border-radius:18px;box-shadow:4px 3px 13px  .7px #eedff5;">
                        <h6 class="mb-0 text-center" style="color: blueviolet;margin-top:20px">{{__('app.Total Loss')}}</h6>
                        <div class="card-body text-center p-4">
                            <h3 style="color:rgb(2, 2, 2);">{{number_format(abs($profit))}} ৳</h3>
                            <div class="d-flex justify-content-center gap-3 pt-4">
                                <h6 style="color:#30d915"><i class="bi bi-graph-up-arrow"></i> 17% </h6>
                                <p style="color:rgb(36, 36, 36)">{{ __('app.sincelastweek') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        </div>
        <!--end Cards-->    
	</main>

@endsection

@push('js')
    
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $("#datepicker").datepicker({
                yearRange: "1950:2030",
                dateFormat: "yy-mm-dd",
                yearRange: "1950:2030",
                changeMonth: true,
                changeYear: true,
            });
        })
        $(document).ready(function(){
            $("#datepicker2").datepicker({
                yearRange: "1950:2030",
                dateFormat: "yy-mm-dd",
                yearRange: "1950:2030",
                changeMonth: true,
                changeYear: true,
            });
        })
    </script>

@endpush
