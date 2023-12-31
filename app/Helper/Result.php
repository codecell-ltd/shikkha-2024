<?php

use App\Models\Attendance;
use App\Models\CustomAttendanceInput;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

/**
 * ---------------------------------------------------------------------
 * Get a student's result of a specific subject & term
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @param int $subject_id
 * @param int $term_id
 * @param int $student_id
 * 
 * @return object
 */
if (!function_exists('get_result')) {
    function get_result(int $subject_id, int $term_id, int $student_id)
    {
        return Result::where(['subject_id' => $subject_id, 'term_id' => $term_id, 'student_id' => $student_id])->first();
    }
}

/**
 * ---------------------------------------------------------------------
 * A query to get attendances of a student of on class
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @param int $class_id
 * @param int $student_id
 * 
 * @return
 */
if (!function_exists('student_attendances_query')) {
    function student_attendances_query(int $class_id, int $student_id)
    {
        return Attendance::where(['school_id' => Auth::user()->guard_id, 'class_id' => $class_id, 'student_id' => $student_id]);
    }
}

/**
 * ---------------------------------------------------------------------
 * Get present & absent of a student of a class
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @param int $class_id
 * @param int $student_id
 * 
 * @return array
 */
if (!function_exists('get_present_absent')) {
    function get_present_absent(int $class_id, int $student_id)
    {
        return [
            'present' => student_attendances_query($class_id, $student_id)->where('attendance', 1)->count(),
            'absent'  => student_attendances_query($class_id, $student_id)->where('attendance', 0)->count()
        ];
    }
}

/**
 * ---------------------------------------------------------------------
 * Get term wise result of a student of a subject
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @param int $subject_id
 * @param int $term_id
 * @param int $student_id
 * 
 * @return object
 */
if (!function_exists('get_term_result')) {
    function get_term_result(int $subject_id, int $term_id, int $student_id)
    {
        return Result::where(['subject_id' => $subject_id, 'term_id' => $term_id, 'student_id' => $student_id])->first();
    }
}

/**
 * ---------------------------------------------------------------------
 * Get custom present & absent of a student
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @param int $student_id
 * 
 * @return array
 */
if (!function_exists('get_custom_attendance')) {
    function get_custom_attendance(int $student_id)
    {
        $custom_attendance_inputs = CustomAttendanceInput::where('user_id', $student_id)->get();

        $arr = [
            'present' => 0,
            'absent'  => 0
        ];

        foreach ($custom_attendance_inputs as $custom_attendance_input) {
            $arr['present'] = $arr['present'] + $custom_attendance_input->present;
            $arr['absent']  = $arr['absent'] + $custom_attendance_input->absent;
        }

        return $arr;
    }
}

/**
 * ---------------------------------------------------------------------
 * Get Class list
 * ---------------------------------------------------------------------
 * @author <Hridoy/>
 * 
 * @return array
 */
if (!function_exists('get_classes')) {
    function get_classes()
    {
        return [
            0 => ['Play', 'প্লে'],
            1  => ['Nursery', 'নার্সারি'],
            2  => ['Class One', 'প্রথম শ্রেণি'],
            3  => ['Class Two', 'দ্বিতীয় শ্রেণি'],
            4  => ['Class Three', 'তৃতীয় শ্রেণি'],
            5  => ['Class Four', 'চতুর্থ শ্রেণি'],
            6  => ['Class Five', 'পঞ্চম শ্রেণি'],
            7  => ['Class Six', 'ষষ্ঠ শ্রেণি'],
            8  => ['Class Seven', 'সপ্তম শ্রেণি'],
            9  => ['Class Eight', 'অষ্টম শ্রেণি'],
            10 => ['Class Nine', 'নবম শ্রেণি'],
            11 => ['Class Ten', 'দশম শ্রেণি'],
            12 => ['SSC Examinee', 'এসএসসি পরীক্ষার্থী'],
            13 => ['Class Eleven', 'একাদশ শ্রেণি'],
            14 => ['Class Twelve', 'দ্বাদশ শ্রেণি']
        ];
    }
}