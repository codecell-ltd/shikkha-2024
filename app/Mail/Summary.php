<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Summary extends Mailable
{
    public $totalStudents;
    public $percentageTeacherAttendece;
    public $totalTeachers;
    public $AdminName;
    public $monthYear;
    public $fund;
    public $expense;
    public $percentageStudentAttendece;
    public function __construct($totalStudents, $totalTeachers,$AdminName,$monthYear,$percentageTeacherAttendece,$percentageStudentAttendece,$fund,$expense)
    {
        $this->totalStudents = $totalStudents;
        $this->expense = $expense;
        $this->fund = $fund;
        $this->percentageTeacherAttendece = $percentageTeacherAttendece;
        $this->percentageStudentAttendece = $percentageStudentAttendece;
        $this->totalTeachers = $totalTeachers;
        $this->AdminName = $AdminName;
        $this->$monthYear = $monthYear;
    }

    public function build()
    {
        return $this->view('mail.summary_mail')
            ->subject('Monthly Summary');
    }
}