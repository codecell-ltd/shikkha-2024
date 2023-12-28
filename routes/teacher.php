<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')
->group(function () {
    Route::get('/', [\App\Http\Controllers\TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/class-room', [\App\Http\Controllers\TeacherController::class, 'myClassRoom'])->name('teacher.myClass.show');
    Route::get('/profile', [\App\Http\Controllers\TeacherController::class, 'profile'])->name('teacher.account.Information');
    Route::post('/profile/update/{id}', [\App\Http\Controllers\TeacherController::class, 'profileUpdate'])->name('teacher.account.update');
    Route::get('/vaccine', [\App\Http\Controllers\TeacherController::class, 'accountVaccine'])->name('teacher.account.vaccine');
    Route::post('/vaccine/update/{id}', [\App\Http\Controllers\TeacherController::class, 'vaccineUpdate'])->name('teacher.vaccine.update');
    Route::post('/change-password/{id}', [\App\Http\Controllers\TeacherController::class, 'changePassword'])->name('teacher.change password');
    Route::get('/online-class', [\App\Http\Controllers\TeacherController::class, 'onlineClass'])->name('teacher.online class');

    // Route::get('/result-upload/{subject_id}/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\TeacherController::class, 'resultUpload'])->name('teacher.result.upload');
    Route::get('/result-upload', [\App\Http\Controllers\TeacherController::class, 'resultUpload'])->name('teacher.result.upload');
    Route::post('/result/create/post', [\App\Http\Controllers\TeacherController::class, 'resultCreatePost'])->name('teacher.result.create.post');
    Route::get('/attendance/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\TeacherController::class, 'attendanceUpload'])->name('teacher.attendance.upload');
    Route::post('/attendance/post', [\App\Http\Controllers\TeacherController::class, 'attendanceCreatePost'])->name('teacher.attendance.create.post');
    Route::get('/assignment/{class_id}/{section_id}/{group_id}/{subject_id}', [\App\Http\Controllers\TeacherController::class, 'attendanceUploadShow'])->name('teacher.assignment.upload.show');
    Route::post('/post/assignment', [\App\Http\Controllers\TeacherController::class, 'assignmentUploadPost'])->name('post.teacher.assignment.upload');
    Route::get('/details/assignment/{id}', [\App\Http\Controllers\TeacherController::class, 'attendanceDetailsShow'])->name('details.teacher.assignment.show');
    Route::get('/teacher/student/show/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\TeacherController::class, 'studentShow'])->name('teacher.class.student.show');

    Route::get('/teacher/salary/info', [\App\Http\Controllers\TeacherController::class, 'salaryShow'])->name('teacher.panel.salary.show');


    Route::get('/attendance/show', [\App\Http\Controllers\TeacherController::class, 'teacherAttendanceShow'])->name('all.teachers.attendance.show');
    Route::get('/attendance/show/class/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\TeacherController::class, 'classAttendanceShow'])->name('allAttendance.show.all.teacher');
    Route::get('/result/show', [\App\Http\Controllers\TeacherController::class, 'teacherResultShow'])->name('all.teachers.result.show');
    Route::get('/result/easy/show', [\App\Http\Controllers\TeacherController::class, 'teacherShow'])->name('teacher.attendance.show');

    Route::get('/result/show/class/{subject_id}', [\App\Http\Controllers\TeacherController::class, 'teacherResultDataShow'])->name('allResult.show.all.teacher');



    Route::get('/student/show', [\App\Http\Controllers\TeacherController::class, 'teacherStudentShow'])->name('all.teachers.student.show');
    Route::get('/student/show/class/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\TeacherController::class, 'classStudentShow'])->name('allStudent.show.all.teacher');

    Route::get('/assignment/show', [\App\Http\Controllers\TeacherController::class, 'assignmentStudentShow'])->name('all.assignment.student.show');
    Route::post('/status/update/{id}', [\App\Http\Controllers\TeacherController::class, 'statusUpdateAssignment'])->name('status.update.assignment');

    Route::get('/Routine/show', [\App\Http\Controllers\TeacherController::class, 'teacherRoutineShow'])->name('all.teachers.routine.show');

    Route::post('/confirm/absent/present/{id}', [App\Http\Controllers\TeacherController::class, 'confirmAbsentPresent'])->name('teacher.confirm.absent.present');
    Route::post('/to-do-list/show', [\App\Http\Controllers\TeacherController::class, 'toDolistAdd'])->name('add.todolist.teacher');
    Route::get('/todolist/delete/{key}', [\App\Http\Controllers\TeacherController::class, 'tododestroy'])->name('todolist.delete');
    Route::get('result/create/show/all', [App\Http\Controllers\SchoolController::class, 'resultCreateShow'])->name('result.teacher.create.show.all');
});


// Route::group(['middleware' => 'auth'], function () {
//     //School Permission Route Sajjad
//     Route::group(['middleware' => 'permission'], function () {
//         Route::prefix('student')->group(function () {
//             Route::get('result/create/show/all', [App\Http\Controllers\SchoolController::class, 'resultCreateShow'])->name('result.teacher.create.show.all');
//         });
//     });
//     //School Permission Route Sajjad
// });