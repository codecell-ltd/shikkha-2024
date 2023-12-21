<?php

use App\Models\Attendance;
use App\Models\CustomAttendanceInput;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

# Hridoy

if(!function_exists('get_result'))
{
    function get_result(int $subject_id, int $term_id, int $student_id)
    {
        return Result::where(['subject_id' => $subject_id, 'term_id' => $term_id, 'student_id' => $student_id])->first();
    }
}

if(!function_exists('student_attendances_query'))
{
    function student_attendances_query(int $class_id, int $student_id)
    {
        return Attendance::where(['school_id' => Auth::user()->guard_id, 'class_id' => $class_id, 'student_id' => $student_id]);
    }
}

if(!function_exists('get_present_absent'))
{
    function get_present_absent(int $class_id, int $student_id)
    {
        return [
            'present' => student_attendances_query($class_id, $student_id)->where('attendance', 1)->count(),
            'absent'  => student_attendances_query($class_id, $student_id)->where('attendance', 0)->count()
        ];
    }
}

if(!function_exists('get_term_result'))
{
    function get_term_result(int $subject_id, int $term_id, int $student_id)
    {
        return Result::where(['subject_id' => $subject_id, 'term_id' => $term_id, 'student_id' => $student_id])->first();
    }
}

if(!function_exists('get_custom_attendance'))
{
    function get_custom_attendance(int $student_id)
    {
        $custom_attendance_inputs = CustomAttendanceInput::where('user_id', $student_id)->get();

        $arr = [
            'present' => 0,
            'absent'  => 0
        ];

        foreach ($custom_attendance_inputs as $custom_attendance_input) 
        {
            $arr['present'] = $arr['present'] + $custom_attendance_input->present;
            $arr['absent']  = $arr['absent'] + $custom_attendance_input->absent;
        }

        return $arr;
    }
}