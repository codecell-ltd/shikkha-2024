<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\School;
use App\Models\Transection;
use Illuminate\Http\Request;

use App\Models\TeacherSalary;
use Illuminate\Http\Response;
use App\Models\AccesoriesType;
use App\Models\EmployeeSalary;
use App\Models\InstituteClass;
use App\Models\StudentMonthlyFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AccesoriesTransaction;
use RealRashid\SweetAlert\Facades\Alert;


class ExpenseController extends Controller
{
    //expense show 

    public function expenseShow(Request $request)
    {
        if (hasPermission('expense_show')) {

            $seoTitle = 'Expenses Show';
            $seoDescription = 'Expenses Show';
            $seoKeyword = 'Expenses Show';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {

                $date = $request;
                if (isset($request->searchdate)) {
                    if (isset($request->enddate)) {
                        $searchdate = $request->searchdate;
                        $enddate = $request->enddate;
                        $expense = Transection::where('school_id', authUser()->id)->where('status', true)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', 1)->orderBy('created_at', 'Desc')->get();
                        $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', 1)->sum('amount');
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.expense.table')->with(compact('expense', 'sumFund', 'defaultDate', 'enddate', 'searchdate', 'seo_array'));
                    } else {
                        $searchdate = $request->searchdate;
                        $expense = Transection::where('school_id', authUser()->id)->where('status', true)->wheredate('datee', $request->searchdate)->where('type', 1)->orderBy('created_at', 'Desc')->get();
                        $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->wheredate('datee', $request->searchdate)->where('type', 1)->sum('amount');
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.expense.table')->with(compact('expense', 'sumFund', 'defaultDate', 'searchdate', 'seo_array'));
                    }
                } elseif (isset($request->searchmonth)) {

                    $transectionMonth = Transection::where('school_id', authUser()->id)->where('status', true)->orderBy('created_at', 'asc')->get();
                    $searchmonth = $request->searchmonth;
                    $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->whereMonth('datee', $request->searchmonth)->where('type', 1)->sum('amount');
                    $expense = Transection::where('school_id', authUser()->id)->where('status', true)->whereMonth('datee', $request->searchmonth)->where('type', 1)->orderBy('created_at', 'Desc')->get();
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    return view('frontend.school.expense.table')->with(compact('sumFund', 'expense', 'searchmonth', 'defaultDate', 'seo_array'));
                } else {

                    $expense = Transection::where('school_id', authUser()->id)->where('status', true)->where('type', 1)->latest()->get();
                    $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->where('type', 1)->sum('amount');
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    return view('frontend.school.expense.table', compact('expense', 'sumFund', 'defaultDate', 'seo_array'));
                }
            }
        } else {
            return back();
        }
    }

