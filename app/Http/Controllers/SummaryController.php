<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Summary;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TeacherAttendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SummaryController extends Controller
{
  

    public function summaryMail(Request $request, $id)
    {
        $now = now();

        $monthYear = Carbon::now()->format('F Y');

        $totalStudents = User::where('school_id', $request->id)->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $totalTeachers = Teacher::where('school_id', $request->id)->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
        $AdminName = School::where('id', $request->id)->pluck('school_name');
        $AdminMail = School::where('id', $request->id)->pluck('email');

        $teacherAttendence = TeacherAttendance::where('school_id', $request->id)->whereMonth('access_date', $now->month)->whereYear('access_date', $now->year)->count();
        $teacher = Teacher::where('school_id', $request->id)->count();
        $needAttendence = $teacher * 26;
        $percentageTeacherAttendece =   ($teacherAttendence * 100) / $needAttendence;

        $StudentAttendence = Attendance::where('school_id', $request->id)->whereMonth('access_date', $now->month)->whereYear('access_date', $now->year)->count();
        $Student = User::where('school_id', $request->id)->count();
        $needStudent = $Student * 26;
        $percentageStudentAttendece =   ($StudentAttendence * 100) / $needStudent;


        $expense = Transection::where('school_id', $request->id)->whereMonth('datee', $now->month)->whereYear('datee', $now->year)->where('type', '1')->sum('amount');

        $fund = Transection::where('school_id', $request->id)->whereMonth('datee', $now->month)->whereYear('datee', $now->year)->where('type', '2')->sum('amount');
        Mail::to('liza@gmail.com')->send(new Summary($totalStudents, $totalTeachers, $AdminName, $monthYear, $percentageTeacherAttendece,$percentageStudentAttendece,$expense,$fund));

        return "Summary email sent to admin.";
    }
    public function summaryMailview()
    {
       

        return view("mail.example");
    }
}
