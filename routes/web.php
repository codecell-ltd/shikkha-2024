<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultSetting;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Exam\MarkController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\School\SMSController;
use App\Http\Controllers\ClassPeriodController;
use App\Http\Controllers\School\TermController;
use App\Http\Controllers\School\AddonController;
use App\Http\Controllers\Exam\QuestionController;
use App\Http\Controllers\School\DeviceController;
use App\Http\Controllers\School\ResultController;
use App\Http\Controllers\Finance\SalaryController;
use App\Http\Controllers\School\FinanceController;
use App\Http\Controllers\School\LibraryController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\School\SubjectController;
use App\Http\Controllers\School\SyllabusController;
use App\Http\Controllers\OnlineAddmissionController;
use App\Http\Controllers\Notice\NoticeViewController;
use App\Http\Controllers\School\AssignFeesController;
use App\Http\Controllers\School\AttendanceController;
use App\Http\Controllers\Finance\SchoolFeesController;
use App\Http\Controllers\Lib\LanguageDetectController;
use App\Http\Controllers\School\AttendanceReportController;
use App\Http\Controllers\School\CertificateController;
use App\Http\Controllers\Finance\CollectFeesController;
use LDAP\Result;

// include frontend routes
include_once 'frontend.php';
include_once 'student.php';

// Route::get("import/all-user", [\App\Http\Controllers\Controller::class, "importAllUser"]);
Route::get("import/school/token", [\App\Http\Controllers\Controller::class, "importSchoolToken"]);

Route::get("test", function(){
    return hasPermission("borrow_book|book_info");
});

/**  
 * ---------------------------------------------
 *  School Panel
 * ---------------------------------------------
 */
Route::get('/data', [WebsiteController::class, 'migrateTeachersToUsers']);
Route::post("detect/language", [LanguageDetectController::class, 'detecLanguage'])->name('detect.language');