    //expense list show
    public function expenselist(Request $request)
    {
        if (hasPermission('Expense List Show|Expense Show|Expense Create|')) {
            $seoTitle = 'Expenses List';
            $seoDescription = 'Expenses List';
            $seoKeyword = 'Expenses List';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $date = $request;
                if (isset($request->searchdate)) {
                    if (isset($request->enddate)) {
                        $expenses = Transection::where('school_id', authUser()->id)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', '=', '1')->where('amount', '!=', '0')->orderBy('datee', 'Desc')->paginate(20);
                        $teacher = TeacherSalary::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                        $sum = TeacherSalary::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('amount', '!=', '0')->sum('amount');
                        $sumstaff = EmployeeSalary::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('amount', '!=', '0')->sum('amount');
                        $sumexpenses = Transection::where('school_id', authUser()->id)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', '=', '1')->where('amount', '!=', '0')->sum('amount');
                        $data = [
                            'sum' => $sum,
                            'sumstaff' => $sumstaff,
                            'sumexpenses' => $sumexpenses
                        ];
                        $sumFund = $data['sum'] + $data['sumstaff'] + $data['sumexpenses'];
                        $staff = EmployeeSalary::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.expense.expenseList')->with(compact('expenses', 'sumFund', 'sum', 'teacher', 'staff', 'defaultDate', 'seo_array'));
                    } else {
                        $expenses = Transection::where('school_id', authUser()->id)->wheredate('datee', $request->searchdate)->where('type', '=', '1')->where('amount', '!=', '0')->orderBy('datee', 'Desc')->paginate(20);
                        $teacher = TeacherSalary::where('school_id', authUser()->id)->wheredate('updated_at', $request->searchdate)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                        $sum = TeacherSalary::where('school_id', authUser()->id)->wheredate('updated_at', $request->searchdate)->where('amount', '!=', '0')->sum('amount');
                        $sumstaff = EmployeeSalary::where('school_id', authUser()->id)->wheredate('updated_at', $request->searchdate)->where('amount', '!=', '0')->sum('amount');
                        $sumexpenses = Transection::where('school_id', authUser()->id)->wheredate('datee', $request->searchdate)->where('type', '=', '1')->where('amount', '!=', '0')->sum('amount');
                        $data = [
                            'sum' => $sum,
                            'sumstaff' => $sumstaff,
                            'sumexpenses' => $sumexpenses
                        ];
                        $sumFund = $data['sum'] + $data['sumstaff'] + $data['sumexpenses'];
                        $staff = EmployeeSalary::where('school_id', authUser()->id)->whereDate('updated_at', $request->searchdate)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.expense.expenseList')->with(compact('expenses', 'sumFund', 'sum', 'teacher', 'staff', 'defaultDate', 'seo_array'));
                    }
                } elseif (isset($request->searchmonth)) {
                    $transectionMonth = Transection::where('status', true)->orderBy('created_at', 'asc')->get();
                    $searchmonth = $request->searchmonth;
                    $expenses = Transection::where('school_id', authUser()->id)->where('type', '=', '1')->whereMonth('datee', $request->searchmonth)->where('amount', '!=', '0')->orderBy('datee', 'Desc')->paginate(20);
                    $teacher = TeacherSalary::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                    $sum = TeacherSalary::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('amount', '!=', '0')->sum('amount');
                    $sumstaff = EmployeeSalary::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('amount', '!=', '0')->sum('amount');
                    $sumexpenses = Transection::where('school_id', authUser()->id)->whereMonth('datee', $request->searchmonth)->where('type', '=', '1')->where('amount', '!=', '0')->sum('amount');
                    $staff = EmployeeSalary::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                    $data = [
                        'sum' => $sum,
                        'sumstaff' => $sumstaff,
                        'sumexpenses' => $sumexpenses
                    ];
                    $sumFund = $data['sum'] + $data['sumstaff'] + $data['sumexpenses'];
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    return view('frontend.school.expense.expenseList')->with(compact('expenses', 'sumFund', 'sum', 'teacher', 'staff', 'defaultDate', 'seo_array'));
                } else {
                    $expenses = Transection::where('school_id', authUser()->id)->where('type', '=', '1')->where('amount', '!=', '0')->orderBy('datee', 'desc')->paginate(20);
                    $teacher = TeacherSalary::where('school_id', authUser()->id)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                    $sum = TeacherSalary::where('school_id', authUser()->id)->where('amount', '!=', '0')->sum('amount');
                    $sumstaff = EmployeeSalary::where('school_id', authUser()->id)->where('amount', '!=', '0')->sum('amount');
                    $sumexpenses = Transection::where('school_id', authUser()->id)->where('type', '=', '1')->where('amount', '!=', '0')->sum('amount');
                    $data = [
                        'sum' => $sum,
                        'sumstaff' => $sumstaff,
                        'sumexpenses' => $sumexpenses
                    ];
                    $sumFund = $data['sum'] + $data['sumstaff'] + $data['sumexpenses'];
                    $staff = EmployeeSalary::where('school_id', authUser()->id)->where('amount', '!=', '0')->orderBy('updated_at', 'Desc')->paginate(20);
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    return view('frontend.school.expense.expenseList')->with(compact('expenses', 'sumFund', 'sum', 'teacher', 'staff', 'defaultDate', 'seo_array'));
                }
            }
        } else {
            return back();
        }
    }




    public function  AllFundlist(Request $request)
    {
        if (hasPermission('Fund Show|Fund List Show')) {

            $seoTitle = 'Fund List';
            $seoDescription = 'Fund List';
            $seoKeyword = 'Fund List';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {

                $date = $request;
                if (isset($request->searchdate)) {
                    $search = 1;
                    if (isset($request->enddate)) {

                        $fund = Transection::where('school_id', authUser()->id)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', '=', '2')->where('amount', '!=', '0')->orderBy('datee', 'Asc')->get();
                        $student = StudentMonthlyFee::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('status', '2')->orderBy('updated_at', 'Asc')->get();
                        $accesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->whereBetween('updated_at', [$request->searchdate, $request->enddate])->orderBy('datee', 'Asc')->get();
                        $sumfund = Transection::where('school_id', authUser()->id)->where('type', '=', '2')->whereBetween('datee', [$request->searchdate, $request->enddate])->where('amount', '!=', '0')->sum('amount');
                        $sumstudent = StudentMonthlyFee::where('school_id', authUser()->id)->whereBetween('updated_at', [$request->searchdate, $request->enddate])->where('status', '>', '0')->sum('paid_amount');
                        $sumaccesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->whereBetween('updated_at', [$request->searchdate, $request->enddate])->sum('amount');

                        $data = [
                            'sumfund' => $sumfund,
                            'sumstudent' => $sumstudent,
                            'sumaccesories' => $sumaccesories
                        ];
                        $sumAllFund = $data['sumfund'] + $data['sumstudent'] + $data['sumaccesories'];
                        return view('frontend.school.fund.fundList', compact('student', 'accesories', 'fund', 'sumAllFund', 'search', 'seo_array'));
                    } else {


                        $fund = Transection::where('school_id', authUser()->id)->wheredate('datee', $request->searchdate)->where('type', '=', '2')->where('amount', '!=', '0')->orderBy('datee', 'Asc')->get();
                        $student = StudentMonthlyFee::where('school_id', authUser()->id)->wheredate('updated_at', $request->searchdate)->where('status', '2')->orderBy('updated_at', 'Asc')->get();
                        $accesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->wheredate('updated_at', $request->searchdate)->orderBy('datee', 'Asc')->get();
                        $sumfund = Transection::where('school_id', authUser()->id)->wheredate('datee', $request->searchdate)->where('type', '=', '2')->where('amount', '!=', '0')->sum('amount');
                        $sumstudent = StudentMonthlyFee::where('school_id', authUser()->id)->wheredate('updated_at', $request->searchdate)->where('status', '>', '2')->sum('paid_amount');
                        $sumaccesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->wheredate('updated_at', $request->searchdate)->sum('amount');


                        $data = [
                            'sumfund' => $sumfund,
                            'sumstudent' => $sumstudent,
                            'sumaccesories' => $sumaccesories
                        ];
                        // return $data;
                        $sumAllFund = $data['sumfund'] + $data['sumstudent'] + $data['sumaccesories'];
                        return view('frontend.school.fund.fundList', compact('student', 'accesories', 'fund', 'sumAllFund', 'search', 'seo_array'));
                    }
                } elseif (isset($request->searchmonth)) {
                    $search = 1;

                    $searchmonth = $request->searchmonth;

                    $fund = Transection::where('school_id', authUser()->id)->whereMonth('datee', $request->searchmonth)->where('type', '=', '2')->where('amount', '!=', '0')->orderBy('datee', 'Asc')->get();
                    $student = StudentMonthlyFee::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('status', '2')->orderBy('updated_at', 'Asc')->get();
                    $accesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->whereMonth('updated_at', $request->searchmonth)->orderBy('datee', 'Asc')->get();
                    $sumfund = Transection::where('school_id', authUser()->id)->whereMonth('datee', $request->searchmonth)->where('type', '=', '2')->where('amount', '!=', '0')->sum('amount');
                    $sumstudent = StudentMonthlyFee::where('school_id', authUser()->id)->whereMonth('updated_at', $request->searchmonth)->where('status', '>', '0')->sum('paid_amount');
                    $sumaccesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->whereMonth('updated_at', $request->searchmonth)->sum('amount');

                    $data = [
                        'sumfund' => $sumfund,
                        'sumstudent' => $sumstudent,
                        'sumaccesories' => $sumaccesories
                    ];
                    $sumAllFund = $data['sumfund'] + $data['sumstudent'] + $data['sumaccesories'];
                    return view('frontend.school.fund.fundList', compact('student', 'accesories', 'fund', 'sumAllFund', 'search', 'seo_array'));
                } else {
                    $search = 0;

                    $fund = Transection::where('school_id', authUser()->id)->where('type', '=', '2')->where('amount', '!=', '0')->orderBy('datee', 'Desc')->paginate(20);
                    $student = StudentMonthlyFee::where('school_id', authUser()->id)->where('paid_amount', '>', '0')->orderBy('updated_at', 'Desc')->paginate(15);
                    $accesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->orderBy('datee', 'Desc')->paginate(20);
                    $sumfund = Transection::where('school_id', authUser()->id)->where('type', '=', '2')->where('amount', '!=', '0')->sum('amount');
                    $sumstudent = StudentMonthlyFee::where('school_id', authUser()->id)->where('status', '>', 0)->sum('paid_amount');
                    $sumaccesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->sum('amount');

                    $data = [
                        'sumfund' => $sumfund,
                        'sumstudent' => $sumstudent,
                        'sumaccesories' => $sumaccesories
                    ];
                    $sumAllFund = $data['sumfund'] + $data['sumstudent'] + $data['sumaccesories'];

                    return view('frontend.school.fund.fundList', compact('student', 'accesories', 'fund', 'sumAllFund', 'search', 'seo_array'));
                }
            }
        } else {
            return back();
        }
    }

    public function fund_check_delete(Request $request)
    {
        if (hasPermission('fund_delete')) {

            $ids = $request->ids;
            Transection::withTrashed()->where('id', $id)->forcedelete();
            toast("Data delete permanently", "success");
            return back();
        } else {
            return back();
        }
    }

    /** --------------- expense data table
     * =============================================*/

    public function expense_check_delete(Request $request)
    {
        if (hasPermission('expense_delete')) {

            $ids = $request->ids;
            Transection::withTrashed()->where('id', $ids)->forcedelete();
            toast("Data delete permanently", "success");
            return back();
        } else {
            return back();
        }
    }

    // Create Expense
    public function expensecreate($expenseFund)
    {
        if (hasPermission('expense_create')) {

            $seoTitle = 'Expenses Create';
            $seoDescription = 'Expenses Create';
            $seoKeyword = 'Expenses Create';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $expenseFund = $expenseFund;
                return view('frontend.school.expense.form', compact('expenseFund', 'seo_array'));
            }
        } else {
            return back();
        }
    }

    /** --------------- Store expense
     * =============================================*/
    public function expensestore(Request $request)
    {
        if (hasPermission('expense_create')) {


            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $request->validate([

                    'datee'  => 'required',
                    'amount'  => 'required|integer',
                    'purpose'  => 'required',
                    'payment_method' => 'required',
                    'type' => 'required',

                ]);

                $data = $request->all();
                $data['school_id'] = authUser()->id;

                // return $data;

                $expense = Transection::create($data);

                if ($request->type == 1) {
                    return redirect()->route('expense.show')->with('success', 'Record created successfully');
                } else {
                    return redirect()->route('fund.show')->with('success', 'Record created successfully');
                }
            }
        } else {
            return back();
        }
    }

    /** --------------- expense data edit
     * =============================================*/
    public function expenseedit(Request $request)
    {
        if (hasPermission('expense_edit')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $key = $request->key;
                $expense = Transection::find($key);
                $expenseFund = $key;
                return view('frontend.school.expense.form')->with(compact('expense', 'expenseFund'));
            }
        } else {
            return back();
        }
    }


    /** --------------- Update expense
     * =============================================*/
    public function expenseupdate(Request $request)
    {
        if (hasPermission('expense_edit')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $key = $request->key;

                $request->validate([

                    'datee'  => 'required',
                    'amount'  => 'required|integer',
                    'purpose'  => 'required',
                    'payment_method' => 'required',
                    'type' => 'required',
                ]);


                $data = $request->except("key");
                $data['school_id'] = authUser()->id;

                $expense = Transection::find($key)->update($data);

                if ($request->type == 1) {
                    return redirect()->route('expense.show')->with('success', 'Record created successfully');
                } else {
                    return redirect()->route('fund.show')->with('success', 'Record created successfully');
                }
            }
        } else {
            return back();
        }
    }


    public function receiptDelete($id)
    {

        // syllabus delete
        AccesoriesTransaction::find($id)->delete();
        toast('opps deleted', 'danger');

        return back();
    }


    /** --------------- Delete expense
     * =============================================*/
    public function expensedestroy(Request $request)
    {
        if (hasPermission('expense_delete')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $key = $request->key;
                $type = Transection::find($key)->type;
                $expense = Transection::destroy($key);

                if ($type == 1) {
                    return redirect()->route('expense.show')->with('success', 'Record created successfully');
                } else {
                    return redirect()->route('fund.show')->with('success', 'Record created successfully');
                }
            }
        } else {
            return back();
        }
    }


    // this part is for fund Control

    //Fund list show 

    public function fundlist(Request $request)
    {
        if (hasPermission('fund_show')) {

            $seoTitle = 'Fund Show';
            $seoDescription = 'Fund Show';
            $seoKeyword = 'Fund Show';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $date = $request;
                if (isset($request->searchdate)) {
                    if (isset($request->enddate)) {
                        $searchdate = $request->searchdate;
                        $enddate = $request->enddate;
                        $expense = Transection::where('school_id', authUser()->id)->where('status', true)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', 2)->orderBy('datee', 'desc')->get();
                        $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->whereBetween('datee', [$request->searchdate, $request->enddate])->where('type', 2)->sum('amount');
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.fund.table')->with(compact('expense', 'sumFund', 'defaultDate', 'searchdate', 'enddate', 'seo_array'));
                    } else {
                        $searchdate = $request->searchdate;
                        $expense = Transection::where('school_id', authUser()->id)->where('status', true)->wheredate('datee', $request->searchdate)->where('type', 2)->orderBy('datee', 'desc')->get();
                        $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->wheredate('datee', $request->searchdate)->where('type', 2)->sum('amount');
                        $defaultDate = Carbon::today()->format('Y-m-d');
                        return view('frontend.school.fund.table')->with(compact('expense', 'sumFund', 'defaultDate', 'searchdate', 'seo_array'));
                    }
                } elseif (isset($request->searchmonth)) {
                    $transectionMonth = Transection::where('school_id', authUser()->id)->where('status', true)->orderBy('created_at', 'asc')->get();
                    $searchmonth = $request->searchmonth;
                    $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->whereMonth('datee', $request->searchmonth)->where('type', 2)->sum('amount');
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    $expense = Transection::where('school_id', authUser()->id)->where('status', true)->whereMonth('datee', $request->searchmonth)->where('type', 2)->orderBy('datee', 'desc')->get();
                    return view('frontend.school.fund.table')->with(compact('expense', 'searchmonth', 'sumFund', 'defaultDate'));
                } else {
                    $expense = Transection::where('school_id', authUser()->id)->where('status', true)->where('type', 2)->orderBy('datee', 'desc')->get();
                    $sumFund = Transection::where('school_id', authUser()->id)->where('status', true)->where('type', 2)->sum('amount');
                    $defaultDate = Carbon::today()->format('Y-m-d');
                    return view('frontend.school.fund.table', compact('expense', 'sumFund', 'defaultDate', 'seo_array'));
                }
            }
        } else {
        }
    }


    /** --------------- expense data table
     * =============================================*/
    public function fundcreate($expenseFund)
    {
        if (hasPermission('fund_create')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $expenseFund = $expenseFund;
                return view('frontend.school.expense.form', compact('expenseFund'));
            }
        } else {
            return back();
        }
    }

    // this oart is for accesories 

    public function  accesoriesType()
    {
        if (hasPermission('finance_dashboard')) {

            $seoTitle = 'Accesories Type';
            $seoDescription = 'Accesories Type';
            $seoKeyword = 'Accesories Type';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $data = AccesoriesType::where('school_id', authUser()->id)->get();

            return view('frontend.school.Accesories.accesoriesType', compact('data', 'seo_array'));
        } else {
            return back();
        }
    }
    /**
     *  store accesories by school
     */
    public function accesoriesTypePost(Request $request)
    {
        if (hasPermission('finance_dashboard')) {

            $request->validate([
                'accesories' => 'required',
                'price' => 'required'
            ]);

            AccesoriesType::create([
                'school_id' =>  authUser()->id,
                'accesories' => $request->accesories,
                'price' => $request->price,
            ]);

            return back();
        } else {
            return back();
        }
    }
    public function accesoriesTypeListdelete($id)
    {
        if (hasPermission('finance_dashboard')) {

            AccesoriesType::find($id)->delete();
            toast('opps deleted', 'danger');

            return back();
        } else {
            return back();
        }
    }


    public function  accesoriesEditPost(Request $request, $id)
    {
        if (hasPermission('finance_dashboard')) {

            $update = AccesoriesType::find($id);
            $update->update([
                'accesories' => $request->accesories,
                'price' => $request->price,
            ]);
            Alert::success('Success', "Updated Succesfully");

            return back();
        } else {
            return back();
        }
    }


    public function   receiptHistoryEdit(Request $request, $id)
    {
        if (hasPermission('finance_dashboard')) {

            $update = AccesoriesTransaction::find($id);
            $update->update([
                'name' => $request->name,
                'class' => $request->class,
                'roll' => $request->roll,
                'section' => $request->section,
                'accesories' => $request->accesories,
                'amount' => $request->amount,
                'quantity' => $request->quantity
            ]);
            Alert::success('Success', "Updated Succesfully");

            return back();
        } else {
            return back();
        }
    }

    public function receipt()
    {
        if (hasPermission('Accesories Create|Accesories Show|Accesories Collect Fees')) {

            $seoTitle = 'Accesories Receipt';
            $seoDescription = 'Accesories Receipt';
            $seoKeyword = 'Accesories Receipt';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $class = InstituteClass::where('school_id', authUser()->id)->get();

            $school = School::find(authUser()->id);
            $orders = AccesoriesType::where('school_id', authUser()->id)->get();
            return view("frontend.school.Accesories.accesories", compact('orders', 'school', 'class', 'seo_array'));
        } else {
            return back();
        }
    }


    public function  receiptShow()
    {
        if (hasPermission('accesoires-_create')) {

            $seoTitle = 'Accesories History';
            $seoDescription = 'Accesories History';
            $seoKeyword = 'Accesories History';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $data = AccesoriesTransaction::with('Class', 'Section')->get();
            return view('frontend.school.Accesories.receipt', compact('data', 'seo_array'));
        } else {
            return back();
        }
    }

    public function getPrice($id)
    {
        $price  = AccesoriesType::find($id)->price;
        return $price;
    }

    public function paginator(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->input('page', 1);

            $fund = Transection::where('school_id', authUser()->id)->where('type', '=', '2')->where('amount', '!=', '0')->orderBy('datee', 'Desc')->paginate(20);
            $student = StudentMonthlyFee::where('school_id', authUser()->id)->where('paid_amount', '>', '0')->orderBy('updated_at', 'Desc')->paginate(20);
            $accesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->orderBy('datee', 'Desc')->paginate(20);
            $sumfund = Transection::where('school_id', authUser()->id)->where('type', '=', '2')->where('amount', '!=', '0')->sum('amount');
            $sumstudent = StudentMonthlyFee::where('school_id', authUser()->id)->where('status', '>', 0)->sum('paid_amount');
            $sumaccesories = Transection::where('school_id', authUser()->id)->where('type', '=', '3')->sum('amount');

            $data = [
                'sumfund' => $sumfund,
                'sumstudent' => $sumstudent,
                'sumaccesories' => $sumaccesories
            ];
            $sumFund = $data['sumfund'] + $data['sumstudent'] + $data['sumaccesories'];

            return view('frontend.school.fund.fundList', compact('student', 'accesories', 'fund', 'sumFund'))->render();
        }
    }
}
