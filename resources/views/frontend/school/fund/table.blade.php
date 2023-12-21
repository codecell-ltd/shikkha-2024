@extends('layouts.school.master')
@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush
@section('content')
<!--start content-->
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-header py-3 bg-transparent">
                <div class="d-sm-flex align-items-center">
                    <h5 class="mb-2 mb-sm-0 text"><a href="{{route('fund.show')}}"><span style="color:black;">{{__('app.Fund List')}}</span></a></h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">{{__('app.back')}}</button>
                        @php
                        $expenseFund = 2;
                        @endphp
                        @if(hasPermission("fund_create"))
                        <a href="{{route('expense.create',['expenseFund' => $expenseFund])}}" class="btn btn-primary"> {{__('app.Add new Fund')}}</a>
                        @endif
                        @if(hasPermission("fund_list_show"))
                        <button type="button" class="btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()"><i class="bi bi-printer"> Print</i></button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card shadow">

                        <div class="card-body">

                            <div class="form-group">
                                <form action="{{route('fund.show')}}" method="GET" id="orderIdForm">
                                    @csrf

                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md">
                                                <label for=""><b>{{__('app.Search On Date/Start Date')}}</b></label>
                                                <input type="text" id="datepicker" name="searchdate" placeholder="YYYY-MM-DD" class="form-control @error('searchdate') is-invalid @enderror">

                                                @error('searchdate')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>

                                            <div class="col-md">
                                                <label for=""><b>{{__('app.Search End Date')}}</b></label>
                                                <input type="text" id="datepicker2" name="enddate" placeholder="YYYY-MM-DD" class="form-control @error('enddate') is-invalid @enderror">

                                                @error('enddate')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>



                                            <div class="col-md">
                                                <label for=""><b>{{__('app.Search On month')}}</b></label>
                                                <select class="form-control mb-3 js-select" name="searchmonth" class="form-control @error('searchmonth') is-invalid @enderror">
                                                    <option value="" selected>{{__('app.select')}}</option>
                                                    <option value="1" @isset(request()->searchmonth) {{(request()->searchmonth == 1) ? 'selected' : ''}} @endisset>January</option>
                                                    <option value="2" @isset(request()->searchmonth) {{(request()->searchmonth == 2) ? 'selected' : ''}} @endisset>February</option>
                                                    <option value="3" @isset(request()->searchmonth) {{(request()->searchmonth == 3) ? 'selected' : ''}} @endisset>March</option>
                                                    <option value="4" @isset(request()->searchmonth) {{(request()->searchmonth == 4) ? 'selected' : ''}} @endisset>April</option>
                                                    <option value="5" @isset(request()->searchmonth) {{(request()->searchmonth == 5) ? 'selected' : ''}} @endisset>May</option>
                                                    <option value="6" @isset(request()->searchmonth) {{(request()->searchmonth == 6) ? 'selected' : ''}} @endisset>June</option>
                                                    <option value="7" @isset(request()->searchmonth) {{(request()->searchmonth == 7) ? 'selected' : ''}} @endisset>July</option>
                                                    <option value="8" @isset(request()->searchmonth) {{(request()->searchmonth == 8) ? 'selected' : ''}} @endisset>August</option>
                                                    <option value="9" @isset(request()->searchmonth) {{(request()->searchmonth == 9) ? 'selected' : ''}} @endisset>September</option>
                                                    <option value="10" @isset(request()->searchmonth) {{(request()->searchmonth == 10) ? 'selected' : ''}} @endisset>October</option>
                                                    <option value="11" @isset(request()->searchmonth) {{(request()->searchmonth == 11) ? 'selected' : ''}} @endisset>November</option>
                                                    <option value="12" @isset(request()->searchmonth) {{(request()->searchmonth == 12) ? 'selected' : ''}} @endisset>December</option>
                                                </select>

                                                @error('searchmonth')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>



                                            <div class="col">
                                                <label for="search"> </label><br>
                                                <button class="btn btn-primary">{{__('app.search')}}</button>
                                            </div>


                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            @if (isset($expense) AND count($expense) > 0)
            <div class="card shadow" id="Fund_list" style="font-size:12px;">

                <center>
                    @if(isset($searchmonth))
                    <p style="margin: 0px;padding: 0px; font-size:18px;">Month: @if ($searchmonth == 1) January
                        @elseif($searchmonth == 2) February
                        @elseif($searchmonth == 3) March
                        @elseif($searchmonth == 4) April
                        @elseif($searchmonth == 5) May
                        @elseif($searchmonth == 6) June
                        @elseif($searchmonth == 7) July
                        @elseif($searchmonth == 8) August
                        @elseif($searchmonth == 9) September
                        @elseif($searchmonth == 10) October
                        @elseif($searchmonth == 11) November
                        @else December
                        @endif
                    </p>
                    @elseif (isset($searchdate))
                    @if (isset($enddate))
                    <p style="margin: 0px; padding: 0px; font-size:18px;"> Fund Between: {{ date('d-m-Y', strtotime($searchdate)) }} to {{ date('d-m-Y', strtotime($enddate)) }}</p>
                    @else
                    <p style="margin: 0px; padding: 0px; font-size:18px;"> Fund on: {{ date('d-m-Y', strtotime($searchdate)) }}</p>
                    @endif
                    @else
                    @endif
                    <h5>Total Fund: {{number_format($sumFund)}} <i class="fa-solid fa-bangladeshi-taka-sign"></i></h5>
                </center>
                @if(hasPermission("fund_list_show"))
                <div class="card-body">
                    <table id="example" class="table table-striped table-hover data-table">
                        <button type="button" class="btn btn-danger btn-sm mb-2" id="delete_btn" data-bs-toggle="modal" data-bs-target="#delete_all_records">
                            {{__('app.deleteall')}}
                        </button>
                        <thead>
                            <tr>
                                <th id="action_table_th"><input type="checkbox" id="select_all_ids"></th>
                                <th scope="col">{{__('app.ID')}}</th>
                                <th scope="col">{{__('app.date')}}</th>
                                <th scope="col">{{__('app.Fund Purpose')}}</th>
                                <th scope="col">{{__('app.Payment Method')}}</th>
                                <th scope="col">{{__('app.Account')}}</th>
                                <th scope="col">{{__('app.Fund by')}}</th>
                                <th scope="col">{{__('app.Amount')}}</th>
                                <th scope="col">{{__('app.Remark')}}</th>
                                <th scope="col" id="action_table_th">{{__('app.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expense as $key => $item)
                            <tr id="fund_ids{{$item->id}}">
                                <td id="action_table_td" style="padding: 0px;"><input type="checkbox" class="check_ids" name="ids" value="{{$item->id}}"></td>
                                <th scope="row" style="padding: 0px;">{{++$key}}</th>
                                <td style="padding: 0px;">{{date('d-m-Y',strtotime($item->datee))}}</td>
                                <td style="padding: 0px;">{{$item->purpose}}</td>
                                <td style="padding: 0px;">@if( $item->payment_method == 1) Hand Cash
                                    @elseif( $item->payment_method == 2) Bank Transiction
                                    @else
                                    @endif
                                </td>
                                <td style="padding: 0px;">{{ \App\Models\Bank::find($item->account)->account_number ?? ""}}</td>
                                <td style="padding: 0px;">{{$item->name}}</td>
                                <td style="padding: 0px;">{{$item->amount}}</td>
                                <td style="padding: 0px;">{{$item->remark}}</td>
                                <td class="text-nowrap" id="action_table_td" style="padding: 0px;">
                                    <a href="{{ route('expense.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        {{__('app.Edit')}}
                                    </a>

                                    <button class="btn btn-sm btn-primary" onclick="if(confirm('Are you sure? you are going to delete this record')){ location.replace( '{{route('expense.delete',$item->id) }}' ); }">
                                        {{__('app.Delete')}}
                                    </button>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <div class="col-12 py-5 text-center">
                            <tr>
                                <td colspan="9" style="text-align: center;">No record found</td>
                            </tr>
                </div>
                </tr>
                @endforelse

                </tbody>
                </table>
            </div>
            @endif
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


    </div>
    </div>

    <div style="display: none">
        <div id="printable_content"></div>
    </div>


</main>
<!-- delete checkbox Modal -->
<div class="modal fade" id="delete_all_records" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:blueviolet;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">{{__('app.Fund')}} {{__('app.Record')}}</h4>
                <button type="button" class="btn-close btn-white" style="color:white;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>
                    {{__('app.checkdelete')}}
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('app.no')}}</button>
                <button type="button" id="all_delete" class="btn btn-primary" style="background-color:blueviolet !important;border-color:blueviolet !important;">{{__('app.yes')}}</button>
            </div>
        </div>
    </div>
</div>
<?php
$tutorialShow = getTutorial('department-show');
?>
@include('frontend.partials.tutorial')
@endsection
@push('js')

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
            yearRange: "1950:2030",
            dateFormat: "yy-mm-dd",
            yearRange: "1950:2030",
            changeMonth: true,
            changeYear: true,
        });
    })
