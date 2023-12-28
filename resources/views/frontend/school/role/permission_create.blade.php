@extends('layouts.school.master')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush
@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="row">
            <form action="{{ route('permission.store') }}" method="post" enctype="multipart/form-data">
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
                                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="col-md-6 mt-4">
                                        <label class="select-form">{{ "Teacher Name"}}</label>
                                        <select class="form-select js-select" aria-label="Default select example" id="chkveg" multiple required name="teacher_name[]">
                                            <option value="" ></option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->full_name}}</option>
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
                                                    <input type="checkbox" name="permission[class][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[class][list]" value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Student</td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[student][list]" value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Attendance</td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[attendance][list]" value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Finance</td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[finance][list]" value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Exam</td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[exam][list]" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Result</td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[result][list]" value="1">
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <td>Library</td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][add]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][edit]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][view]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][delete]" value="1">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="permission[library][list]" value="1">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                    <div class="form-group">
                                        <input class="form-control btn btn-outline-primary" type="submit" value="Add Role Permission">
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

@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
      
    </script>
@endpush
