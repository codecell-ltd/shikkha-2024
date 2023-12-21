<?php

use App\Http\Controllers\CronjobController;
use App\Http\Controllers\Finance\AccessoriesController;
use App\Http\Controllers\Finance\CollectFeesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rams\RamsController;
use App\Http\Controllers\School\AttendanceController;
use App\Http\Controllers\School\DeviceController;
use App\Http\Controllers\School\FinanceController;


//print receipt
Route::any("fees-collection/receipt", [CollectFeesController::class, 'receipt'])->middleware("auth");
Route::post("update/device-conected-users", [AttendanceController::class, 'updateDeviceConnectedUserList'])->middleware("auth");

/** cronjob for attendance */
Route::get('cron-job/present', [CronjobController::class, 'callAttendance']);
Route::get('cron-job/absent', [CronjobController::class, 'sendAbsentSmsToPhone']);

/** ---------- attendance (SHAHIDUL)
 * =========================================================*/
Route::middleware(['auth', 'language'])
    ->group(function () {
        Route::get("school/attendance/auto/setting", [DeviceController::class, 'autoAttendanceSettings'])->name('auto.attendance');
        Route::post("school/attendance/auto/setting", [DeviceController::class, 'storeAutoAttendanceSettings'])->name('auto.attendance.save');
        Route::get("school/attendance/new/user", [DeviceController::class, 'addNewUserToDevice'])->name('new.user.fingerprint');

        Route::get("school/attendance/input", [AttendanceController::class, 'inputAttendance'])->name('input.attendance');
        Route::get("school/attendance/get-data", [AttendanceController::class, 'inputAttendanceGet'])->name('input.attendance.get');
        Route::get("school/attendance/get_term_data", [AttendanceController::class, 'inputAttendanceTermGet'])->name('input.attendance.term.get');
        Route::post("school/attendance/input", [AttendanceController::class, 'saveInputAttendance'])->name('input.attendance.save');

        Route::post("school/attendance/class/absent/sms", [AttendanceController::class, 'classSelectForAbsentSMS'])->name('classSelect.absent.sms');

        // accessories
        Route::get('accessories', [AccessoriesController::class, 'index'])->name('accessories.index');

    });

/** ========================= attendance ==================== */
