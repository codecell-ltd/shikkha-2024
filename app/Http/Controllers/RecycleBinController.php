<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notice;
use App\Models\Result;
use App\Models\School;
use App\Models\Routine;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\FeesType;
use App\Models\Question;
use App\Models\BorrowBook;
use App\Models\ClassPeriod;
use App\Models\LibBookType;
use App\Models\Transection;
use App\Models\ClassSyllabus;
use App\Models\ResultSetting;
use App\Models\TeacherSalary;
use App\Models\EmployeeSalary;
use App\Models\InstituteClass;
use App\Models\LibraryBookInfo;
use App\Models\OnlineAdmission;
use App\Models\AssignStudentFee;
use App\Models\StudentMonthlyFee;
use App\Http\Controllers\Controller;
use App\Models\ResultSubjectCountableMark;

class RecycleBinController extends Controller
{


    //todo list over
    public function Recyclepage()
    {
        $seoTitle = 'Recycle Page';
        $seoDescription = 'Recycle Page';
        $seoKeyword = 'Recycle Page';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $data['school'] = School::find(authUser()->id);
        $school = School::find(authUser()->id);
        $data['fee'] = FeesType::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['assignFess'] = AssignStudentFee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['staffSalary'] = EmployeeSalary::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['TeacherSalary'] = TeacherSalary::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['expense'] = Transection::onlyTrashed()->where('school_id', $school->id)->where('type', 1)->orderBy('deleted_at', 'desc')->get();
        $data['fund'] = Transection::onlyTrashed()->where('school_id', $school->id)->where('type', 2)->orderBy('deleted_at', 'desc')->get();
        $data['studentMontyFee'] = StudentMonthlyFee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['section'] = Section::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $data['syllabus'] = ClassSyllabus::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        $data['Result'] = Result::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['resultCountablemark'] = ResultSubjectCountableMark::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['resultSetting'] = ResultSetting::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $data['User'] = User::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['Teacher'] = Teacher::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $data['admission'] = OnlineAdmission::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $data['staff'] = Employee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['question'] = Question::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['bookType'] = LibBookType::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $data['booklist'] = LibraryBookInfo::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $data['borrowlist'] = BorrowBook::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $data['class'] = InstituteClass::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['period'] = ClassPeriod::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $data['notice'] = Notice::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $data['subject'] = Subject::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        return view(
            'frontend.school.schoolProfile.Recyclepage',
            $data
        );
    }
    public function pdeleteBooktype($id)
    {
        try {
            LibBookType::withTrashed()->where('id', $id)->forcedelete();

            $LibBookType = LibBookType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Book type deleted parmanently',
                'data' => $LibBookType
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Book type'], 500);
        }
    }

    public function restoreBookType($id)
    {
        try {
            LibBookType::withTrashed()->where('id', $id)->restore();

            $LibBookType = LibBookType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Book type restored successfully',
                'data' => $LibBookType
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Book type'], 500);
        }
    }

    public function pdeleteBook($id)
    {
        try {
            LibraryBookInfo::withTrashed()->where('id', $id)->forcedelete();

            $LibBooklist = LibraryBookInfo::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Book deleted parmanently',
                'data' => $LibBooklist
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Book'], 500);
        }

        LibraryBookInfo::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }

    public function restoreBook($id)
    {
        try {
            LibraryBookInfo::withTrashed()->where('id', $id)->restore();

            $LibBooklist = LibraryBookInfo::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Book restored successfully',
                'data' => $LibBooklist
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Book'], 500);
        }
    }

    public function pdeleteBorrower($id)
    {
        try {
            BorrowBook::withTrashed()->where('id', $id)->forcedelete();

            $BorrowBook = BorrowBook::onlyTrashed()->with('studentRelation')->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Borrower info deleted parmanently',
                'data' => $BorrowBook,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to parmanent delete borrower info'], 500);
        }
    }