Route::middleware(['language', 'auth', 'UnderMaintenance'])
    ->prefix('school')
    ->group(function () {

        Route::get('/', function () {
            return redirect(route('school.dashboard'));
        });

        // dashboard
        Route::get('/dashboard', [App\Http\Controllers\SchoolController::class, 'school'])->name('school.dashboard');
        Route::get('/session/update/{class?}', [SessionController::class, 'sessionCreate'])->name('session.create');

        // school Profile
        Route::get("/profile", [SettingsController::class, 'school_profile'])->name('school.profile');
        Route::get("/profile/{id}/edit", [SettingsController::class, 'school_profileEdit'])->name('school.profileEdit');
        Route::put("/profile/{id}/update", [SettingsController::class, 'school_profile_Update'])->name('school.profile.Update');
        Route::post("/password/{id}", [SettingsController::class, 'school_Password'])->name('school.Password');


        Route::get('/checkout/package', [App\Http\Controllers\SchoolController::class, 'schoolPackageAfter'])->name('school.package.after');
        Route::post('/checkout/package/post', [App\Http\Controllers\SchoolController::class, 'schoolPackageAfterPost'])->name('school.package.after.post');
        Route::get('/message/package', [App\Http\Controllers\SchoolController::class, 'schoolMessage'])->name('school.message');
        Route::post('/message/package/post', [App\Http\Controllers\SchoolController::class, 'schoolMessagePost'])->name('school.message.post');
        Route::post('/message/package/post/checkout', [App\Http\Controllers\PaymentController::class, 'paymentindex'])->name('school.message.post.checkout');
        Route::get('/message/statement/show', [App\Http\Controllers\SchoolController::class, 'StatementShow'])->name('school.message.post.checkout.show');
        Route::get('/message/usage/show', [App\Http\Controllers\SchoolController::class, 'smsUsagesData'])->name('school.message.usage.show');
        Route::get('/pdf/statement/{id}', [App\Http\Controllers\SchoolController::class, 'StatementShowMessage'])->name('pdf.show.statement');


        Route::post('/select/price/post',    [App\Http\Controllers\SchoolController::class, 'selectPricePost'])->name('selectPrice.post');
        Route::get('/price/suggest/{id}',    [App\Http\Controllers\SchoolController::class, 'priceSuggest'])->name('price.suggest');
        Route::post('/color/change',    [App\Http\Controllers\SchoolController::class, 'UserColor'])->name('user.update.post.color');


        Route::get('/StudentIdCard', [CardController::class, 'idCard'])->name('id.Card');
        Route::post('/idCardPost', [CardController::class, 'store'])->name('id.Card.post');

        // pagination table without loading
        Route::post('/pagination/table', [App\Http\Controllers\ExpenseController::class, 'paginator'])->name('without.load.pagination');

        // task
        Route::post('/update-blade', [TaskController::class, 'updatePage'])->name('update.blade');
        Route::get("Reminder/message/", [TaskController::class, 'reminderMessage'])->name('reminder.mail');
        Route::get("todo/Listshow/Done", [TaskController::class, 'todoshowDone'])->name('loadData.show');
        Route::get("/deletes/task/{itemId}", [TaskController::class, 'todoshowpost'])->name('delete.todo');
        Route::get("/show/task/{itemId}", [TaskController::class, 'todoshowView'])->name('view.todo');
        Route::post("/update/task/{itemId}", [TaskController::class, 'todoStatuspost'])->name('status.todo.post');
        Route::get("todoListshow", [TaskController::class, 'todoshow'])->name('todo.show');
        Route::get("todoList", [TaskController::class, 'todoList'])->name('todoList');
        Route::post("todoList/post", [TaskController::class, 'todoListpost'])->name('todoList.post');
        Route::post("todoListreminder/post", [TaskController::class, 'todoListReminderpost'])->name('todoList.reminder.post');

        // send sms for result
        Route::get('sms/result', [SMSController::class, 'index'])->name('sms.result');
        Route::post('sms/result', [SMSController::class, 'resultSendToSms'])->name('send.sms.result');
        Route::get('/ajax/students', [AjaxController::class, 'ajaxLoadStudents'])->name('ajax.load.students');
        
        Route::get('/ShowData/restore/{id}', [SyllabusController::class, 'restoresyllabus'])->name('restore.syllabus');
        Route::get('/pdelete/syllabus/{id}', [SyllabusController::class, 'pdeletesyllabus'])->name('Pdelete.syllabus');

        // fingerprint device (stellar)
        Route::get('device', [DeviceController::class, 'index'])->name('device.index');
        Route::post('device/fetch-log', [DeviceController::class, 'getFetchLog'])->name('device.fetch.log');
        Route::post('device/update', [DeviceController::class, 'update'])->name('device.update');
        Route::get("get/attendance", [AttendanceController::class, 'getAttendanceFromDevice'])->name('get.attendance.device');

        Route::get('/delete/post/{id}', [SyllabusController::class, 'SyllabusDelete'])->name('syllabus.delete');
        Route::post('/create/post', [SyllabusController::class, 'SyllabusCreatePost'])->name('syllabus.create.post');
        Route::get('/ajax', [AjaxController::class, 'ajaxLoaderSubject'])->name('ajax.load.subject');
        Route::get('/ajax/subject', [AjaxController::class, 'ajaxLoaderSubjectResult'])->name('ajax.load.result.subject');
        Route::get('syllabus/test/create/{id}', [SyllabusController::class, 'SyllabusTestCreate'])->name('syllabus.test.create');
        Route::get('syllabus/test/show/{id}', [SyllabusController::class, 'SyllabusTestshow'])->name('syllabus.test.show');
        Route::get('syllabus/FormShow', [SyllabusController::class, 'SyllabusFormShow'])->name('syllabus.form.show');
        Route::get('syllabus/test/list', [SyllabusController::class, 'SyllabusTestList'])->name('syllabus.test.list');
        Route::post('syllabus/test/update/{id}', [SyllabusController::class, 'SyllabusTestupdate'])->name('syllabus.test.update');

        // library
        Route::get("booksCategory", [LibraryController::class, 'booksType'])->name('books.type.create');
        Route::post("booksCategory/Post", [LibraryController::class, 'booksTypePost'])->name('books.type.post');
        Route::get("booksCreate", [LibraryController::class, 'booksCreate'])->name('books.create');
        Route::post("booksCreate/post", [LibraryController::class, 'booksCreatePost'])->name('books.create.post');
        // Route::get("/{id}", [LibraryController::class, 'booksEdit'])->name('books.edit');
        Route::put("booksCreatePost/{id}", [LibraryController::class, 'booksEditPost'])->name('books.edit.post');
        Route::get("booksDelete/{id}", [LibraryController::class, 'booksDelete'])->name('books.delete');
        Route::delete("/books/Check/delete", [LibraryController::class, 'books_Check_delete'])->name('books.Check.delete');

        Route::get("booksTypeDelete/{id}", [LibraryController::class, 'bookstypeDelete'])->name('books.type.delete');
        Route::patch("booksTyperestore/{id}", [LibraryController::class, 'restoreBookType'])->name('restore.booktype');
        Route::patch("booksType/P/Delete/{id}", [LibraryController::class, 'pdeleteBooktype'])->name('pdelete.booktype');

        Route::patch("books/restore/{id}", [LibraryController::class, 'restoreBook'])->name('restore.book');
        Route::patch("books/P/Delete/{id}", [LibraryController::class, 'pdeleteBook'])->name('pdelete.book');


        //borrowrer
        Route::get('borrowerinfo', [LibraryController::class, 'borrowerinfo'])->name('borrowerinfo');
        Route::get('borrowerCreate', [LibraryController::class, 'borrowerCreate'])->name('borrower.Create');
        Route::post('borrowerstore', [LibraryController::class, 'borrower_store'])->name('borrower.store');
        Route::get('borrowerdelete/{id}', [LibraryController::class, 'borrower_delete'])->name('borrower.delete');
        Route::get('borrowerEdit/{id}', [LibraryController::class, 'borrower_Edit'])->name('borrower.Edit');
        Route::put('borrowerUpdate/{id}', [LibraryController::class, 'borrower_Update'])->name('borrower.Update');

        // borrowrer 
        Route::patch("borrowe/restore/{id}", [LibraryController::class, 'restoreBorrower'])->name('restore.borrower');
        Route::patch("borrower/P/Delete/{id}", [LibraryController::class, 'pdeleteBorrower'])->name('pdelete.borrower');







        Route::resource('roles', RoleController::class);

        Route::post('role/submit', [RoleController::class, 'store'])->name('role.store');

        //Permisson
        Route::get('permission/{id}', [PermissionController::class, 'index'])->name('permission.index');
        Route::post('permission/{role_id}', [PermissionController::class, 'store'])->name('permission.store');


        // settings
        Route::get("user/role/create", [SettingsController::class, 'userRolecreate'])->name('user.role.create');
        Route::post("/update-permission", [RoleController::class, 'roleUpdate'])->name('user.role.update');
        Route::get("user/role/create2", [SettingsController::class, 'userRoleShow'])->name('user.role.show');

        Route::post("user/role/create/post", [SettingsController::class, 'userRolecreatePost'])->name('Userrole.post');
        Route::get("user/role/create/edit/{id}", [SettingsController::class, 'userRoleedit'])->name('Userrole.edit');
        Route::put("user/role/create/edit/post{id}", [SettingsController::class, 'userRoleeditPost'])->name('Userrole.edit');
        Route::get("user/role//delete/{id}", [SettingsController::class, 'Userroledelete'])->name('Userrole.delete');

        Route::get("user/role/create1", [SettingsController::class, 'assignRole'])->name('assign.role');
        Route::post("assign/role/post/{id}", [SettingsController::class, 'assignRolepost'])->name('assign.post');

        Route::get("settings", [SettingsController::class, 'index'])->name('settings');
        Route::post("settings/store", [SettingsController::class, 'store'])->name('settings.store');

        // result setting in setting
        Route::get("settings/show", [SettingsController::class, 'show'])->name('settings.show');
        Route::post("settings/update", [SettingsController::class, 'update'])->name('settings.update');

        //  school period
        Route::resource('period', ClassPeriodController::class);
        Route::get('period/create/{shift?}', [ClassPeriodController::class, 'create'])->name('period.create');
        Route::get('/delete/period/{id}', [ClassPeriodController::class, 'periodDelete'])->name('period.delete');

        Route::get('/restore/period/{id}', [ClassPeriodController::class, 'periodrestore'])->name('restore.period');
        Route::get('par/delete/period/{id}', [ClassPeriodController::class, 'periodDeletepar'])->name('Pdelete.period');


        //  routine
        Route::resource('routine', RoutineController::class)->except(['routine.show']);
        Route::get('routine/show', [RoutineController::class, 'show'])->name('routine.show');
        Route::get('class/routine/edit', [RoutineController::class, 'editRoutine']);
        Route::get('/get/teacher/', [RoutineController::class, 'getTeacher'])->name('get.teacher');
        Route::get('routine/class/shcedule', [RoutineController::class, 'school_Routine_view'])->name('school.Routine.view');

        //class section for school start...
        Route::get('/pdf/{student_id}/{class_id}/{month}/{amount}', [App\Http\Controllers\SchoolController::class, 'pdfShow'])->name('pdf.show');

        Route::get('/payment/details', [App\Http\Controllers\SchoolController::class, 'schoolPaymentShow'])->name('school.payment.info');
        Route::get('/payment/statement/details', [App\Http\Controllers\SchoolController::class, 'schoolPaymentStatementShow'])->name('school.payment.status');
        Route::post('/payment/details/checkout/post', [App\Http\Controllers\PaymentController::class, 'paymentindex'])->name('school.payment.info.school.checkout');
        Route::get('/pdf/statement/{id}', [App\Http\Controllers\SchoolController::class, 'StatementShowSchoolCheckout'])->name('pdf.show.statement.schoolCheckout');


        Route::prefix('class')->group(function () {
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'classCreate'])->name('class.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'classCreatePost'])->name('class.create.post');
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'classShow'])->name('class.show');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'classEdit'])->name('class.edit');
            Route::post('/update/post/{id}', [App\Http\Controllers\SchoolController::class, 'classUpdatePost'])->name('class.update.post');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'classDelete'])->name('class.delete');
            Route::delete('/class Check_/delete', [App\Http\Controllers\SchoolController::class, 'class_Check_Delete'])->name('class.Check.delete');
            Route::get('/restore/class/{id}', [App\Http\Controllers\SchoolController::class, 'restoreclass'])->name('restore.class');
            Route::get('/pdelete/class/{id}', [App\Http\Controllers\SchoolController::class, 'pclassDelete'])->name('Pdelete.class');

            Route::get('/restore/section/{id}', [App\Http\Controllers\SchoolController::class, 'restoreSection'])->name('restore.section');
            Route::get('/pdelete/section/{id}', [App\Http\Controllers\SchoolController::class, 'pSectionDelete'])->name('Pdelete.section');
        });

        //class section for school end...

        //term section for school start...
        Route::prefix('term')->group(function () {
            Route::get('/create', [TermController::class, 'create'])->name('term.create');
            Route::post('/store', [TermController::class, 'store'])->name('term.store');
            Route::get('/index', [TermController::class, 'index'])->name('term.index');
            Route::get('/edit/{id}', [TermController::class, 'edit'])->name('term.edit');
            Route::post('/update/{id}', [TermController::class, 'update'])->name('term.update');
            Route::get('/delete/{id}', [TermController::class, 'destroy'])->name('term.delete');
            Route::delete('/term/check/delete', [TermController::class, 'term_check_delete'])->name('term.check.delete');
        });
        //term section for school end...

        //Section section for school start...
        Route::prefix('section')->group(function () {
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'sectionCreate'])->name('section.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'sectionCreatePost'])->name('section.create.post');
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'sectionShow'])->name('section.show');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'sectionEdit'])->name('section.edit');
            Route::post('/update/post/{id}', [App\Http\Controllers\SchoolController::class, 'sectionUpdatePost'])->name('section.update.post');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'sectionDelete'])->name('section.delete');

            // ajax
            Route::post('/create/post/ajax', [SchoolController::class, 'sectionCreatePostAjax'])->name('save.section.ajax');
        });

        //Section section for school end...

        //group section for school start...
        Route::prefix('group')->group(function () {
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'groupCreate'])->name('group.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'groupCreatePost'])->name('group.create.post');
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'groupShow'])->name('group.show');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'groupEdit'])->name('group.edit');
            Route::post('/update/post/{id}', [App\Http\Controllers\SchoolController::class, 'groupUpdatePost'])->name('group.update.post');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'groupDelete'])->name('group.delete');
            Route::post('/onchange/section/name', [App\Http\Controllers\SchoolController::class, 'showAjaxSection'])->name('admin.show.section');
            Route::get('/group/wise/subject', [SchoolController::class, 'groupWiseSubject'])->name('group.wise.subject');
            Route::post('/save/group/wise/subject', [SchoolController::class, 'saveGroupWiseSubject'])->name('save.group.wise.subject');
        });

        //group section for school end...

        /**-------------    Route for bank add
         * ========================================================*/

        Route::prefix('bankadd')->group(function () {
            Route::get('/list', [App\Http\Controllers\BankController::class, 'show'])->name('bankadd');
            Route::get('/create', [App\Http\Controllers\BankController::class, 'create'])->name('bankadd.create');
            Route::post('/store', [App\Http\Controllers\BankController::class, 'store'])->name('bankadd.store');
            Route::get('/{key}', [App\Http\Controllers\BankController::class, 'edit'])->name('bankadd.edit');
            Route::post('/update/{key}', [App\Http\Controllers\BankController::class, 'update'])->name('bankadd.update');
            Route::get('/delete/{key}', [App\Http\Controllers\BankController::class, 'destroy'])->name('bankadd.delete');
        });

        //subject for school start...
        Route::get("subject", [SubjectController::class, 'index'])->name('subject.index');
        Route::get("subject/show", [SubjectController::class, 'show'])->name('subject.show');
        Route::delete("Subject/Check/Delete", [SubjectController::class, 'Subject_Check_Delete'])->name('Subject.Check.Delete');


        Route::prefix('subject')->group(function () {
            Route::get('/show/{class_id}', [App\Http\Controllers\SchoolController::class, 'subjectShow'])->name('subject.subjectShow');
            Route::get('/create/show', [App\Http\Controllers\SchoolController::class, 'subjectCreateShow'])->name('subject.create.show');
            Route::get('/create/show/post', [App\Http\Controllers\SchoolController::class, 'subjectCreateShowPost'])->name('subject.create.show.post');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'subjectCreatePost'])->name('subject.create.post');
            Route::get('/edit/subject/{id}', [App\Http\Controllers\SchoolController::class, 'subjectEditPost'])->name('subject.edit');
            Route::post('/update/subject/{id}', [App\Http\Controllers\SchoolController::class, 'subjectUpdatePost'])->name('subject.create.update');
            Route::get('/delete/subject/{id}/{class_id}', [App\Http\Controllers\SchoolController::class, 'subjectDeletePost'])->name('subject.delete');
            Route::post('/onchange/group/name', [App\Http\Controllers\SchoolController::class, 'showAjaxGroup'])->name('admin.show.group');
            Route::post('/onchange/subject/name', [App\Http\Controllers\SchoolController::class, 'showAjaxSubject'])->name('admin.show.subject');
            Route::get('/restore/subject/{id}', [App\Http\Controllers\SchoolController::class, 'restoreSubject'])->name('restore.subject');
            Route::get('/pdelete/subject/{id}', [App\Http\Controllers\SchoolController::class, 'pdeletesubject'])->name('Pdelete.subject');
        });

        //subject for school end...

        //department section for school start...

        Route::prefix('department')->group(function () {
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'departmentCreate'])->name('department.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'departmentCreatePost'])->name('department.create.post');
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'departmentShow'])->name('department.show');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'departmentEdit'])->name('department.edit');
            Route::post('/update/post/{id}', [App\Http\Controllers\SchoolController::class, 'departmentUpdatePost'])->name('department.update.post');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'departmentDelete'])->name('department.delete');
        });

        //department section for school start...


        //teacher for school start...

        Route::prefix('teacher')->group(function () {
            Route::post('/active/{id}', [App\Http\Controllers\SchoolController::class, 'teacherActiveInactive'])->name('teacher.active');
            Route::post('/multiple/active/inactive', [SchoolController::class, 'teacher_multiple_ActiveInactive'])->name('teacher.multiple.active');
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'teacherShow'])->name('teacher.Show');
            Route::get('/SingleView/{id}', [App\Http\Controllers\SchoolController::class, 'singleView'])->name('single.view');

            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'teacherCreate'])->name('teacher.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'teacherCreatePost'])->name('teacher.create.post');
            Route::post('/update/{id}', [App\Http\Controllers\SchoolController::class, 'teacherUpdate'])->name('teacher.update');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'teacherDelete'])->name('teacher.delete');
            Route::patch('/restoreteacher/{id}', [SchoolController::class, 'restoreteacher'])->name('restore.teacher');
            Route::PATCH('/Pdeleteteacher/{id}', [SchoolController::class, 'Pdelete_teacher'])->name('Pdelete.teacher');
            Route::delete('/teacher/checkdelete', [App\Http\Controllers\SchoolController::class, 'teacher_Check_Delete'])->name('teacher.Check.Delete');

            Route::post('/show/subject/teacher', [App\Http\Controllers\SchoolController::class, 'getSubjectTeacher'])->name('subject.teacher.show');
            Route::post('teacher/Pass/Edit', [App\Http\Controllers\SchoolController::class, 'teacherPassChange'])->name('change.teacher.pass');
        });


        //teacher for school end...

        Route::prefix('teacher/assign')->group(function () {
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'teacherShow'])->name('teacher.Show');
            Route::get('/create/show', [App\Http\Controllers\SchoolController::class, 'assignCreateShow'])->name('assign.teacher.create.show');
            Route::post('/create/show/post', [App\Http\Controllers\SchoolController::class, 'assignCreateShowPost'])->name('assign.teacher.create.show.post');
            Route::get('/create/show/post/new', [App\Http\Controllers\SchoolController::class, 'assignCreateShowPostNew'])->name('assign.teacher.create.show.post.new');
            Route::post('/create/show/post/data', [App\Http\Controllers\SchoolController::class, 'assignCreateShowPostData'])->name('assign.teacher.create.show.post.data');
            Route::get('/show/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'assignTeacherDataShow'])->name('assign.teacher.dataShow');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'assignTeacherEditShow'])->name('edit.assign.teacher');
            Route::get('/online/class/{id}', [App\Http\Controllers\SchoolController::class, 'onlineClass'])->name('online.class.join');
            Route::post('/onchange/sbject/name', [App\Http\Controllers\SchoolController::class, 'showAjaxSubjects'])->name('admin.show.subjects');
        });

        //staff .....
        Route::prefix('staff')->group(function () {
            Route::get('/show', [App\Http\Controllers\SchoolController::class, 'schoolStaffShow'])->name('school.staff.show');
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'schoolStaffCreate'])->name('school.staff.create');
            Route::get('/edit/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffEdit'])->name('school.staff.edit');
            Route::post('/update/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffUpdate'])->name('school.staff.update');
            Route::get('/type/delete/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffTypeDelete'])->name('school.staffType.delete');
            Route::delete('/stafftype/Check/delete', [SchoolController::class, 'stafftype_Check_delete'])->name('stafftype.Check.delete');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'schoolStaffCreatePost'])->name('school.staff.create.post');

            Route::get('/list', [App\Http\Controllers\SchoolController::class, 'schoolStaffList'])->name('school.staff.List');
            Route::get('/list/edit/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffListEdit'])->name('edit.staff.List.school');
            Route::get('/list/create', [App\Http\Controllers\SchoolController::class, 'schoolStaffListCreate'])->name('school.staff.List.create');
            Route::post('/list/create/post', [App\Http\Controllers\SchoolController::class, 'schoolStaffAddData'])->name('school.staff.List.create.post');
            Route::get('/view/create/{id}', [App\Http\Controllers\SchoolController::class, 'staffview'])->name('staff.view');
            Route::PATCH('/restorestaff/{id}', [SchoolController::class, 'restoreStaff'])->name('restore.staff');
            Route::PATCH('/PDelete/staff/{id}', [SchoolController::class, 'pDeleteStaff'])->name('p.delete.staff');

            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffDelete'])->name('school.staff.delete');
            Route::delete('/staff/checkdelete', [App\Http\Controllers\SchoolController::class, 'staff_Check_Delete'])->name('staff.Check.delete');
            Route::post('/list/create/update/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffListCreateUpdate'])->name('school.staff.List.create.update');
        });

        // Route::prefix('staff-salary')->group(function () {
        //     Route::get('/list', [App\Http\Controllers\SchoolController::class, 'schoolStaffList'])->name('school.staff.salary.List');
        //     Route::post('/update/salary/{id}', [App\Http\Controllers\SchoolController::class, 'schoolStaffSalaryUpdate'])->name('school.staff.salary.update');
        //     Route::get('teacher/show', [App\Http\Controllers\SchoolController::class, 'teacherShow'])->name('teacher.salary.Show');
        //     Route::post('teacher/update/salary', [App\Http\Controllers\SchoolController::class, 'schoolTeacherSalaryUpdate'])->name('school.teacher.salary.update');
        // });

        // staff salary (SHAHIDUL)
        Route::get('/staff-salary/list', [App\Http\Controllers\SchoolController::class, 'schoolStaffList'])->name('school.staff.salary.List');
        Route::get('/staff-salary/history/{stafId}', [SalaryController::class, 'getStaffHistory'])->name('school.staff.salary.history');
        Route::post('/staff-salary/update/salary', [SalaryController::class, 'schoolStaffSalaryUpdate'])->name('school.staff.salary.update');

        // teacher salary (SHAHIDUL)
        Route::get('teacher-salary/show', [App\Http\Controllers\SchoolController::class, 'teacherShow'])->name('teacher.salary.Show');
        Route::get('/teacher-salary/history/{id}', [SalaryController::class, 'getTeacherHistory'])->name('school.staff.salary.history');
        Route::post('teacher-salary/update/salary', [SalaryController::class, 'schoolTeacherSalaryUpdate'])->name('school.teacher.salary.update');
        //teacher for school start...

        Route::post('/send/sms/due/fees', [App\Http\Controllers\SchoolController::class, 'sendFeesDueSms'])->name('send.fees.due.sms');
        Route::get('/send/sms/teacher', [App\Http\Controllers\SchoolController::class, 'sendSmsToTeacher'])->name('send.sms.teacher');
        Route::post('/send/sms/teacher/post', [App\Http\Controllers\SchoolController::class, 'sendSmsToTeacherPost'])->name('send.sms.teacher.post');
        Route::get('/send/sms/employee', [App\Http\Controllers\SchoolController::class, 'sendSmsToEmployee'])->name('send.sms.employee');
        Route::post('/send/sms/employee/post', [App\Http\Controllers\SchoolController::class, 'sendSmsToEmployeePost'])->name('send.sms.employee.post');
        Route::get('/send/sms/student', [App\Http\Controllers\SchoolController::class, 'sendSmsToStudent'])->name('send.sms.student');
        Route::post('/send/sms/student/post', [App\Http\Controllers\SchoolController::class, 'sendSmsToStudentPost'])->name('send.sms.student.post');
        Route::get('/send/sms/purchase', [App\Http\Controllers\SchoolController::class, 'smsPurchase'])->name('send.sms.purchase');

        Route::prefix('student')->group(function () {
            Route::get('/create/show', [App\Http\Controllers\SchoolController::class, 'studentCreateShow'])->name('student.teacher.create.show');

            Route::get('show', [App\Http\Controllers\SchoolController::class, 'findStudents'])->name('student.find');
            Route::get('assign/subject/delete/{id}', [App\Http\Controllers\SchoolController::class, 'assignSubjectDelete'])->name('assign.subject.delete');
            Route::get('data/show/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'assignStudentDataShow'])->name('assign.student.dataShow');

            // Route::get('/show',[App\Http\Controllers\SchoolController::class, 'studentShow'])->name('student.Show');
            Route::get('/create', [App\Http\Controllers\SchoolController::class, 'studentCreate'])->name('student.create');
            Route::post('/create/post', [App\Http\Controllers\SchoolController::class, 'studentCreatePost'])->name('student.create.post');
            Route::post('/update/post/{id}', [App\Http\Controllers\SchoolController::class, 'studentUpdatePost'])->name('student.update.post');
            Route::get('/delete/{id}', [App\Http\Controllers\SchoolController::class, 'studentDelete'])->name('student.delete');
            Route::patch('/restorestudent/{id}', [SchoolController::class, 'restorestudent'])->name('restore.student');
            Route::patch('/Pdeletestudent/{id}', [SchoolController::class, 'Pdelete_student'])->name('Pdelete.student');

            Route::delete('/checkdelete', [App\Http\Controllers\SchoolController::class, 'student_Check_Delete'])->name('student.Check.delete');

            Route::get('/upload', [App\Http\Controllers\SchoolController::class, 'studentUpload'])->name('student.upload');
            Route::post('/upload/post', [App\Http\Controllers\SchoolController::class, 'studentUploadPost'])->name('student.upload.post');
            Route::get('student/singleShow/{id}', [App\Http\Controllers\SchoolController::class, 'singleShow'])->name('student.singleShow');
            Route::post('/student/singlePassword', [App\Http\Controllers\SchoolController::class, 'singlePassword'])->name('student.Password');

            //Attendance
            Route::get('/attendance/show/date/all', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShowDateAll'])->name('student.attendance.show.date.all');
            Route::get('/attendance/show/date', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShowDate'])->name('student.attendance.show.date');

            Route::get('/create/show/post/date/all', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShowPostDateAll'])->name('student.attendance.create.show.post.date.all');
            Route::get('/create/show/post/date', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShowPostDate'])->name('student.attendance.create.show.post.date');
            Route::get('/attendanceshow/{class_id}/{section_id}/{group_id}/{date}', [App\Http\Controllers\SchoolController::class, 'attendanceShowDate'])->name('student.attendanceShowDate');
            Route::get('/all/attendanceshow/{class_id}/{section_id}/{group_id}/{date}', [App\Http\Controllers\SchoolController::class, 'attendanceShowDateAll'])->name('student.attendanceShowDateAll');
            Route::get('/download/pdf/attendance/{class_id}/{section_id}/{group_id}/{date}', [App\Http\Controllers\SchoolController::class, 'exportPdfAttendance'])->name('export.pdf.attendance');
            Route::get('/report/export/attendance/{class_id}/{section_id}/{group_id}/{date}', [App\Http\Controllers\SchoolController::class, 'exportCSVAttendance'])->name('export.report.attendance_data');
            Route::get('/attendance/show', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShow'])->name('student.attendance.show');
            Route::get('/show/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'attendanceShow'])->name('student.attendanceShow');
            Route::get('/create/show/post', [App\Http\Controllers\SchoolController::class, 'studentAttendanceShowPost'])->name('student.attendance.create.show.post');
            Route::post('/attendance/post', [App\Http\Controllers\SchoolController::class, 'attendanceCreatePost'])->name('student.attendance.create.post');
            Route::post('/confirm/absent/present/{id}', [App\Http\Controllers\SchoolController::class, 'confirmAbsentPresent'])->name('confirm.absent.present');

            //Fees

            Route::get('fees/show', [App\Http\Controllers\SchoolController::class, 'studentFeesShow'])->name('student.fees.show');
            Route::get('fees/create', [App\Http\Controllers\SchoolController::class, 'studentFeesCreate'])->name('student.fees.create');
            Route::get('fees/edit/{id}', [App\Http\Controllers\SchoolController::class, 'studentFeesEdit'])->name('student.fees.edit');
            Route::post('fees/update/{id}', [App\Http\Controllers\SchoolController::class, 'studentFeesUpdate'])->name('student.fees.update');
            Route::get('fees/delete/{id}', [App\Http\Controllers\SchoolController::class, 'studentFeesDelete'])->name('student.fees.delete');
            Route::post('fees/create/post', [App\Http\Controllers\SchoolController::class, 'studentFeesCreatePost'])->name('student.fees.create.post');
            Route::post('fees/paid/post', [App\Http\Controllers\SchoolController::class, 'studentPaymentPost'])->name('student.payment.post');
            Route::get('fees/paid/pdf/{student_id}/{paid_amount}/{month_name}', [App\Http\Controllers\SchoolController::class, 'studentMonthlyPaymentDomPdf'])->name('student.monthly.payment.domPDF');

            //finance

            Route::prefix('finance')->group(function () {
                Route::get('/create/show', [App\Http\Controllers\SchoolController::class, 'studentFinanceCreateShow'])->name('student.finance.create.show');
                Route::get('/show', [App\Http\Controllers\SchoolController::class, 'studentFinanceCreateShowNew'])->name('student.finance.create.show.new');
                Route::get('/data/financeshow/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'assignStudentFinanceDataShow'])->name('assign.student.finance.dataShow');
                Route::get('/data/financeshow/{class_id}/{section_id}/{group_id}/{month_name}', [App\Http\Controllers\SchoolController::class, 'assignStudentFinanceDataShowNew'])->name('assign.student.finance.dataShow.new');
                Route::get('/add/fees/{id}/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'studentFinanceAddFees'])->name('add.fees.show');
                Route::get('/edit/fees/{id}/{student_id}/{class_id}/{section_id}/{group_id}', [App\Http\Controllers\SchoolController::class, 'studentFinanceEditFees'])->name('edit.fees.show');
                Route::post('/update/fees/{id}', [App\Http\Controllers\SchoolController::class, 'studentFinanceUpdateFees'])->name('update.fees.show');

                //expenses
                Route::delete('/expense/check/delete', [ExpenseController::class, 'expense_check_delete'])->name('expense.check.delete');
                Route::get('/expense/show', [App\Http\Controllers\ExpenseController::class, 'expenseShow'])->name('expense.show');
                Route::get('/expense/list', [App\Http\Controllers\ExpenseController::class, 'expenselist'])->name('expense.list');
                Route::get('/fund/list', [App\Http\Controllers\ExpenseController::class, 'AllFundlist'])->name('fund.list');

                Route::get('/expense/create/{expenseFund}', [App\Http\Controllers\ExpenseController::class, 'expensecreate'])->name('expense.create');
                Route::post('/expense/store', [App\Http\Controllers\ExpenseController::class, 'expensestore'])->name('expense.store');
                Route::get('/expense/{key}', [App\Http\Controllers\ExpenseController::class, 'expenseedit'])->name('expense.edit');
                Route::post('/expense/update', [App\Http\Controllers\ExpenseController::class, 'expenseupdate'])->name('expense.update');
                Route::get('/expense/delete/{key}', [App\Http\Controllers\ExpenseController::class, 'expensedestroy'])->name('expense.delete');

                //fund
                Route::get('/fund/show', [App\Http\Controllers\ExpenseController::class, 'fundlist'])->name('fund.show');
                Route::delete('/fund/check/delete', [ExpenseController::class, 'fund_check_delete'])->name('fund.check.delete');

                Route::get('/student/fee/scholarship/{key}/{status}', [FinanceController::class, 'scholarshipStatus'])->name('scholarship.status');
                Route::put('/school/finance/student/school/scholarship/{id}', [FinanceController::class, 'studentSchoolScholarship'])->name('student.school.scholarship');

                // Sutdent finance status
                Route::get('/student/status', [FinanceController::class, 'studentFinanceStatus'])->name('student.finance.status');
                Route::get('/student/status/class', [FinanceController::class, 'classWiseStudentFinnance'])->name('class.wise.student.finance.status');
            });


            Route::get('result/create/setting', [ResultSetting::class, 'createSetting'])->name('show.create.setting');
            Route::get('result/setting/all', [ResultSetting::class, 'resultSettingAll'])->name('result.setting.all');
            Route::post('result/save/create/setting', [ResultSetting::class, 'saveSetting'])->name('save.result.setting');
            Route::post('result/update/create/setting', [ResultSetting::class, 'updateSetting'])->name('update.result.setting');
            Route::get('result/setting/delete/{id}', [ResultSetting::class, 'deleteSetting'])->name('delete.result.setting');
            Route::get('result/setting/edit/{id}', [ResultSetting::class, 'editResultSetting'])->name('edit.result.setting');
            Route::get('just/result/setting/edit/{id}', [ResultSetting::class, 'justEditResultSetting'])->name('just.edit.result.setting');
            Route::get('result/create/show', [App\Http\Controllers\SchoolController::class, 'resultCreateShow'])->name('result.school.admin.create.show');
            Route::get('result/create/show/all', [App\Http\Controllers\SchoolController::class, 'resultCreateShow'])->name('result.school.admin.create.show.all');
            Route::get('/result/setting/duplicate/{id}', [ResultSetting::class, 'duplicateResultSetting'])->name('duplicate.result.setting');
            Route::get('result/upload/first/all/step/{id}', [App\Http\Controllers\SchoolController::class, 'resultUpFirstStep'])->name('result.up.first.step');
            Route::get('result/create/show/post', [App\Http\Controllers\SchoolController::class, 'resultCreateShowPost'])->name('result.school.create.show.post');
            Route::get('result/data/show/{class_id}/{section_id}/{subject_id}/{term_id}', [App\Http\Controllers\SchoolController::class, 'resultStudentDataShow'])->name('school.result.dataShow');
            Route::get('all/result/data/show/{class_id}/{section_id}/{term_id}', [App\Http\Controllers\SchoolController::class, 'resultStudentDataShowAll'])->name('school.result.dataShowAll');
            Route::post('result/create/post', [App\Http\Controllers\SchoolController::class, 'resultCreatePost'])->name('result.create.post');
            Route::get('result/mark/{id}', [App\Http\Controllers\SchoolController::class, 'resultmarkSet'])->name('result.mark.set');
            Route::post("result/mark/store", [ResultSetting::class, 'storeSubjectMark'])->name("store.subject.mark");
            Route::get("result/mark/single/store", [ResultSetting::class, 'storeSingleSubjectMark'])->name("store.single.subject.mark");
            Route::get("result/pdf", [ResultSetting::class, 'resultPdf'])->name("result.pdf");
            Route::post("result/pdf/download", [ResultSetting::class, 'resultPdfDownload'])->name("result.pdf.download");
            Route::get('result/restore/{id}', [ResultSetting::class, 'resultrestore'])->name('restore.result');
            Route::get('result/permanent/delete/{id}', [ResultSetting::class, 'pdeleteresult'])->name('Pdelete.result');

            Route::get('resultSetting/restore/{id}', [ResultSetting::class, 'resultSettingrestore'])->name('restore.resultSetting');
            Route::get('resultSetting/permanent/delete/{id}', [ResultSetting::class, 'pdeleteresultSetting'])->name('Pdelete.resultSetting');


            Route::get('resultCountable/restore/{id}', [ResultSetting::class, 'resultCountablemarkrestore'])->name('restore.resultCountablemark');
            Route::get('resultCountable/permanent/delete/{id}', [ResultSetting::class, 'pdeleteresultCountablemark'])->name('Pdelete.resultCountablemark');
            // Ajax with result
            Route::get('result/setting/delete/{id}', [ResultSetting::class, 'deleteSetting'])->name('delete.result.setting');
            Route::get('/result/setting/show', [ResultSetting::class, 'showResultSetting'])->name('show.last.result.setting');
            //Ajax Get With Section
            Route::get('get/section/ajax/{id}', [ResultSetting::class, 'getSectionWithAjax'])->name('get.section.ajax');

            //Notice Route Start
            Route::delete('notice/checkall/delete', [App\Http\Controllers\SchoolController::class, 'notice_Check_Delete'])->name('notice.Check.delete');
            Route::get('notice/delete/{id}', [App\Http\Controllers\SchoolController::class, 'noticeCreateDelete'])->name('notice.delete');
            Route::get('notice', [App\Http\Controllers\SchoolController::class, 'noticeCreateShow'])->name('notice.school.admin.create.show');
            Route::get('notice/create', [App\Http\Controllers\SchoolController::class, 'noticeCreate'])->name('notice.school.admin.create');
            Route::post('notice/post', [App\Http\Controllers\SchoolController::class, 'noticeCreatePost'])->name('notice.school.admin.create.post');
            //Notice Route End

            //Mark Types Start Saj
            Route::get('/mark/type/create/show/{id}', [MarkController::class, 'index'])->name('show.mark.type');

            Route::post('/mark/type/create', [MarkController::class, 'markTypeCreate'])->name('school.mark.type.create');
            Route::post('/manual/mark/type/store', [MarkController::class, 'manualMarkTypeStore'])->name('maunal.mark.type.store');
            Route::post('/mark/type/store', [MarkController::class, 'store'])->name('mark.type.store');
            //Mark Types End

            //Start Class and Student Wise Result
            Route::get('/class/wise/result', [ResultController::class, 'classWiseResult'])->name('class.wise.result');
            Route::post('show/class/wise/result', [ResultController::class, 'showClassWiseResult'])->name('show.class.wise.result');
            Route::post('/class/wise/user', [ResultController::class, 'classWiseUser'])->name('class.wise.user');

            // Save with ajax single student absent in result table
            Route::get('absent/student/result/', [ResultController::class, 'studentResultAbsent'])->name('student.result.absent');
            //End Class and Student Wise Result

            //School Exam Route Start
            Route::get('/exam/routine/create', [ExamController::class, 'examRoutine'])->name('exam.routine.create');
            //Start Ajax for exam Controller
            Route::get('get/subjet/{id}', [ExamController::class, 'getSubject']);
            Route::get('get/routine/{id}/{term_id}/{shift?}', [ExamController::class, 'getRoutine']);
            Route::post('store/exam/routine', [ExamController::class, 'storeExamRoutine']);
            Route::get('delete/exam/routine/{id}', [ExamController::class, 'deleteExamRoutine']);
            //End Ajax for exam Controller
            Route::get('/create/exam/routine/pdf/{id}/{term_id}', [ExamController::class, 'generatePdf']);
            //School Exam Route End

            //Mcqinput

            //Notice Route Start
            Route::get('mcq/index', [QuestionController::class, 'mcq_index'])->name('mcq.index');
            //Notice Route End
        });

        //----------------Question Route Start----------------

        Route::get('/create/question/index', [QuestionController::class, 'index'])->name('create.question.show');
        Route::post('ckeditor/image_upload', [QuestionController::class, 'imageUpload'])->name('ckeditor.image.upload');
        Route::post('/create/question/store', [QuestionController::class, 'questionStore'])->name('question.store');
        Route::get('/show/question', [QuestionController::class, 'showQuestion'])->name('show.question');
        Route::get('/show/question/searchpage', [QuestionController::class, 'Question_searchpage'])->name('question.searchpage');
        Route::get('/show/question/classpage/{term_id}', [QuestionController::class, 'Question_classpage'])->name('question.classpage');

        // admitCard
        Route::get('/show/admit/card', [ExamController::class, 'showAdmitCard'])->name('show.admit.card');
        Route::post('/show/admit/card/download', [ExamController::class, 'showAdmitCardDownload'])->name('show.admit.card.download');

        // sitPlan
        Route::get('/show/sit/plan', [ExamController::class, 'showSitPlan'])->name('show.sit.plan');
        Route::post('/show/sit/plan/download', [ExamController::class, 'showSitPlanDownload'])->name('show.sit.plan.download');

        //Ajax
        Route::get('/view/single/question/{id}', [QuestionController::class, 'viewSingleQuestion'])->name('view.single.question');
        Route::get('/term/wiese/question/{id}', [QuestionController::class, 'termWiseQuestion'])->name('term.wise.question');
        Route::get('/ajax/delete/question/{id}', [QuestionController::class, 'ajaxDeleteQuestion'])->name('term.wise.question');
        Route::post('/ajax/question/store', [QuestionController::class, 'ajaxQuestionStore']);
        //Ajax

        Route::get('/view/mcq/creative/question/{id}', [QuestionController::class, 'viewMcqCreativeQuestion'])->name('view.mcq.creative.question');
        Route::get('/edit/question/{id}', [QuestionController::class, 'editQuestion'])->name('edit.question');
        Route::post('/update/question/{id}', [QuestionController::class, 'updateQuestion'])->name('update.question');
        Route::get('/delete/question/{id}', [QuestionController::class, 'deleteQuestion'])->name('delete.question');
        Route::delete('/question/check/delete', [QuestionController::class, 'Question_check_delete'])->name('Question.check.delete');
        Route::get('/pdf/question/{id}', [QuestionController::class, 'pdfQuestion'])->name('pdf.question');
        Route::get('/restore/Question/{id}', [QuestionController::class, 'restoreQuestion'])->name('restore.question');
        Route::get('/pDelete/Question/{id}', [QuestionController::class, 'PdeleteQuestion'])->name('Pdelete.admission');


        Route::get('/Question BankPage', [QuestionController::class, 'QuestionBankPage'])->name('Question.BankPage');
        Route::get('/Question BankClass', [QuestionController::class, 'QuestionBankClass'])->name('Question.BankClass');
        //----------------Question Route End------------------



        //Notice Route Start
        // Route::get('/notice/view', [NoticeViewController::class, 'index'])->name('show.notice');
        Route::get('/notice/view', [NoticeViewController::class, 'index'])->name('show.notice'); //Ofcourse need this route sajjad    
        Route::post('/student/login', [NoticeViewController::class, 'studentLoginController'])->name('student.login');
        //Notice Route End

        Route::post('/term/wise/result', [NoticeViewController::class, 'termWiseResult'])->name('show.term.wise.result');
        Route::post('/notice/by/student/logged', [NoticeViewController::class, 'studentLoginController'])->name('student.login');
    
        
        
        
        // School Website Setting
        Route::get('/website/setting', [WebsiteController::class, 'index'])->name('school.website');
        Route::post('/website/setting/about/post', [WebsiteController::class, 'createAboutPost'])->name('school.website.about.post');
        Route::post('/website/setting/post', [WebsiteController::class, 'createPost'])->name('school.website.speech.post');
        Route::post('/website/setting/govorning/post', [WebsiteController::class, 'createGoverPost'])->name('school.website.gover.post');
        Route::get('/website/setting/govorning/delete/{id}', [WebsiteController::class, 'Goverdelete'])->name('school.website.gover.delete');
        Route::get('/website/setting/blog/show', [WebsiteController::class, 'blogShow'])->name('school.website.blog.show');
        Route::get('/website/setting/blog', [WebsiteController::class, 'blog'])->name('school.website.blog');
        Route::post('/website/setting/blog/post', [WebsiteController::class, 'blogPost'])->name('school.website.blog.post');
        Route::get('/website/setting/blog/edit/{id}', [WebsiteController::class, 'blogEdit'])->name('webBlog.edit');
        Route::post('/website/setting/blog/Update/{id}', [WebsiteController::class, 'blogUpdate'])->name('school.website.blog.update');
        Route::get('/website/setting/blog/delete/{id}', [WebsiteController::class, 'blogDelete'])->name('webBlog.delete');
        Route::get('/website/setting/image', [WebsiteController::class, 'image'])->name('school.website.image');
        Route::post('/website/setting/image/post', [WebsiteController::class, 'imagePost'])->name('school.website.image.post');
        Route::get('/website/setting/gallery/delete/{id}', [WebsiteController::class, 'Gallerydelete'])->name('school.website.gallery.delete');
        Route::get('/website/setting/slider/delete/{id}', [WebsiteController::class, 'Sliderdelete'])->name('school.website.slider.delete');
    });

/** ----------- Online Admission Form (SUNNAH)
 * ================================================================*/
Route::get('/online/admission/form/{unique_id}', [OnlineAddmissionController::class, 'onlineAdmissionForm'])->name('online.Admission.Form')->middleware('language');
Route::post('/online/admission/form/post', [OnlineAddmissionController::class, 'onlineAdmissionFormPost'])->name('online.Admission.Form.Post');
Route::get('/online/admission/submited', [OnlineAddmissionController::class, 'onlineAdmissionsubmited'])->name('online.Admission.submited');


Route::middleware(['auth', 'language', 'UnderMaintenance'])
    ->prefix('school')
    ->group(function () {
        Route::get('/online/admission/formList', [OnlineAddmissionController::class, 'onlineAdmissionFormList'])->name('online.Admission.Form.list')->middleware('language');
        Route::get('/online/admission/singleShow/{id}', [OnlineAddmissionController::class, 'onlineAdmissionSingleShow'])->name('online.Admission.Single.Show');
        Route::get('/online/admission/edit/{id}', [OnlineAddmissionController::class, 'onlineAdmissionEdit'])->name('online.Admission.Edit');
        Route::put('/online/admission/editPost/{id}', [OnlineAddmissionController::class, 'onlineAdmissionEditPost'])->name('online.Admission.Edit.Post');
        Route::get('/online/admission/delete/{id}', [OnlineAddmissionController::class, 'onlineAdmissionDelete'])->name('online.Admission.Delete');
        Route::delete('/online/admission/Check/delete', [OnlineAddmissionController::class, 'onlineAdmission_Check_Delete'])->name('online.Admission.Check.Delete');
    });
//** ====================== Online Admission end here  ======================*/


/** ----------- School Accesories Type (SUNNAH)
 * ================================================================*/
Route::middleware(['auth', 'language', 'UnderMaintenance'])
    ->group(function () {
        Route::get('/receipt/show', [App\Http\Controllers\ExpenseController::class, 'receipt'])->name('reciept.create');
        Route::get('/receipt/delete/{id}', [App\Http\Controllers\ExpenseController::class, 'receiptDelete'])->name('receipt.delete');
        Route::put('/receipt/edit/{id}', [App\Http\Controllers\ExpenseController::class, 'receiptHistoryEdit'])->name('receipt.history.edit');
        Route::get('/getPrice/{id}', [App\Http\Controllers\ExpenseController::class, 'getPrice'])->name('getPrice');
        Route::get('/receipt/Show', [App\Http\Controllers\ExpenseController::class, 'receiptShow'])->name('receipt.Show')->middleware('language');
        Route::post('/ajax/accesories/', [AjaxController::class, 'ajaxLoaderaccesories'])->name('ajax.load.accesories');
        Route::get('/accesories/create', [App\Http\Controllers\ExpenseController::class, 'accesoriesType'])->name('accesoriesType');
        Route::put('/accesories/edit/post/{id}', [App\Http\Controllers\ExpenseController::class, 'accesoriesEditPost'])->name('accesoriesType.edit.post');
        Route::post('/accesories/create/post', [App\Http\Controllers\ExpenseController::class, 'accesoriesTypePost'])->name('accesoriesType.post');
        Route::get('/accesories/list', [App\Http\Controllers\ExpenseController::class, 'accesoriesTypeList'])->name('accesoriesType.list');
        Route::post('/ajax/accesories/transaction', [AjaxController::class, 'ajaxAccesorisTransaction'])->name('ajax.load.accesories.transaction');
        Route::get('/ajax/section', [AjaxController::class, 'ajaxLoaderSection'])->name('ajax.load.section');
    });

//** ====================== School Accesories Type end here  ======================*/


/** ----------- Finance ===> School Panel (SHAHIDUL)
 * ================================================================*/
Route::middleware(['auth', 'language', 'UnderMaintenance'])
    ->name('school.finance.')
    ->group(function () {
        Route::get('/school/finance/dashboard', [FinanceController::class, 'dashboard'])->name('dashoboard');
        Route::resource('/school/finance/fees', FinanceController::class)->names(['as' => 'fees']);

        // school Fees
        Route::get("school/finance/school-fees", [SchoolFeesController::class, 'index'])->name('schoolFees');
        Route::post("school/finance/school-fees-create", [SchoolFeesController::class, 'createSchoolFees'])->name('schoolFees.create');
        Route::post("school/finance/school-fees/store", [SchoolFeesController::class, 'storeSchoolFees'])->name('schoolFees.store');
        Route::post("school/finance/school-fees/destory", [SchoolFeesController::class, 'destorySchoolFees'])->name('schoolFees.destroy');

        Route::post('/school/finance/fees/update', [FinanceController::class, 'update'])->name('fees.update');
        Route::get('/school/delete/finance/fees/title/{id}', [FinanceController::class, 'financeTitleDelete'])->name('fees.title.delete');

        // assign fees
        Route::get("school/assign/fees", [AssignFeesController::class, 'index'])->name('assign.fees.index');
        Route::get("school/assigned/fees", [AssignFeesController::class, 'assignedFees'])->name('assigned.fees.get');
        Route::post("school/assigned/fees/delete", [AssignFeesController::class, 'assignedFeesDelete'])->name('assigned.fees.get');
        Route::post("school/assign/fees", [AssignFeesController::class, 'store'])->name('assign.fees.store');

        // collected fees
        Route::get('/school/finance/collect/fees', [CollectFeesController::class, 'userList'])->name('userlist');
        Route::post('/school/finance/collect/fees', [CollectFeesController::class, 'collectFees'])->name('collect.fees');
        Route::get('/school/finance/collect/fees/userInfo', [CollectFeesController::class, 'getUserInfo'])->name('userInfo.get');
        Route::get('/school/finance/collected-fees/get', [CollectFeesController::class, 'showCollectedFees'])->name('collected.fees.show');

        Route::post('/onclick/filter/amount', [FinanceController::class, 'showAjaxfilter'])->name('dashoboard.filtered');
        Route::post('/onclick/filter/amount', [FinanceController::class, 'showAjaxfilterMonthly'])->name('dashoboard.filtered.monthly');
    });





/** ---------- attendance (SHAHIDUL)
 * =========================================================*/
Route::middleware(['auth', 'language'])
    ->name('school.attendance.')
    ->group(function () {
        Route::post("school/attendance/file/uplaod", [AttendanceController::class, 'uploadAttendance'])->name('upload');
        Route::get('school/attendance/report/{userType}/{id}', [AttendanceReportController::class, 'reportOfUser'])->name('report.user');
        Route::get('school/attendance/report', [AttendanceReportController::class, 'report'])->name('report');
    });

/** ========================= attendance ==================== */



/** ----------- Transfer and testimonial certificate (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->prefix('school/student/')
    ->group(function () {
        Route::get('Transfer/{id}', [CertificateController::class, 'Transfer'])->name('Transfer');
    });
//** ====================== Transfer and testimonial certificate end here  ======================*/



/** ----------- Addon checkout page (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->group(function () {
        Route::get('school/addons', [AddonController::class, 'SchoolAddon'])->name('SchoolAddon');
        Route::post('school/addon/checkout', [AddonController::class, 'SchoolAddonCheckout']);
        Route::post('school/addon/purchase', [AddonController::class, 'SchoolAddonPurchase'])->name('SchoolAddon.Purchase');
    });
//** ====================== Addon checkout page end here  ======================*/


/** ----------- Document of Student (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->prefix('school/student/')
    ->group(function () {
        Route::post('documentpost', [StudentController::class, 'documentpost'])->name('document.post');
        Route::get('document/delete/{id}', [StudentController::class, 'document_delete'])->name('document.delete');
        Route::get('document/download/{uploadfile}', [StudentController::class, 'document_download'])->name('document.download');
        Route::get('document/view/{id}', [StudentController::class, 'document_view'])->name('document.view');
    });
//** ====================== Document of Student here end here  ======================*/



/** ----------- Attendance of Staff start  (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->prefix('school/Staff/')
    ->group(function () {
        Route::get('StaffAttendancePage', [AttendanceController::class, 'StaffAttendancePage'])->name('StaffAttendancePage');
        Route::get('StaffAttendance/Date', [AttendanceController::class, 'StaffAttendance_DatePost'])->name('StaffAttendance.DatePost');
        Route::get('Staff/Attendance/{date}', [AttendanceController::class, 'StaffAttendance'])->name('StaffAttendance');
        Route::post('StaffAttendance/post', [AttendanceController::class, 'StaffAttendance_post'])->name('StaffAttendance.post');
        Route::post('StaffAttendance/confirm-absent-present/{id}', [AttendanceController::class, 'Staff_confirmabsentpresent'])->name('Staff.confirmabsentpresent');
        Route::get('StaffAttendance/All/View', [AttendanceController::class, 'StaffAttendance_AllView'])->name('StaffAttendance.AllView');
        Route::get('StaffAttendance/AllView/Post', [AttendanceController::class, 'StaffAttendance_AllView_Post'])->name('StaffAttendance.AllView.Post');
        Route::get('StaffAttendance/Month/{date}', [AttendanceController::class, 'StaffAttendance_Month'])->name('StaffAttendance.Month');
    });
//** ====================== Attendance of Staff end here  ======================*/



/** ----------- Attendance of Teacher start  (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->prefix('school/Teacher/')
    ->group(function () {
        Route::get('datepage', [AttendanceController::class, 'Teacher_datepage'])->name('Teacher.datepage');
        Route::get('datepage/post', [AttendanceController::class, 'datepage_post'])->name('datepage.post');
        Route::get('TeacherView/Attendance/page/{date}', [AttendanceController::class, 'TeacherAttendance_page'])->name('TeacherAttendance.page');
        Route::post('TeacherAttendance/post', [AttendanceController::class, 'TeacherAttendance_post'])->name('TeacherAttendance.post');
        Route::get('TeacherAttendance/All/View', [AttendanceController::class, 'TeacherAttendance_AllView'])->name('TeacherAttendance.AllView');
        Route::get('TeacherAttendance/Viewpost', [AttendanceController::class, 'TeacherAttendance_Viewpost'])->name('TeacherAttendance.Viewpost');
        Route::get('Teacher-Attendance-Month/{date}', [AttendanceController::class, 'TeacherAttendance_Month'])->name('TeacherAttendance.Month');
        Route::post('TeacherAttendance/confirmabsentpresent/{id}', [AttendanceController::class, 'Teacher_confirmabsentpresent'])->name('Teacher.confirmabsentpresent');
    });
//** ====================== Attendance of Teacher end here  ======================*/


/** ----------- Recycle Bin of School  (LIZA)
 * ================================================================*/
Route::middleware('auth', 'language')
    ->prefix('school/Recycle/')
    ->group(function () {
        Route::get('Recyclepage', [SettingsController::class, 'Recyclepage'])->name('Recyclepage');
    });


// School Ticket Create
Route::middleware('auth', 'language')
    ->prefix('school/support')
    ->group(function () {
        Route::get('/token/create/support', [TicketController::class, 'ticketCreateSchool'])->name('ticketCreate.school');
        Route::post('/token/create/post', [TicketController::class, 'tokenCreatePost'])->name('token.create.post');
        Route::get('/token/reply/page', [TicketController::class, 'tokenReplyPage'])->name('token.reply.page');
        Route::post('/token/reply/post', [TicketController::class, 'tokenreplyPost'])->name('tokenReply.create.post');
        Route::get('/token/load/message/show/{id}', [TicketController::class, 'tokenLoadShow'])->name('ticketmessage.load.show');
        Route::get('/deletes/ticket/{id}', [TicketController::class, 'ticketDeleteSchool'])->name('ticket.delete');
        Route::get('/latest/ticket/{id}', [TicketController::class, 'ticketlatestMessageSchool'])->name('ticket.latest.message');
    });


Route::middleware('auth', 'language')
    ->prefix('school/support/')
    ->group(function () {
        Route::get('/ticket/message/show/{id}', [TicketController::class, 'ticketmessageshow'])->name('ticketmessage.show');
        // Route::get('/ticket/message/show/admin/{id}', [TicketController::class, 'ticketmessageshowadmin'])->name('ticketmessage.show.admin');
        Route::get('/ticket/create', [TicketController::class, 'SupportTicketCreate'])->name('support.ticket.create');
        Route::get('/ticket/message/', [TicketController::class, 'ticketmessage'])->name('ticketmessage.create');
        Route::post('/ticket/message/post', [TicketController::class, 'ticketmessagePost'])->name('ticketmessage.create.post');
        Route::get('/ticket/message/list/', [TicketController::class, 'ticketmessagelist'])->name('ticketmessage.list');
        Route::get('/ticket/message/reply/{id}', [TicketController::class, 'ticketreply'])->name('ticket.reply');
        Route::post('/ticket/message/reply/post/{id}', [TicketController::class, 'ticketreplyPost'])->name('ticket.reply.post');
        Route::post('/ticket/post', [TicketController::class, 'SupportTicketPost'])->name('support.ticket.post');
    });

Route::middleware('auth', 'language')->group(function () {

    Route::PATCH('/school/finance/feerestore/{id}', [FinanceController::class, 'feerestore'])->name('restore.fee');
    Route::get('/school/finance/assignFessrestore/{id}', [FinanceController::class, 'assignFessrestore'])->name('restore.assignFess');
    Route::get('/school/finance/staffSalaryrestore/{id}', [FinanceController::class, 'staffSalaryrestore'])->name('restore.staffSalary');
    Route::get('/school/finance/TeacherSalaryrestore/{id}', [FinanceController::class, 'TeacherSalaryrestore'])->name('restore.TeacherSalary');
    Route::PATCH('/school/finance/expenserestore/{id}', [FinanceController::class, 'expenserestore'])->name('restore.expense');
    Route::PATCH('/school/finance/fundrestore/{id}', [FinanceController::class, 'fundrestore'])->name('restore.fund');
    Route::PATCH('/school/finance/studentMontyFeerestore/{id}', [FinanceController::class, 'studentMonthlyFeerestore'])->name('restore.studentMonthlyFee');

    Route::get('/school/finance/assignFesspdelete/{id}', [FinanceController::class, 'assignFesspdelete'])->name('pdelete.assignFess');
    Route::PATCH('/school/finance/feepdelete/{id}', [FinanceController::class, 'feepdelete'])->name('pdelete.fee');
    Route::get('/school/finance/staffSalarypdelete/{id}', [FinanceController::class, 'staffSalarypdelete'])->name('pdelete.staffSalary');
    Route::get('/school/finance/TeacherSalarypdelete/{id}', [FinanceController::class, 'TeacherSalarypdelete'])->name('pdelete.TeacherSalary');
    Route::PATCH('/school/finance/expensepdelete/{id}', [FinanceController::class, 'expensepdelete'])->name('pdelete.expense');
    Route::PATCH('/school/finance/fundpdelete/{id}', [FinanceController::class, 'fundpdelete'])->name('pdelete.fund');
    Route::PATCH('/school/finance/studentMonthlyFeepdelete/{id}', [FinanceController::class, 'studentMonthlyFeepdelete'])->name('pdelete.studentMonthlyFee');

    Route::get('/restore/Question/{id}', [QuestionController::class, 'restoreQuestion'])->name('restore.question');
    Route::get('/pDelete/Question/{id}', [QuestionController::class, 'PdeleteQuestion'])->name('Pdelete.admission');
    Route::PATCH('/restorAdmission/{id}', [OnlineAddmissionController::class, 'restoreAdmission'])->name('restore.admission');
    Route::PATCH('/pdeleteAdmission/{id}', [OnlineAddmissionController::class, 'pDeleteAdmission'])->name('Pdelete.admission');
});

//** ====================== End Recycle Bin of School  ======================*/

/** ---------- upload attendance (LIZA)
 * =========================================================*/
Route::middleware(['auth', 'language'])
    ->group(function () {
        Route::get("/student/attendance/list", [AttendanceController::class, 'Studentdetailsdashboard'])->name('StudentDetailsDashboard');
        Route::get("/teacher/attendance/list", [AttendanceController::class, 'teacherAttendanceDashboard'])->name('teacherDetailsDashboard');
        Route::get("/student/attendance/dashboard/", [AttendanceController::class, 'Attendance_dashboard'])->name('Attendance.dashboard');
        Route::get("/student/attendance/profile/", [AttendanceController::class, 'Attendance_profile'])->name('Attendance.profile');
    });

/** ========================= upload attendance ==================== */


/** ----------- Billing of school  (LIZA)
 * ================================================================*/
Route::middleware(['auth', 'language', 'UnderMaintenance'])->group(function () {
    Route::get("/school/billing", [SettingsController::class, 'school_billing'])->name('school.billing');
});
/** ========================= Billing of school  ==================== */


/** ----------- pricing  into the school  (LIZA)
 * ================================================================*/
Route::middleware(['auth', 'language', 'UnderMaintenance'])
    ->group(function () {
        Route::get("/school/Transaction", [SettingsController::class, 'billing_transaction'])->name('school.billingtransaction');
        Route::post("/school/TransactionStore", [SettingsController::class, 'billing_transaction_Store'])->name('school.billingtransaction.Store');
    });
/** ========================= end of pricing into the school  ==================== */

Route::get("/summary/system/{id}", [SummaryController::class, 'summaryMail'])->name('summary.mail');
Route::get("/summary/view", [SummaryController::class, 'summaryMailview'])->name('summary.mail');
Route::get('/get-all-students-results/{final_wise_class_id}/{final_student_wise_student_id}/{term_id}', [ResultController::class, 'get_all_students_results']);

//Cache Clear (sazzad)
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    toast("All Cache Clear", "success");
    return redirect()->back();
});

// down all site
Route::get('/admin/down', function () {
    Artisan::call('down');
    return redirect('/');
})->name('server.down');