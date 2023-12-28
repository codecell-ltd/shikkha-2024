<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/teachers',   [\App\Http\Controllers\webController::class, 'showSchoolTeacherAccount']);
Route::get('/notice/header',   [\App\Http\Controllers\webController::class, 'showSchoolNoticeHeader']);
Route::get('/notice',   [\App\Http\Controllers\webController::class, 'showSchoolNotice']);
Route::get('/class',   [\App\Http\Controllers\webController::class, 'showSchoolClass']);
Route::get('/students',   [\App\Http\Controllers\webController::class, 'showSchoolstudents']);
Route::get('/about',   [\App\Http\Controllers\webController::class, 'showSchoolAbout']);
Route::get('/web/blog',   [\App\Http\Controllers\webController::class, 'showSchoolWebBlog']);
Route::get('/slider',   [\App\Http\Controllers\webController::class, 'showSchoolSlider']);
Route::get('/gellary',   [\App\Http\Controllers\webController::class, 'showSchoolGellary']);
Route::get('/home', [\App\Http\Controllers\webController::class, 'showHomePage']);




