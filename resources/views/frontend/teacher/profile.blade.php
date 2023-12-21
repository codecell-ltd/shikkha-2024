@extends('layouts.school.master')

@section('content')

<main class="page-content">

    {{-- <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3 text-white">Pages</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt text-white"></i></a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Teacher Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="profile-cover bg-dark"></div> --}}

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5 class="mb-0">Teacher INFORMATION</h5>
                    <hr>

                    {{-- Start Teacher Info --}}

                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <hr style="width:100%;text-align:left;margin-left:0;margin-bottom:0;height:5px;background-color:#7c00a7">

                            <div class="card">


                                <table class="table table-hover table-bordered">

                                    <tbody>

                                        <tr>
                                            <td>Teacher ID</td>
                                            {{-- <td>{{ __('app.Teacher') }} {{ __('app.ID') }}</td> --}}
                                            <td>{{ $teacher->unique_id }} </td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            {{-- <td>{{ __('app.Name') }}</td> --}}
                                            <td>{{ $teacher->full_name }} </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            {{-- <td>{{ __('app.Email') }} </td> --}}
                                            <td>{{$teacher->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            {{-- <td>{{ __('app.PhoneNumber') }} </td> --}}
                                            <td>{{$teacher->phone }}</td>
                                        </tr>

                                        <tr>
                                            {{-- <td>{{ __('app.Gender') }} </td> --}}
                                            <td>Gender</td>
                                            <td>{{$teacher->gender ?? 'Male'}}</td>
                                        </tr>
                                        <tr>
                                            {{-- <td>{{ __('app.Blood') }} {{ __('app.Group') }} </td> --}}
                                            <td>Blood Group</td>
                                            <td>{{$teacher->blood_group }}</td>
                                        </tr>
                                        <tr>
                                            {{-- <td>{{ __('app.Nationality') }} </td> --}}
                                            <td>Nationality </td>
                                            <td>{{$teacher->Nationality ?? 'Bangladeshi' }}</td>
                                        </tr>
                                        <tr>
                                            {{-- <td>{{ __('app.sign4') }} </td> --}}
                                            <td>Address </td>
                                            <td>{{$teacher->address }}</td>
                                        </tr>

                                        <tr>
                                            {{-- <td>{{ __('app.Marital') }} </td> --}}
                                            <td>Marital Status </td>
                                            <td>{{$teacher->M_status ?? 'Unmarried' }}</td>
                                        </tr>

                                        <tr>
                                            {{-- <td>{{ __('app.Designation') }} </td> --}}
                                            <td>Designation </td>
                                            <td>{{$teacher->designation }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shift </td>
                                            {{-- <td>{{ __('app.Shift') }} </td> --}}
                                            <td>{{$teacher->shift }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    {{-- End Teacher Info --}}

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="{{ asset(authUser()->teacher->image ?? 'd/no-img.jpg') }}" class="rounded-circle shadow" width="120" height="120" alt="">
                    </div>

                    <div class="text-center mt-4">
                        {{-- <p class="mb-0 text-secondary">dhaka, Bangladesh</p> --}}
                        <div class="mt-4"></div>
                        <h6 class="mb-1">{{$teacher->full_name}}</h6>
                        {{-- <p class="mb-0 text-secondary">{{$teacher->designation }} Of {{getSchoolDataUser($teacher->school_id)->school_name}}</p>
                        --}}
                    </div>
                    <hr>
                    <div class="text-start d-flex justify-content-center">

                        <button class="btn btn-primary btn-sm mb-3" data-bs-target="#editProfile{{$teacher->id}}" data-bs-toggle="modal">Edit Profile</button>&nbsp;
                        <button class="btn btn-primary btn-sm mb-3" da data-bs-target="#staticBackdrop{{$teacher->id}}" data-bs-toggle="modal">Change Password</button>
                        {{-- <button class="btn btn-primary btn-sm mb-3" data-bs-target="#addModal" data-bs-toggle="modal">{{ __('app.Change') }} {{ __('app.sign5') }}</button> --}}
                    </div>

                    <!-- Modal For Edit Profile-->

                    <div class="modal fade" id="editProfile{{$teacher->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #7c00a7">
                                    <h5 class="modal-title text-white" id="exampleModalLabel"> Edit Teacher Informathon</h5>
                                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <form class="row g-3" action="{{route('teacher.account.update',$teacher->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @include('layouts.teacher.message')

                                            <input type="hidden" class="form-control" name="shift" value="{{$teacher->shift}}">
                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" value="{{$teacher->full_name}}" name="full_name">
                                            </div>
                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Email address</label>
                                                <input type="text" class="form-control" name="email" value="{{$teacher->email}}">
                                            </div>
                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{$teacher->phone}}">
                                            </div>

                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Gender</label>
                                                <select class="form-control" class="form-control" name="gender">
                                                    <option value="Male" {{ (authUser()->teacher->gender == 'Male')  ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ (authUser()->teacher->gender == 'Female')  ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Nationality</label>
                                                <input type="text" class="form-control" name="Nationality" value="{{$teacher->Nationality }}">
                                            </div>

                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Blood Group</label>
                                                <select class="form-control" name="blood_group">
                                                    <option value="A+" {{ (authUser()->teacher->blood_group == 'A+')  ? 'selected' : '' }}>A+</option>
                                                    <option value="A-" {{ (authUser()->teacher->blood_group == 'A-')  ? 'selected' : '' }}>A-</option>
                                                    <option value="B+" {{ (authUser()->teacher->blood_group == 'B+')  ? 'selected' : '' }}>B+</option>
                                                    <option value="B-" {{ (authUser()->teacher->blood_group == 'B-')  ? 'selected' : '' }}>B-</option>
                                                    <option value="O+" {{ (authUser()->teacher->blood_group == 'O+')  ? 'selected' : '' }}>O+</option>
                                                    <option value="O-" {{ (authUser()->teacher->blood_group == 'O-')  ? 'selected' : '' }}>O-</option>
                                                    <option value="AB+" {{ (authUser()->teacher->blood_group == 'AB+')  ? 'selected' : '' }}>AB+</option>
                                                    <option value="AB-" {{ (authUser()->teacher->blood_group == 'AB-')  ? 'selected' : '' }}>AB-</option>
                                                </select>
                                            </div>

                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Marital Status</label>
                                                <select class="form-control" value="" name="M_status" type="text" id="" value="{{$teacher->M_status }}" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Married" {{ (authUser()->teacher->M_status == 'Married')  ? 'selected' : '' }}>Married</option>
                                                    <option value="Unmarried" {{ (authUser()->teacher->M_status == 'Unmarried')  ? 'selected' : '' }}>Unmarried</option>
                                                </select>
                                            </div>

                                       


                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" value="{{ old('image') }}"placeholder="Image" accept="image/*">
                                                <img width="120px" src="{{ asset($teacher->image) }}" alt="">

                                            </div>

                                            <div class="col-6" style="padding: 7px;">
                                                <label class="form-label">Address</label>
                                                <textarea type="text" class="form-control" name="address">{{$teacher->address}}</textarea>
                                            </div>
                                       
                                    <div class="text-start text-center">
                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- End Modal for Edit Profile --}}

                <!-- Modal For Change Password-->

                <div class="modal fade" id="staticBackdrop{{$teacher->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <form action="{{ route('teacher.change password',$teacher->id) }}" method="post">
                                    @csrf

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

            {{-- End Modal for cahange Password --}}

        </div>
    </div>
    </div>
    </div>

    <!--end row-->

</main>

@endsection