</script>

<script>
    $(document).ready(function() {
        $("#datepicker2").datepicker({
            yearRange: "1950:2030",
            dateFormat: "yy-mm-dd",
            yearRange: "1950:2030",
            changeMonth: true,
            changeYear: true,
        });
    })
</script>

<script>
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
            console.log(all_ids);
            $.ajax({
                url: "{{route('fund.check.delete')}}",
                type: "DELETE",
                data: {
                    ids: all_ids,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    $.each(all_ids, function(key, val) {
                        $('#fund_ids' + val).remove();
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

        $("#printable_content").html($("#Fund_list").html());
        $("#printable_content #action_table_th").remove();
        $("#printable_content #delete_btn").remove();
        $("#printable_content #action_table_td").remove();
        $("#printable_content #example_length").remove();
        $("#printable_content #example_filter").remove();
        $("#printable_content #example_paginate").remove();

        $("#printable_content").printThis({
            header: `<div class="d-flex justify-content-center">
                            @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:20px;">
                            @endif                                                                                                                                                                 
                            <div class="text-center text-dark">
                                <h4 style="margin-bottom:0px;"> {{ strtoupper( authUser()->school_name) }} </h4>
                                <p style="margin-bottom:0px;"> {{ (authUser()->slogan )}} </p> 
                                <p style="margin-bottom:0px;"> {{ (authUser()->address )}} </p> <br>
                                
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