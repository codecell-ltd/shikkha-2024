<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listOfPermision = $this->permisions;

        // \App\Models\Permission::truncate();

        foreach($listOfPermision as $item)
        {
            if(!empty($item))
            {
                \App\Models\Permission::create(["name" => strtolower($item), "active" => 1]);
            }
        }
    }


    protected $permisions = [
        "Dashboard Show",
        "Admission Request Show",
        "Admission Request Delete",

        "Class Create",
        "Class Show",
        "Class Edit",
        "Class Delete",

        "Section Create",
        "Section Show",
        "Section Edit",
        "Section Delete",

        "Syllabus Create",
        "Syllabus Show",
        "Syllabus Edit",
        "Syllabus Delete",

        "Subject Create",
        "Subject Show",
        "Subject Edit",
        "Subject Delete",

        "Period Create",
        "Period Show",
        "Period Edit",
        "Period Delete",

        "Routine Create",
        "Routine Show",
        "Routine Edit",
        "Routine Delete",

        "Student Create",
        "Student Show",
        "Student Single Show",
        "Student Attendance Report",
        "Student Edit",
        "Student Delete",

        "Teacher Create",
        "Teacher Show",
        "Teacher Single Show",
        "Teacher Attendance Report",
        "Teacher Edit",
        "Teacher Delete",

        "Assign Teacher Create",
        "Assign Teacher Show",
        "Assign Teacher Delete",

        "Staff List Create",
        "Staff List Show",
        "Staff List Single Show",
        "Staff List Attendance Report",
        "Staff List Edit",
        "Staff List Delete",
        "Staff Type Create",
        "Staff Type Show",
        "Staff Type Edit",
        "Staff Type Delete",

        "Student Attendance Dashboard",
        "Attendance Report Show",
        "Attendance Take Create",
        "Attendance Take Show",
        "View Attendance Show",
        "Upload Attendance",
        "Get Attendance",
        "Custom Attendance Show",
        "Custom Attendance Edit",
        "Auto Attendance",

        "Teaccher Attendance Dashboard",
        "Teacher Attendance Take Create",
        "Teacher Attendance Take edit",
        "Teacher View Attendance",

        "Staff Attendance Take Create",
        "Staff Attendance Take edit",
        "Staff View Attendance",

        "Finance Dashboard",  
        "Finance School Fees Create",
        "Finance School Fees Show",
        "Finance School Fees Edit",
        "Finance School Fees Delete",
        "Finance Assign Fees Create",
        "Finance Assign Fees Show",
        "Finance Assign Fees Edit",
        "Finance Assign Fees Delete",
        "Finance Collect Fees Show",
        "Finance Collect Fees Create",
        "Finance Collect Fees Edit",
        "Finance Collect Fees Delete",

        "Teacher Salary Show",
        "Teacher Salary Edit",

        "Staff Salary Show",
        "Staff Salary Edit",
        "Bank Account Create",
        
        "Bank Account Show",
        "Bank Account Edit",
        "Bank Account Delete",
        
        "Expense Create",
        "Expense Show",
        "Expense Edit",
        "Expense Delete",
        "Expense List Show",

        "Fund Create",
        "Fund Show",
        "Fund Edit",
        "Fund Delete",
        "Fund List Show",

        "Accesories Create",
        "Accesories Show",
        "Accesories Edit",
        "Accesories Delete",
        "Accesories Collect Fees",
        "Student Finance Status Show",

        "Result SMS Send",
        "Student SMS Send",
        "Teacher SMS Send",
        "Staff SMS Send",

        "Exam Term Create",
        "Exam Term Show",
        "Exam Term Edit",
        "Exam Term Delete",
        "Exam Routine Create",
        "Exam Routine Show",
        "Exam Routine Edit",
        "Exam Routine Delete",

        "Question Create",
        "Question Show",
        "Question Edit",
        "Question Delete",
        "Question View",
        "Admit Card Show",
        "Sit Plan Show",

        "Question Bank Create",
        "Question Bank Show",
        "Question Bank Edit",
        "Question Bank Delete",
        "Question Search Page Create",
        "Question Search Page Show",
        "Question Search Page Edit",
        "Question Search Page Delete",
        
        "Result Upload Create",
        "Result Upload Show",
        "Result Upload Edit",
        "Result Upload Delete",
        "Result Upload Duplicate",
        "See Result",
        "Result PDF",

        "Notice Create",
        "Notice Show",
        "Notice Edit",
        "Notice Delete",

        "Role Create",
        "Role Show",
        "Role Edit",
        "Role Delete",
        
        "Borrower Info Create",
        "Borrower Info Show",
        "Borrower Info Edit",
        "Borrower Info Delete",
        
        "Book Type Create",
        "Book Type Show",
        "Book Type Edit",
        "Book Type Delete",
//
        "Book List Create",
        "Book List Show",
        "Book List Edit",
        "Book List Delete",
//done
        "Setting Class Show",
        "Setting Class edit",

        "Setting Finger Print Show",
        "Setting Finger Print edit",

        "School Setting edit",

        "Addon Purchase",
        "website control"
    ];
}
