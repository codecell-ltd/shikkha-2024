@extends('layouts.school.master')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@endpush
@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="row">
            <form action="{{ route('permission.update', $permission->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8 mx-auto">
    
                    <div class="col-md-12">
                        @include('frontend.layouts.message')
                    </div>
    
                    <h3 class="text-center mt-3 mb-3 text-primary">Select Role and Teacher</h3>
                    <div class="card " style="box-shadow:4px 3px 13px  .13px #bf52f2;border-radius:5px">
                        <div class="card-head">
                            
                        </div>
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <div class="row">
                                    <div class="col-md-6 mt-4">
                                        <label class="select-form">{{__('app.role_name')}}</label>
                                        <select class="form-select js-select" aria-label="Default select example" required name="role_name">
                                            <option value="" ></option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{ $role->id == $permission->role_id ? "selected" : "" }}>{{$role->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="col-md-6 mt-4">
                                        <label class="select-form">{{ "Teacher Name"}}</label>
                                        <select class="form-select js-select" aria-label="Default select example" required name="teacher_name">
                                            <option value="" ></option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}" {{ $teacher->id == $permission->teacher_id ? "selected" : "" }}>{{$teacher->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-12 mx-auto">
                    <div class="card " style="box-shadow:4px 3px 13px  .13px #bf52f2;border-radius:5px">
                        <div class="card-head">
                            
                        </div>
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <div class="">
                                    <table class="table table-bordered table-responsive table-primary">
                                        <thead>
                                            <tr>
                                                <th>Permission</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                                <th>List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Class</td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][add]" {{ isset($permission['permission']['class']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][edit]" {{ isset($permission['permission']['class']['edit']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][view]" {{ isset($permission['permission']['class']['view']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][delete]" {{ isset($permission['permission']['class']['delete']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][list]" {{ isset($permission['permission']['class']['list']) ? "checked" : "" }} value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Student</td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][add]" {{ isset($permission['permission']['student']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][edit]" {{ isset($permission['permission']['student']['edit']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][view]" {{ isset($permission['permission']['student']['view']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][delete]" {{ isset($permission['permission']['student']['delete']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][list]" {{ isset($permission['permission']['student']['list']) ? "checked" : "" }}  value="1">
                                                </td>
                                            </tr>
                                            
                                            <tr>    
                                                <td>Attendance</td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][add]" {{ isset($permission['permission']['attendance']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][edit]" {{ isset($permission['permission']['attendance']['edit']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][view]" {{ isset($permission['permission']['attendance']['view']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][delete]" {{ isset($permission['permission']['attendance']['delete']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][list]" {{ isset($permission['permission']['attendance']['list']) ? "checked" : "" }} value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Finance</td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][add]" {{ isset($permission['permission']['finance']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][edit]" {{ isset($permission['permission']['finance']['edit']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][view]" {{ isset($permission['permission']['finance']['view']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][delete]" {{ isset($permission['permission']['finance']['delete']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][list]" {{ isset($permission['permission']['finance']['list']) ? "checked" : "" }} value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Exam</td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][add]" {{ isset($permission['permission']['exam']['add']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][edit]" {{ isset($permission['permission']['exam']['edit']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][view]" {{ isset($permission['permission']['exam']['view']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][delete]" {{ isset($permission['permission']['exam']['delete']) ? "checked" : "" }}  value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][list]" {{ isset($permission['permission']['exam']['list']) ? "checked" : "" }}  value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Result</td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][add]" {{ isset($permission['permission']['result']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][edit]" {{ isset($permission['permission']['result']['edit']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][view]" {{ isset($permission['permission']['result']['view']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][delete]" {{ isset($permission['permission']['result']['delete']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][list]" {{ isset($permission['permission']['result']['list']) ? "checked" : "" }} value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Library</td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][add]" {{ isset($permission['permission']['library']['add']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][edit]" {{ isset($permission['permission']['library']['edit']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][view]" {{ isset($permission['permission']['library']['view']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][delete]" {{ isset($permission['permission']['library']['delete']) ? "checked" : "" }} value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][list]" {{ isset($permission['permission']['library']['list']) ? "checked" : "" }} value="1">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                    <div class="form-group">
                                        <input class="form-control btn btn-outline-primary" type="submit" value="Update Role Permission">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end row-->
    </main>

    <?php
    $tutorialShow = getTutorial('student-attendance-show');
    ?>
    @include('frontend.partials.tutorial')

@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
      
    </script>
@endpush
