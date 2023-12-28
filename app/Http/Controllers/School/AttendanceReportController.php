<?php

namespace App\Http\Controllers\School;

use App\Models\Teacher;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\TeacherAttendance;
use App\Http\Controllers\Controller;


class AttendanceReportController extends Controller
{
    /**
     * -------------------------------------------------
     *  Show Input Form
     * -------------------------------------------------
     * 
     * @return \Illuminate\Contracts\View\View
     * 
     * @author Codecell Limited <emailadressoftanvir1@gmail.com>
     * @contributor Shahidul Islam <contact.shahidul@gmail.com>
     * @last_modified September 04, 2023
     */
    public function report()
    {
        return view("frontend.school.attendance.report.index");
    }



    /**
     * -------------------------------------------------
     *  report of a single user
     * -------------------------------------------------
     * 
     * @param string $userType (teacher / user)
     * @param int|string $id
     * @return \Illuminate\Contracts\View\View
     *
     * @author Codecell Limited <emailadressoftanvir1@gmail.com>
     * @contributor Shahidul Islam <contact.shahidul@gmail.com>
     * @last_modified September 04, 2023
     */
    public function reportOfUser(Request $request, string $userType, int|string $userId)
    {
        $school =authUser();

        if($request->has('from') && $request->has('to'))
        {
            $from = $request->from;
            $to = \Carbon\Carbon::createFromFormat("Y-m-d", $request->to);
        }
        else
        {
            $from = \Carbon\Carbon::today()->subDays(30);
            $to = \Carbon\Carbon::today();
        }

        if($userType == "teacher")
        {
            $data['userType'] = "teacher";
            $data['teacher'] =Teacher::findOrFail($userId, ['unique_id', 'full_name', 'email', 'phone', 'designation', 'entry_time', 'exit_time']);
            $data['attendances'] =TeacherAttendance::where("school_id", $school->id)
            ->where("teacher_id", $userId)
            ->whereBetween('created_at', [$from, $to])
            ->latest()
            ->get(['attendance', 'access_time', 'exit_time', 'created_at']);
        }
        elseif($userType == "user")
        {
            // $userType = "user";
            $data['userType'] = "user";
            $data['user'] = \App\Models\User::findOrFail($userId);
            $data['attendances'] = \App\Models\Attendance::where("school_id", $school->id)
            ->where("student_id", $userId)
            ->whereBetween('created_at', [$from, $to])
            ->latest()
            ->get(['attendance', 'access_time', 'exit_time', 'created_at']);
        }
        elseif($userType == "staff")
        {
            // return $userId;
            $data['userType'] = "staff";
            $data['staff'] =Employee::findOrFail($userId);
            $data['attendances'] = \App\Models\StaffAttendance::where("school_id", $school->id)
                ->where("employee_id", $userId)
                ->whereBetween('access_date', [$from, $to])
                ->latest()
                ->get(['attendance', 'access_time', 'exit_time', 'created_at']);
        }

        $data['days_in_different'] = $to->diffInDays($from);

        return view("frontend.school.attendance.report.index")->with($data);
    }

}
