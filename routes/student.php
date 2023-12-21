<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/online-class/{id}', [\App\Http\Controllers\UserController::class, 'onlineClass'])->name('user.online class');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.account.Information');
    Route::get('/vaccine', [\App\Http\Controllers\UserController::class, 'accountVaccine'])->name('user.account.vaccine');
    Route::post('/vaccine/update/{id}', [\App\Http\Controllers\UserController::class, 'vaccineUpdate'])->name('user.vaccine.update');
    Route::get('/notice', [\App\Http\Controllers\UserController::class, 'notice'])->name('user.account.notice');
    Route::post('/profile/update/{id}', [\App\Http\Controllers\UserController::class, 'profileUpdate'])->name('user.account.update');
    Route::post('/change-password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('user.change password');

    Route::get('/show/assignment/all/{subject_id}/{tearcher_id}', [\App\Http\Controllers\UserController::class, 'assignmentAll'])->name('show.all.assignment');
    Route::get('/assignment/all/{subject_id}', [\App\Http\Controllers\UserController::class, 'getAssignmentBySubject'])->name('all.assignment');
    Route::get('/user/upload/assignment/all/{id}', [\App\Http\Controllers\UserController::class, 'userUploadAssignment'])->name('user.upload.assignment');
    Route::get('/user/assignment/file/{id}', [UserController::class, 'userAssignmentFile'])->name('user.assignment.file');
    Route::post('/upload/assignment', [\App\Http\Controllers\UserController::class, 'userTeacherUploadAssignment'])->name('user.teacher.assignment.upload');
    Route::get('/student/fee/info', [\App\Http\Controllers\UserController::class, 'FeesShow'])->name('student.panel.salary.show');

    Route::get('/attendance', [\App\Http\Controllers\UserController::class, 'attendanceUserShow'])->name('user.attendance.show');
    Route::get('/attendance/show/class/{class_id}/{section_id}/{group_id}', [\App\Http\Controllers\UserController::class, 'classAttendanceShow'])->name('allAttendance.show.all.user');
    Route::get('/subject/show', [\App\Http\Controllers\UserController::class, 'allSubjectShow'])->name('allSubject.show.all.user');
    Route::get('/result/show', [\App\Http\Controllers\UserController::class, 'allResultShow'])->name('allResult.show.all.user');
    
    // DevelSajjad
    Route::get('/notice/show', [UserController::class, 'showNotice'])->name('user.show.notice');
    Route::get('/routine/show', [UserController::class, 'showRoutine'])->name('student.show.routine');
    Route::get('/show/payment', [UserController::class, 'showPayment'])->name('show.student.payment');
    Route::get('/school/finance/student/{sid}/{month?}/fee', [UserController::class, 'findStudent'])->name('find.student.fee');
    Route::get('/student/profile', [UserController::class, 'student_profile'])->name('student.profile');
});