@extends('layouts.school.master')

@section('content')
<!--start content-->
<main class="page-content">

    <div class="row">
        <div class="col">

            <div class="card">

                <div style="background-color:#ae12e2; color:white;" class="card-header">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ asset($school->school_logo) }}" width="120" class="rounded-circle shadow-8-strong" style="margin-left:50px; margin-top:10px; margin-bottom:8px;" alt="">
                        </div>
                        <div class="col-lg-10 mt-4">
                            @if (app()->getLocale() === 'en')
                            <center>
                                <h3 styleS="margin-top:40px;font-size:40px">{{ $school->school_name }}</h3>
                            </center>
                            @else
                            <center>
                                <h3 style="margin-top:40px;font-size:40px">{{ $school->school_name_bn }}</h3>
                            </center>
                            @endif
                            @if (app()->getLocale() === 'en')
                            <center>
                                <p style="margin-top:5px;font-size:15px">{{ $school->slogan }}</p>
                            </center>
                            @else
                            <center>
                                <p style="margin-top:5px;font-size:15px">{{ $school->slogan_bn }}</p>
                            </center>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-body" style="margin-top:20px ; padding-bottom:30px">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped ">
                                <tbody>
                                    <tr>
                                        <th>School Name</th>
                                        <td>{{ $school->school_name }}</td>
                                    </tr>
                                    <th>School Name In Bangla</th>
                                    <td>{{ $school->school_name_bn ? $school->school_name_bn : '' }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>School User Name</th>
                                        <td>{{$school->user_name ? $school->user_name : ''}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>School Slogan</th>
                                        <td>{{ $school->slogan }}</td>
                                    </tr>
                                    <th>School Slogan In Bangla</th>
                                    <td>{{ $school->slogan_bn ? $school->slogan_bn : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ein Number</th>
                                        <td>{{ $school->ein_number }}</td>
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
                                        <th>Number of Student</th>
                                        <td>1234</td>
                                    </tr>
                                    <tr>
                                        <th>Teacher</th>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <th>Staff</th>
                                        <td>23</td>
                                    </tr>
                                    <tr>
                                        <th>Change Password</th>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$school->id}}">Chande Password</a>
                                        </td>
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
                                        <td> {{ $school->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address In Bangla</th>
                                        <td> {{ $school->address_bn ? $school->address_bn : "" }}</td>
                                    </tr>

                                    <tr>
                                        <th>Edit Profile</th>
                                        <td><a href="{{ route('school.profileEdit', $school->id) }}" class="btn btn-primary btn-sm" title="{{__('app.Edit')}}"><i class="bi bi-pencil-square"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th>Head Teacher Signature</th>
                                        <td> <img src="{{ asset($school->signature) }}" width="120" height="120" class="" style="margin-left:50px; margin-top:10px; margin-bottom:8px;" alt="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>






<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$school->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <form action="{{ route('school.Password',$school->id) }}" method="post">
                    @csrf
                    <input type="hidden" id="id" value="{{ $school->id }}">
                    <div class="modal-body">
                        <div class="errmsgcontainer mb-3">

                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">{{ __('app.sign5') }}</label>
                            <input type="password" name="password" required class="form-control" id="password" placeholder="{{ __('app.sign5') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="col-form-label">{{ __('app.confirm') }}
                                {{ __('app.sign5') }}</label>
                            <input type="password" name="password_confirmation" required class="form-control" id="password_confirmation" placeholder="{{ __('app.confirm') }} {{ __('app.sign5') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{ __('app.close') }}</button>
                        <button type="submit" class="btn btn-primary btn-sm add_btn">{{ __('app.Save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@endpush