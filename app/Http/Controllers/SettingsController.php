<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Price;
use App\Mail\Reminder;
use App\Models\AllUser;
use App\Models\Result;
use App\Models\School;
use App\Models\Ticket;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Employee;
use App\Models\FeesType;
use App\Models\Question;
use App\Models\Todolist;
use App\Models\BorrowBook;
use App\Models\Permission;
use App\Models\ClassPeriod;
use App\Models\LibBookType;
use App\Models\Transection;
use Illuminate\Http\Request;
use App\Models\ClassSyllabus;
use App\Models\ResultSetting;
use App\Models\TeacherSalary;
use App\Models\EmployeeSalary;
use App\Models\InstituteClass;
use App\Models\Shikkhabilling;
use Illuminate\Support\Carbon;
use App\Models\LibraryBookInfo;
use App\Models\OnlineAdmission;
use App\Models\AssignStudentFee;
use PhpParser\Node\Stmt\Return_;
use App\Models\StudentMonthlyFee;
use App\Models\Billingtransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ResultSubjectCountableMark;

class SettingsController extends Controller
{

    public $school;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->school = authUser(); //auth user details

            return $next($request);
        });
    }

    /**
     * show index
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $seoTitle = 'School Setting';
        $seoDescription = 'School Setting';
        $seoKeyword = 'School Setting';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        if (!empty($institute_classes)) {
            $data = [];
            $data['sections'] = DB::table("common_classes")->whereNotNull('section')->get();
            $data['classes'] = [];
            $classes = DB::table("common_classes")->whereNull('section')->get();
            foreach ($classes as $class) {
                $data['classes'][] = [
                    'id' =>  $class->id,
                    'title' =>  $class->title,
                    'subjects'  =>  DB::table("common_subjects")->where('class', $class->id)->get(['id', 'code', 'name'])
                ];
            }
        } else {
            $data = [];
            $data['sections'] = DB::table("common_classes")->whereNotNull('section')->get();
            $data['classes'] = [];
            $classes = DB::table("common_classes")->whereNull('section')->get();
            foreach ($classes as $class) {
                $data['classes'][] = [
                    'id' =>  $class->id,
                    'title' =>  $class->title,
                    'subjects'  =>  DB::table("common_subjects")->where('class', $class->id)->get(['id', 'code', 'name'])
                ];
            }
        }
        return view('frontend.school.settings')->with(compact('data', 'seo_array'));
    }

    public function show()
    {
        $result_mark_setting = School::find(authUser()->id)->first()->result_mark_type;
        return view('frontend.school.settings.content')->with(compact('result_mark_setting'));
    }

    public function update(Request $request)
    {
        // return $request;
        $school = School::find(authUser()->id);
        $school->update([
            'result_mark_type'    =>  $request->mark_type,
        ]);

        $result_mark_setting = School::find(authUser()->id)->result_mark_type;
        return view('frontend.school.settings.content')->with(compact('result_mark_setting'));
    }



    /**
     * Store Subject in Database
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Shahidul 
     * @modifier Sajjad <sajjad.develpr.gmail.com>
     * @modifed 05-07-23
     * @param Request 
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'class' => 'required|array',
            ],
            [
                'class.required'    =>  'Please select at least one item'
            ]
        );

        try {
            foreach ($request->class as $classId) {
                $class = DB::table('common_classes')->where('id', $classId)->first();

                $justName = str_replace("Class ", "", $class->title);

                if (InstituteClass::where(['school_id' => authUser()->id, 'class_name' => $class->title])->exists()) {
                    $class_name = $class->title;
                } else {
                    $class_name = $justName;
                }

                $newClass = InstituteClass::updateOrCreate(
                    [
                        'class_name'    =>  $class_name,
                        'school_id'     =>  $this->school->id,
                    ],
                    [
                        'class_fees'    =>  0,
                        'active'        =>  1
                    ]
                );

                $subjects = DB::table('common_subjects')
                    ->where('class', $classId)
                    ->whereIn('id', $request->subjects)
                    ->get();

                foreach ($subjects as $item) {
                    Subject::updateOrCreate(
                        [
                            'class_id'      =>  $newClass->id,
                            'subject_name'  =>  $item->name,
                            'school_id'     =>  $this->school->id,
                            'active'        =>  1,
                        ],
                        [
                            'subject_code'  =>  $item->code,
                            'group_id'      =>  $item->group
                        ]
                    );
                }
            }

            toast("Multiple Class and Subject Create Successfuly", 'success');
            return redirect(route('school.dashboard'));
        } catch (Exception $e) {
            Alert::error('Server Problem', $e->getMessage());
            return back();
        }
    }

    /**
     * show school profile 
     */
    public function school_profile()
    {
        $seoTitle = 'School Profile';
        $seoDescription = 'School Profile';
        $seoKeyword = 'School Profile';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $school = School::find(authUser()->id);
        return view('frontend.school.schoolProfile.schoolProfile', compact('school', 'seo_array'));
    }


    /**
     * update school password
     */
    public function school_Password(Request $request,$id)
    {
        $school = School::find($id);
        $admin = AllUser::where('school_from',$id)->first();
        $request->validate([
            'password' => ['required', 'min:5', 'confirmed']
        ]);
        $school->update([

            'password' => bcrypt($request->password)
        ]);  
        $admin->update([

            'password' => bcrypt($request->password)
        ]);
        Alert::success('School password is Changed', 'Success Message');
        return back();
    }



    /**
     * edit school profile
     * 
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function school_profileEdit($id)
    {
        $seoTitle = 'School Profile Edit';
        $seoDescription = 'School Profile Edit';
        $seoKeyword = 'School Profile Edit';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $school = School::find(authUser()->id);
        return view('frontend.school.schoolProfile.EditProfile', compact('school', 'seo_array'));
    }


    /** 
     * update school profile
     */
    public function school_profile_Update(Request $request, $id)
    {
        // return $request;
        $school = School::find($id);

        $request->validate([
            'user_name'     => 'unique:schools,user_name,' . $id,
        ]);


        if ($request->hasFile('school_logo')) {
            File::delete(public_path($school->school_logo));

            $fileName = date('Ymdhmsis') . '.' . $request->file('school_logo')->extension();
            $request->file('school_logo')->move(public_path('uploads/SchoolLogo'), $fileName);
            $filePath = "uploads/SchoolLogo/" . $fileName;
            $filePath = $filePath;
        }
        if ($request->hasFile('signature')) {
             File::delete(public_path($school->signature));
            $fileName = date('Ymdhmsis') . '.' . $request->file('signature')->extension();
            $request->file('signature')->move(public_path('uploads/SchoolLogo'), $fileName);
            $filePath1 = "uploads/SchoolLogo/" . $fileName;
            $filePath1 = $filePath1;
        }


        $school->update([
            'school_name' => $request->school_name,
            'school_name_bn'    => $request->school_name_bn,
            'user_name'     => $request->user_name,
            'email' => $request->email,
            'address' => $request->address,
            'address_bn' => $request->address_bn,
            'phone_number' => $request->phone_number,
            'state' => $request->state,
            'city' => $request->city,
            'postcode' => $request->postcode,
            // 'website_url' => $request->website_url,
            'slogan' => $request->slogan,
            'slogan_bn' => $request->slogan_bn,
            'ein_number' => $request->ein_number,
            'school_logo' => $filePath ?? $school->school_logo,
            'signature' => $filePath1 ?? $school->signature,

        ]);

        $schoolInAllUser = \App\Models\AllUser::where('guard_id', $school->id)->where('guard', 'school')->first();
        $schoolInAllUser->update([
            "email" => $school->email,
            "phone" => $school->phone_number,
        ]);

        if(!empty($school->website_url)){
            $http = Http::withoutVerifying()->post("$school->website_url/api/school/update", $school->toArray());
        }

        Alert::success("Great!", "Record updated successfully");
        return redirect()->route('school.profile');
    }



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
        $school = School::find(authUser()->id);
        $fee = FeesType::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $assignFess = AssignStudentFee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $staffSalary = EmployeeSalary::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $TeacherSalary = TeacherSalary::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $expense = Transection::onlyTrashed()->where('school_id', $school->id)->where('type', 1)->orderBy('deleted_at', 'desc')->get();
        $fund = Transection::onlyTrashed()->where('school_id', $school->id)->where('type', 2)->orderBy('deleted_at', 'desc')->get();
        $studentMontyFee = StudentMonthlyFee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $syllabus = ClassSyllabus::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $resultCountablemark = ResultSubjectCountableMark::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->paginate(5);
        $resultSetting = ResultSetting::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->paginate(5);
        $User = User::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $Teacher = Teacher::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $Result = Result::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->paginate(5);
        $admission = OnlineAdmission::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $staff = Employee::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $question = Question::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $bookType = LibBookType::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $booklist = LibraryBookInfo::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $borrowlist = BorrowBook::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        $section = Section::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $class = InstituteClass::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        $period = ClassPeriod::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();

        $subject = Subject::onlyTrashed()->where('school_id', $school->id)->orderBy('deleted_at', 'desc')->get();
        return view('frontend.school.schoolProfile.Recyclepage', compact(
            'User',
            'resultCountablemark',
            'fee',
            'assignFess',
            'staffSalary',
            'TeacherSalary',
            'expense',
            'studentMontyFee',
            'syllabus',
            'resultSetting',
            'section',
            'Teacher',
            'Result',
            'fund',
            'admission',
            'period',
            'subject',
            'staff',
            'class',
            'borrowlist',
            'booklist',
            'bookType',
            'question',
            'seo_array'
        ));
    }

    public function userRoleShow()
    {
        if (hasPermission('role_show')) {

            $roles = Role::where('school_id', authUser()->id)->get();
            return view('frontend.school.role.showRole', compact('roles'));
        } else {
            return back();
        }
    }
    public function  userRolecreate()
    {
        if (hasPermission('role_create')) {

            return view('frontend.school.role.roleCreate');
        } else {
            return back();
        }
    }

    public function  userRolecreatePost(Request $request)
    {

        if (hasPermission('role_create')) {

            $role = Role::create([
                'school_id' => authUser()->id,
                'role' => $request->input('role'),
            ]);

            $permissions = $request->input('permissions', []);

            foreach ($permissions as $menu => $actions) {
                Permission::create([
                    'created_by' => authUser()->id,
                    'role_id' => $role->id,
                    'permission' => $menu
                ]);
            }
            Alert::success('Role Created Succesfully', 'Success Message');

            return redirect()->route('user.role.show');
        } else {
            return back();
        }
    }
    public function userRoleeditPost(Request $request)
    {

        if (hasPermission('role_edit')) {


            $role = Role::updateOrCreate([
                'school_id' => authUser()->id,
                'role' => $request->input('role'),
            ]);

            $permissions = $request->input('permissions', []);

            foreach ($permissions as $menu => $actions) {
                Permission::updateOrCreate([
                    'created_by' => authUser()->id,
                    'role_id' => $role->id,
                    'permission' => $menu
                ]);
            }
            Alert::success('Role Edited Succesfully', 'Success Message');

            return redirect()->route('user.role.show');
        } else {
            return back();
        }
    }
    public function  userRoleedit(Request $request, $id)
    {
        if (hasPermission('role_edit')) {

            $roleEdit = Role::find($id);
            $permissions = Permission::where('role_id', $id)->get();

            return view('frontend.school.role.roleCreate', compact('roleEdit', 'permissions'));
        } else {
            return back();
        }
    }

    public function   Userroledelete($id)
    {
        if (hasPermission('role_delete')) {

            $permissions = Permission::where('role_id', $id)->delete();
            $role = Role::find($id);
            $role->delete();
            Alert::success('Successfully role Deleted', 'Success Message');
            return back();
        } else {
            return back();
        }
    }
    public function assignRole()
    {
        if (hasPermission('role_create')) {

        $role = Role::where('school_id', authUser()->id)->get();
        $teacher = Teacher::where('school_id', authUser()->id)->paginate(5);
        return view('frontend.school.role.assignRole', compact('teacher', 'role'));
    }
    else{
        return back();
    }}
    public function assignRolepost(Request $request, $id)
    {
        $assign = AllUser::find($id);
        $assign->update(
            [
                'role' => $request->role,
            ]

        );
        Alert::success(' role assigned', 'Success Message');
        return back();
    }

    public function school_billing()
    {
        $seoTitle = 'School Bill';
        $seoDescription = 'School Bill';
        $seoKeyword = 'School Bill';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $school = School::find(authUser()->id);
        $billing = Shikkhabilling::where('school_id', $school->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.school.schoolProfile.schoolbilling', compact('school', 'billing', 'seo_array'));
    }

    public function billing_transaction()
    {
        $school = School::find(authUser()->id);
        return view('frontend.school.schoolProfile.schoolbillingtransaction', compact('school'));
    }
    public function billing_transaction_Store(Request $request)
    {
        $request->validate([
            'sending_number' => 'required',
            'amount' => 'required',
        ]);
        try {
            Billingtransaction::create([
                'school_id' => $request->school_id,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'sending_number' => $request->sending_number,
                'amount' => $request->amount,
            ]);
            Alert::success('Your Payment successfully done');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::error('Error');
            return redirect()->back();
        }
    }
}
