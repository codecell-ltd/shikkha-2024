<form action="{{route("permission.store", $role_id)}}" method="POST">
    @csrf
    <div class="card-body" style="background-color: white !important;color:white">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-dashboard-list" data-bs-toggle="list" href="#list-dashboard" role="tab" aria-controls="list-dashboard"><i class="bi bi-buildings-fill"></i>   School Dashboard </a>
                    <a class="list-group-item list-group-item-action" id="list-class-list" data-bs-toggle="list" href="#list-class" role="tab" aria-controls="list-class"><i class="bi bi-people-fill"></i>   Class</a>
                    <a class="list-group-item list-group-item-action" id="list-student-list" data-bs-toggle="list" href="#list-student" role="tab" aria-controls="list-student"><i class="bi bi-mortarboard-fill"></i> Student</a>
                    <a class="list-group-item list-group-item-action" id="list-teacher-list" data-bs-toggle="list" href="#list-teacher" role="tab" aria-controls="list-teacher"><i class="bi bi-person-vcard-fill"></i> Teacher</a>
                    <a class="list-group-item list-group-item-action" id="list-staff-list" data-bs-toggle="list" href="#list-staff" role="tab" aria-controls="list-staff"><i class="bi bi-person-gear"></i> Staff</a>
                    <a class="list-group-item list-group-item-action" id="list-attendance-list" data-bs-toggle="list" href="#list-attendance" role="tab" aria-controls="list-attendance"><i class="bi bi-blockquote-right"></i> Attendance</a>
                    <a class="list-group-item list-group-item-action" id="list-finance-list" data-bs-toggle="list" href="#list-finance" role="tab" aria-controls="list-finance"><i class="bi bi-currency-dollar"></i> Finance</a>
                    <a class="list-group-item list-group-item-action" id="list-sms-list" data-bs-toggle="list" href="#list-sms" role="tab" aria-controls="list-sms"> <i class="bi bi-chat-left-fill"></i> SMS</a>
                    <a class="list-group-item list-group-item-action" id="list-exam-list" data-bs-toggle="list" href="#list-exam" role="tab" aria-controls="list-exam"><i class="bi bi-bookmarks"></i> Exam</a>
                    <a class="list-group-item list-group-item-action" id="list-result-list" data-bs-toggle="list" href="#list-result" role="tab" aria-controls="list-result"><i class="bi bi-journal-check"></i> Result</a>
                    <a class="list-group-item list-group-item-action" id="list-notice-list" data-bs-toggle="list" href="#list-notice" role="tab" aria-controls="list-notice"><i class="bi bi-bell-fill"></i> Notice</a>
                    <a class="list-group-item list-group-item-action" id="list-role-list" data-bs-toggle="list" href="#list-role" role="tab" aria-controls="list-role"> <i class="bi bi-gear-fill"></i> Role</a>
                    <a class="list-group-item list-group-item-action" id="list-library-list" data-bs-toggle="list" href="#list-library" role="tab" aria-controls="list-library"><i class="bi bi-bookshelf"></i> Library</a>
                    <a class="list-group-item list-group-item-action" id="list-addon-list" data-bs-toggle="list" href="#list-addon" role="tab" aria-controls="list-addon"><i class="bi bi-box"></i> Addon</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="list-dashboard" role="tabpanel" aria-labelledby="list-dashboard-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Dashboard</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dashboard Show</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Dashboard Show')}}" @if(hasPermission('Dashboard Show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Admission Request</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('admission_request_show')}}" @if(hasPermission('admission_request_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('admission_request_delete')}}" @if(hasPermission('admission_request_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-class" role="tabpanel" aria-labelledby="list-class-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    {{-- Start Class Section --}}
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Class</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('class_show')}}" @if(hasPermission('class_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('class_create')}}" @if(hasPermission('class_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('class_edit')}}" @if(hasPermission('class_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('class_delete')}}" @if(hasPermission('class_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Section</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Section_show')}}" @if(hasPermission('Section_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Section_Create')}}" @if(hasPermission('Section_Create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('section_edit')}}" @if(hasPermission('section_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Section_delete')}}" @if(hasPermission('Section_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('subject_show')}}" @if(hasPermission('subject_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('subject_create')}}" @if(hasPermission('subject_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('subject_edit')}}" @if(hasPermission('subject_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('subject_delete')}}" @if(hasPermission('subject_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Syllabus</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('syllabus_show')}}" @if(hasPermission('syllabus_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('syllabus_create')}}" @if(hasPermission('syllabus_create', $role_id)) checked @endif />
    
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('syllabus_edit')}}" @if(hasPermission('syllabus_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('syllabus_delete')}}" @if(hasPermission('syllabus_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Period</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('period_show')}}" @if(hasPermission('period_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('period_create')}}" @if(hasPermission('period_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('period_edit')}}" @if(hasPermission('period_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('period_delete')}}" @if(hasPermission('period_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Routine</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Routine Show')}}" @if(hasPermission('routine_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Routine Create')}}" @if(hasPermission('routine_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Routine Edit')}}" @if(hasPermission('routine_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Routine Delete')}}" @if(hasPermission('routine_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-student" role="tabpanel" aria-labelledby="list-student-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Student</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_show')}}" @if(hasPermission('student_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_create')}}" @if(hasPermission('student_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_edit')}}" @if(hasPermission('student_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_delete')}}" @if(hasPermission('student_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-teacher" role="tabpanel" aria-labelledby="list-teacher-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Teacher</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_show')}}" @if(hasPermission('teacher_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_create')}}" @if(hasPermission('teacher_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_edit')}}" @if(hasPermission('teacher_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_delete')}}" @if(hasPermission('teacher_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>Assign Class Teacher</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('assign_teacher_show')}}" @if(hasPermission('assign_teacher_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('assign_teacher_create')}}" @if(hasPermission('assign_teacher_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('assign_teacher_delete')}}" @if(hasPermission('assign_teacher_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-staff" role="tabpanel" aria-labelledby="list-staff-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    {{-- Start Staff Section --}}
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Staff</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_list_show')}}" @if(hasPermission('staff_list_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_list_create')}}" @if(hasPermission('staff_list_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_list_edit')}}" @if(hasPermission('staff_list_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_list_delete')}}" @if(hasPermission('staff_list_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff Type</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_type_show')}}" @if(hasPermission('staff_type_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_type_create')}}" @if(hasPermission('staff_type_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_type_edit')}}" @if(hasPermission('staff_type_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_type_delete')}}" @if(hasPermission('staff_type_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-attendance" role="tabpanel" aria-labelledby="list-attendance-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Attendance</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Student Dashboard</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_attendance_dashboard')}}" @if(hasPermission('student_attendance_dashboard', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attendance Report</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('attendance_report_show')}}" @if(hasPermission('attendance_report_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Take Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('attendance_take_show')}}" @if(hasPermission('attendance_take_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('attendance_take_create')}}" @if(hasPermission('attendance_take_create', $role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>View Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('view_attendance_show')}}" @if(hasPermission('view_attendance_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attendance Upload</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Upload_attendance')}}" @if(hasPermission('Upload_attendance', $role_id)) checked @endif />
                                                <label for="">Upload</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Get Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('get_attendance')}}" @if(hasPermission('get_attendance', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Custom Attendance Input</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('custom_attendance_show')}}" @if(hasPermission('custom_attendance_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('custom_attendance_edit')}}" @if(hasPermission('custom_attendance_edit', $role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Auto Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('auto_attendance')}}" @if(hasPermission('auto_attendance', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
    
                                    </tr>
    
                                    <tr>
                                        <td> Teacher Dashboard</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Teaccher Attendance Dashboard')}}" @if(hasPermission('Teacher Attendance Dashboard', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Teacher Take Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_attendance_take_create')}}" @if(hasPermission('teacher_attendance_take_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_attendance_take_edit')}}" @if(hasPermission('teacher_attendance_take_edit', $role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher View Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_view_attendance')}}" @if(hasPermission('teacher_view_attendance', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>Staff Take Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_attendance_take_create')}}" @if(hasPermission('staff_attendance_take_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_attendance_take_edit')}}" @if(hasPermission('staff_attendance_take_edit', $role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff View Attendance</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_view_attendance')}}" @if(hasPermission('staff_view_attendance', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-finance" role="tabpanel" aria-labelledby="list-finance-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Finance</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Finance Dashboard</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_dashboard')}}" @if(hasPermission('finance_dashboard', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>School Fees</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_school_fees_show')}}" @if(hasPermission('finance_school_fees_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_school_fees_create')}}" @if(hasPermission('finance_school_fees_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_school_fees_edit')}}" @if(hasPermission('finance_school_fees_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_school_fees_delete')}}" @if(hasPermission('finance_school_fees_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Assign Fees</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_assign_fees_show')}}" @if(hasPermission('finance_assign_fees_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_assign_fees_create')}}" @if(hasPermission('finance_assign_fees_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_assign_fees_edit')}}" @if(hasPermission('finance_assign_fees_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_assign_fees_delete')}}" @if(hasPermission('finance_assign_fees_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Collect Fees</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_collect_fees_show')}}" @if(hasPermission('finance_collect_fees_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_collect_fees_create')}}" @if(hasPermission('finance_collect_fees_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_collect_fees_edit')}}" @if(hasPermission('finance_collect_fees_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('finance_collect_fees_delete')}}" @if(hasPermission('finance_collect_fees_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher Salary</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_salary_show')}}" @if(hasPermission('teacher_salary_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_salary_edit')}}" @if(hasPermission('teacher_salary_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff Salary</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_salary_show')}}" @if(hasPermission('staff_salary_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_salary_edit')}}" @if(hasPermission('staff_salary_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bank Account</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('bank_account_show')}}" @if(hasPermission('bank_account_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('bank_account_create')}}" @if(hasPermission('bank_account_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('bank_account_edit')}}" @if(hasPermission('bank_account_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('bank_account_delete')}}" @if(hasPermission('bank_account_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Expence</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Expense Show')}}" @if(hasPermission('Expense Show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Expense Create')}}" @if(hasPermission('Expense Create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Expense Edit')}}" @if(hasPermission('Expense Edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Expense Delete')}}" @if(hasPermission('Expense Delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Expence List</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('Expense List Show')}}" @if(hasPermission('Expense List Show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Fund</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('fund_show')}}" @if(hasPermission('fund_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('fund_create')}}" @if(hasPermission('fund_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('fund_edit')}}" @if(hasPermission('fund_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('fund_delete')}}" @if(hasPermission('fund_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fund List</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('fund_list_show')}}" @if(hasPermission('fund_list_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Accesories</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('accesories_show')}}" @if(hasPermission('accesories_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('accesories_create')}}" @if(hasPermission('accesories_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
    
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('accesories_edit')}}" @if(hasPermission('accesories_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('accesories_delete')}}" @if(hasPermission('accesories_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Accesories Collect Fees</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('accesories_collect_fees')}}" @if(hasPermission('accesories_collect_fees', $role_id)) checked @endif />
                                                <label for="">Collcet</label>
    
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Student Finance Status</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_finance_status_show')}}" @if(hasPermission('student_finance_status_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-sms" role="tabpanel" aria-labelledby="list-sms-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>SMS</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student SMS</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('student_sms_send')}}" @if(hasPermission('student_sms_send', $role_id)) checked @endif />
                                                <label for="">Send</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Teacher SMS</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('teacher_sms_send')}}" @if(hasPermission('teacher_sms_send', $role_id)) checked @endif />
                                                <label for="">Send</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Staff SMS</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('staff_sms_send')}}" @if(hasPermission('staff_sms_send', $role_id)) checked @endif />
                                                <label for="">Send</label>
                                            </div>
                                        </td>
    
                                    </tr>
                                    <tr>
                                        <td>Result SMS</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_sms_send')}}" @if(hasPermission('result_sms_send', $role_id)) checked @endif />
                                                <label for="">Send</label>
                                            </div>
                                        </td>
    
                                    </tr>
    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-exam" role="tabpanel" aria-labelledby="list-exam-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Exam</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Exam Term</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_term_show')}}" @if(hasPermission('exam_term_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_term_create')}}" @if(hasPermission('exam_term_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_term_edit')}}" @if(hasPermission('exam_term_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_term_delete')}}" @if(hasPermission('exam_term_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Exam Routine</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_routine_show')}}" @if(hasPermission('exam_routine_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_routine_create')}}" @if(hasPermission('exam_routine_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_routine_edit')}}" @if(hasPermission('exam_routine_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('exam_routine_delete')}}" @if(hasPermission('exam_routine_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Question Term</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('question_show')}}" @if(hasPermission('question_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('question_create')}}" @if(hasPermission('question_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('question_edit')}}" @if(hasPermission('question_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('question_delete')}}" @if(hasPermission('question_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Admit Card</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('admit_card_show')}}" @if(hasPermission('admit_card_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sit Plan</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('sit_plan_show')}}" @if(hasPermission('sit_plan_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-result" role="tabpanel" aria-labelledby="list-result-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Result</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Result Upload</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_upload_show')}}" @if(hasPermission('result_upload_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_upload_create')}}" @if(hasPermission('result_upload_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_upload_edit')}}" @if(hasPermission('result_upload_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_upload_delete')}}" @if(hasPermission('result_upload_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>See Result</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('see_result')}}" @if(hasPermission('see_result', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Result PDF</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('result_pdf')}}" @if(hasPermission('result_pdf', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-notice" role="tabpanel" aria-labelledby="list-notice-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Notice</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Notice</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('notice_show')}}" @if(hasPermission('notice_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('notice_create')}}" @if(hasPermission('notice_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('notice_edit')}}" @if(hasPermission('notice_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('notice_delete')}}" @if(hasPermission('notice_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-role" role="tabpanel" aria-labelledby="list-role-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Role</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role Management</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('role_show')}}" @if(hasPermission('role_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('role_create')}}" @if(hasPermission('role_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('role_edit')}}" @if(hasPermission('role_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('role_delete')}}" @if(hasPermission('role_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-library" role="tabpanel" aria-labelledby="list-library-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Library</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Borrower Info</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('borrower_info_show')}}" @if(hasPermission('borrower_info_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('borrower_info_create')}}" @if(hasPermission('borrower_info_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('borrower_info_edit')}}" @if(hasPermission('borrower_info_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('borrower_info_delete')}}" @if(hasPermission('borrower_info_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Book Type</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_type_show')}}" @if(hasPermission('book_type_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_type_create')}}" @if(hasPermission('book_type_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_type_edit')}}" @if(hasPermission('book_type_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_type_delete')}}" @if(hasPermission('book_type_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Book List</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_list_show')}}" @if(hasPermission('book_list_show', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_list_create')}}" @if(hasPermission('book_list_create', $role_id)) checked @endif />
                                                <label for="">Create</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_list_edit')}}" @if(hasPermission('book_list_edit',$role_id)) checked @endif />
                                                <label for="">Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('book_list_delete')}}" @if(hasPermission('book_list_delete', $role_id)) checked @endif />
                                                <label for="">Delete</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="list-addon" role="tabpanel" aria-labelledby="list-addon-list">
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>
                                    <tr>
                                        <td colspan="5">
                                            <center><b>Addon Purchase</b></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Addon Purchase</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{permissionId('addon_purchase')}}" @if(hasPermission('addon_purchase', $role_id)) checked @endif />
                                                <label for="">Show</label>
                                            </div>
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
       
    </div> 
    
    
    <div class="d-flex justify-content-end" style="margin-right: 20px;">
        <button class="btn-sm btn-grey" > <i class="bi bi-floppy2 me-1"></i> Save Changes</button>
    </div>
   

</form>