    public function restoreBorrower($id)
    {
        try {
            BorrowBook::withTrashed()->where('id', $id)->restore();

            $BorrowBook = BorrowBook::onlyTrashed()->with('studentRelation')->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Borrower info restored successfully',
                'data' => $BorrowBook,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore borrower info'], 500);
        }
    }
    public function PdeleteQuestion($id)
    {
        try {
            Question::withTrashed()->where('id', $id)->forcedelete();
            return  $data = Question::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => ' Info Delete Permanently',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to  Info'], 500);
        }
    }
    public function restoreQuestion($id)
    {
        try {
            Question::withTrashed()->where('id', $id)->restore();
            $data = Question::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => ' Info Restore Successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Info'], 500);
        }
    }
    public function restoreAdmission($id)
    {
        if (hasPermission('Admission Request Show')) {

            try {
                OnlineAdmission::withTrashed()->where('id', $id)->restore();
                $OnlineAdmission = OnlineAdmission::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

                return response()->json([
                    'message' => 'Student info data restored successfully.',
                    'data' => $OnlineAdmission

                ]);
            } catch (\exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        } else {
            return back();
        }
    }
    public function pDeleteAdmission($id)
    {
        try {
            OnlineAdmission::withTrashed()->where('id', $id)->forcedelete();
            $OnlineAdmission = OnlineAdmission::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Student info data deleted Successfully.',
                'data' => $OnlineAdmission

            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function assignFessrestore($id)
    {
        AssignStudentFee::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }

    public function feerestore($id)
    {
        try {
            FeesType::withTrashed()->where('id', $id)->restore();

            $fee = FeesType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'fees type restore Successfully.',
                'data' => $fee
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function feepdelete($id)
    {
        try {
            FeesType::withTrashed()->where('id', $id)->forcedelete();
            $fee = FeesType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Fees type deleted successfully.',
                'data' => $fee
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function expenserestore($id)
    {
        try {
            Transection::withTrashed()->where('id', $id)->restore();
            $Expense = Transection::onlyTrashed()->where('school_id', authUser()->id)->where('type', 1)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Expense restore Successfully.',
                'data' => $Expense
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function  expensepdelete($id)
    {

        try {
            Transection::withTrashed()->where('id', $id)->forcedelete();
            $Expense = Transection::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->where('type', 1)->get();
            return response()->json([
                'message' => 'Expense deleted permanently.',
                'data' => $Expense
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function fundrestore($id)
    {
        try {
            Transection::withTrashed()->where('id', $id)->restore();
            $Expense = Transection::onlyTrashed()->where('school_id', authUser()->id)->where('type', 2)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Fund restore Successfully.',
                'data' => $Expense
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        // Transection::withTrashed()->where('id', $id)->restore();
        // toast("Restore data", "success");
        // return back();
    }

    public function fundpdelete($id)
    {
        try {
            Transection::withTrashed()->where('id', $id)->forcedelete();
            $Expense = Transection::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->where('type', 2)->get();
            return response()->json([
                'message' => 'Fund deleted permanently.',
                'data' => $Expense
            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function staffSalaryrestore($id)
    {
        EmployeeSalary::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public function TeacherSalaryrestore($id)
    {
        TeacherSalary::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }


    public function studentMonthlyFeerestore($id)
    {
        try {
            StudentMonthlyFee::withTrashed()->where('id', $id)->restore();
            $studentMontyFee = StudentMonthlyFee::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Student Monthly fees data restored successfully.',
                'data' => $studentMontyFee

            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function studentMonthlyFeepdelete($id)
    {
        try {
            StudentMonthlyFee::withTrashed()->where('id', $id)->forcedelete();
            $studentMontyFee = StudentMonthlyFee::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Student monthly fees data deleted permanently.',
                'data' => $studentMontyFee

            ]);
        } catch (\exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    public function assignFesspdelete($id)
    {
        AssignStudentFee::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }

    public function  staffSalarypdelete($id)
    {
        EmployeeSalary::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public function TeacherSalarypdelete($id)
    {
        TeacherSalary::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }

    public function restoreclass($id)
    {

        try {
            ResultSubjectCountableMark::where('institute_class_id', $id)->restore();
            Routine::withTrashed()->where('class_id', $id)->restore();
            ClassSyllabus::withTrashed()->where('class_id', $id)->restore();
            Section::withTrashed()->where('class_id', $id)->restore();
            User::withTrashed()->where('class_id', $id)->restore();
            Subject::withTrashed()->where('class_id', $id)->restore();
            InstituteClass::withTrashed()->where('id', $id)->restore();
            $data = InstituteClass::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Class info restore Successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore  successfully'], 500);
        }
    }
    public  function studentMontyFeepdelete($id)
    {
        StudentMonthlyFee::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public function pdeletesubject($id)
    {

        Subject::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public function restoreSubject($id)
    {
        Subject::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public function noticerestore($id)
    {

        try {
            Notice::withTrashed()->where('id', $id)->restore();
            $data = Notice::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'notice restore',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public function noticePdelete($id)
    {

        try {
            Notice::withTrashed()->where('id', $id)->forcedelete();
            $data = Notice::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'notice deleted',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public function pSectionDelete($id)
    {
        try {
            User::withTrashed()->where('section_id', $id)->restore();
            Section::withTrashed()->where('id', $id)->forcedelete();
            $data = Section::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Section  restore Successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore  successfully'], 500);
        }
    }
    public function restoreSection($id)
    {
        try {
            User::withTrashed()->where('section_id', $id)->restore();
            Section::withTrashed()->where('id', $id)->restore();
            $data = Section::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Section  restore Successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore  successfully'], 500);
        }
    }
    public function restoreStaff($id)
    {
        try {
            EmployeeSalary::withTrashed()->where('employee_id', $id)->restore();
            Employee::withTrashed()->where('id', $id)->restore();
            $Employee = Employee::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Staff info restore Successfully',
                'data' => $Employee
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore staff successfully'], 500);
        }
    }
    public function restorestudent($id)
    {
        try {
            StudentMonthlyFee::withTrashed()->where('student_id', $id)->restore();
            Result::withTrashed()->where('student_id', $id)->restore();
            User::withTrashed()->where('id', $id)->restore();

            $data = User::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'student Data restored successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Student data'], 500);
        }
    }
    public function restoreteacher($id)
    {
        try {
            TeacherSalary::withTrashed()->where('teacher_id', $id)->restore();
            Teacher::withTrashed()->where('id', $id)->restore();
            $Teacher = Teacher::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Teacher Info Restore Successfully',
                'data' => $Teacher
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Teacher Info'], 500);
        }

        // TeacherSalary::withTrashed()->where('teacher_id', $id)->restore();
        // Teacher::withTrashed()->where('id', $id)->restore();
        // toast("Restore data", "success");
        // return back();
    }
    public function Pdelete_teacher($id)
    {
        try {
            TeacherSalary::withTrashed()->where('teacher_id', $id)->forcedelete();
            Teacher::withTrashed()->where('id', $id)->forcedelete();
            $Teacher = Teacher::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Teacher Info Delete Permanently',
                'data' => $Teacher
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to Delete Teacher Info'], 500);
        }

        // TeacherSalary::withTrashed()->where('teacher_id', $id)->forcedelete();
        // Teacher::withTrashed()->where('id', $id)->forcedelete();
        // toast("Data delete permanently", "success");
        // return back();
    }


    public function pDeleteStaff($id)
    {
        try {
            EmployeeSalary::withTrashed()->where('employee_id', $id)->forcedelete();
            Employee::withTrashed()->where('id', $id)->forcedelete();
            $Employee = Employee::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Staff info deleted permanently',
                'data' => $Employee
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete staff info'], 500);
        }
    }
    public function Pdelete_student($id)
    {
        try {
            StudentMonthlyFee::withTrashed()->where('student_id', $id)->forcedelete();
            Result::withTrashed()->where('student_id', $id)->forcedelete();
            User::withTrashed()->where('id', $id)->forcedelete();

            $data = User::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json([
                'message' => 'Student data deleted Permanently.',
                'data' => $data
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete student data.'], 500);
        }
    }
    public  function pdeleteresultSetting($id)
    {
        try {
            ResultSetting::withTrashed()->where('id', $id)->forcedelete();
            $data = ResultSetting::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Result settings deleted',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public  function pdeleteresultCountablemark($id)
    {
        ResultSubjectCountableMark::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public  function pdeleteresult($id)
    {
        try {
            Result::withTrashed()->where('id', $id)->forcedelete();
            $data = Result::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Result  deleted',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public  function resultSettingrestore($id)
    {

        try {
            ResultSetting::withTrashed()->where('id', $id)->restore();
            $data = ResultSetting::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Result settings',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }

    public  function resultCountablemarkrestore($id)
    {
        ResultSubjectCountableMark::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public  function resultrestore($id)
    {

        try {
            Result::withTrashed()->where('id', $id)->restore();
            $data = Result::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'Result restore',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public function periodDeletepar($id)
    {

        if (hasPermission('period_create')) {

            try {
                ClassPeriod::withTrashed()->where('id', $id)->restore();
                $data = ClassPeriod::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

                return response()->json([
                    'message' => 'Period  Delete Successfully',
                    'data' => $data
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete'], 500);
            }
        }
    }
    public function periodrestore($id)
    {
        if (hasPermission('period_create')) {

            try {
                ClassPeriod::withTrashed()->where('id', $id)->restore();
                $data = ClassPeriod::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

                return response()->json([
                    'message' => 'Period  restore Successfully',
                    'data' => $data
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to restore'], 500);
            }
        }
    }
    public function pclassDelete($id)
    {

        try {

            ResultSubjectCountableMark::where('institute_class_id', $id)->delete();

            User::withTrashed()->where('class_id', $id)->forcedelete();
            Routine::withTrashed()->where('class_id', $id)->forcedelete();
            ClassSyllabus::withTrashed()->where('class_id', $id)->forcedelete();
            Section::withTrashed()->where('class_id', $id)->forcedelete();
            Subject::withTrashed()->where('class_id', $id)->forcedelete();
            InstituteClass::withTrashed()->where('id', $id)->forcedelete();
            $data = InstituteClass::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();

            return response()->json([
                'message' => 'class  Deleted',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete'], 500);
        }
    }
    public function restoreSyllabus()
    {
    }
    public function  pdeletesyllabus()
    {
    }
}
