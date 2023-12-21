@extends('layouts.school.master')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush
@section('content')
    <!--start content-->
    <main class="page-content">
        <x-page-title title='Auto Attendance Settings'/>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    @include('frontend.layouts.message')
                                </div>

                                @php 
                                $morningShift = "7:00 AM"; 
                                $dayShift = "10:30 AM"; 
                                $eveningShift = "3:00 PM"; 
                                @endphp
                               
                                <div class="col-12 mb-3 form-group">
                                    <label for="" class="select-form">Morning</label>
                                    <select name="send_absent_sms_at_morning" class="form-control js-select">
                                        <option value="" selected>Select One</option>
                                        @for ($i = 0; $i < 13; $i++)
                                        <option value="{{$morningShift}}" {{ (authUser()->send_absent_sms_at_morning == date("H:i:s", strtotime($morningShift))) ? 'selected' : ''}} >{{$morningShift}}</option>
                                        @php $morningShift = \Carbon\Carbon::parse(date("H:i", strtotime($morningShift)))->addMinutes(15)->format("g:i A"); @endphp
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-12 mb-3 form-group">
                                    <label for="" class="select-form">Day</label>
                                    <select name="send_absent_sms_at_day" class="form-control js-select">
                                        <option value="" selected>Select One</option>
                                        @for ($i = 0; $i < 13; $i++)
                                        <option value="{{$dayShift}}" {{ (authUser()->send_absent_sms_at_day == date("H:i:s", strtotime($dayShift))) ? 'selected' : ''}}>{{$dayShift}}</option>
                                        @php $dayShift = \Carbon\Carbon::parse(date("H:i", strtotime($dayShift)))->addMinutes(15)->format("g:i A"); @endphp
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-12 mb-3 form-group">
                                    <label for="" class="select-form">Evening</label>
                                    <select name="send_absent_sms_at_evening" class="form-control js-select">
                                        <option value="" selected>Select One</option>
                                        @for ($i = 0; $i < 13; $i++)
                                        <option value="{{$eveningShift}}" {{ (authUser()->send_absent_sms_at_evening == date("H:i:s", strtotime($eveningShift))) ? 'selected' : ''}} >{{$eveningShift}}</option>
                                        @php $eveningShift = \Carbon\Carbon::parse(date("H:i", strtotime($eveningShift)))->addMinutes(15)->format("g:i A"); @endphp
                                        @endfor
                                    </select>
                                </div>

                                @if (hasPermission("auto_attendance"))
                                    <button class="btn btn-primary">Save Changes</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Class for send absent SMS</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" method="POST" action="{{route('classSelect.absent.sms')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    @include('frontend.layouts.message')
                                </div>
                               
                                <div class="mb-3">
                                    <label for="" class="select-form">Select Class</label>
                                    <select name="classIds[]" class="js-select" multiple>
                                        @foreach (\App\Models\InstituteClass::where('school_id', authUser()->id)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->class_name}}</option>
                                        @endforeach
                                    </select>
                                    <small><strong>(Press control and select multiple classes)</strong></small>
                                </div>

                                <ul class="px-3">
                                    @if(isset(authUser()->class_for_absent_sms) && !is_null(authUser()->class_for_absent_sms) && !empty(authUser()->class_for_absent_sms))
                                        @php 
                                            $str = authUser()->class_for_absent_sms;
                                            $selectedClasses = explode(",", $str);
                                        @endphp
                                        
                                        @foreach ($selectedClasses as $item)
                                            <li>{{getClassName($item)?->class_name}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                @if (hasPermission("auto_attendance"))
                                    <button class="btn btn-primary">Save Changes</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </main>

@endsection