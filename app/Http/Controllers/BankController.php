<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\EmployeeSalary;
use App\Models\TeacherSalary;
use App\Models\Transection;
use App\Models\StudentMonthlyFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BankController extends Controller
{
    /** --------------- bank account data table
     * =============================================*/
    public function show()
    {
        if (hasPermission('bank_account_show')) {

            $seoTitle = 'Bank List';
            $seoDescription = 'Bank List';
            $seoKeyword = 'Bank List';
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

                $teacherPaidSalary = TeacherSalary::where('school_id', authUser()->id)->sum("amount");
                $StaffPaidSalary = EmployeeSalary::where('school_id', authUser()->id)->sum("amount");
                $Expense = Transection::where('school_id', authUser()->id)->where('type', '1')->sum("amount");

                $sumFund = Transection::where('school_id', authUser()->id)->where('type', '2')->sum("amount");
                $colected = StudentMonthlyFee::where('school_id', authUser()->id)->where('status', '2')->sum("paid_amount");
                $accesories = Transection::where('school_id', authUser()->id)->where('type', '3')->sum("amount");

                $ExpenseThisMonth = $Expense + $StaffPaidSalary + $teacherPaidSalary;
                $totalSchoolFund = $sumFund + $colected + $accesories;
                $profit = $totalSchoolFund - $ExpenseThisMonth;

                $bankadd = Bank::where('school_id', authUser()->id)->latest()->get();
                return view('frontend.school.bank_account.table')->with(compact('bankadd', 'profit', 'seo_array'));
            }
        } else {
            return back();
        }
    }


    /** --------------- bank account data table
     * =============================================*/
    public function create()

    {
        if (hasPermission('bank_account_create')) {

            $seoTitle = 'Add Bank';
            $seoDescription = 'Add Bank';
            $seoKeyword = 'Add Bank';
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
                return view('frontend.school.bank_account.form', compact('seo_array'));
            }
        } else {
            return back();
        }
    }



    /** --------------- Store bank account
     * =============================================*/
    public function store(Request $request)
    {
        if (hasPermission('bank_account_create')) {

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
                    'bank_name'  => 'required',
                    'branch'  => 'required',
                    'account_number'  => 'required|unique:banks,account_number|numeric',
                    'account_type'  => 'required',
                    'account_holder'  => 'required',
                ]);

                $data = new Bank();
                $data->bank_name = $request->bank_name;
                $data->branch = $request->branch;
                $data->account_number = $request->account_number;
                $data->account_type = $request->account_type;
                $data->account_holder = $request->account_holder;
                $data->balance = (is_null($request->balance) ? '0' : $request->balance);
                $data->routing = (is_null($request->routing) ? '0' : $request->routing);
                $data->swift = (is_null($request->swift) ? '0' : $request->swift);
                $data->school_id = authUser()->id;
                $data->save();
                Alert::success('Successfully Bank record Add', 'Success Message');

                return redirect()->route('bankadd')->with('success', 'Record created successfully');
            }
        } else {
            return back();
        }
    }



    /** --------------- bank account data edit
     * =============================================*/
    public function edit(Request $request)
    {
        if (hasPermission('bank_account_edit')) {

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
                $bankadd = Bank::find($key);

                return view('frontend.school.bank_account.form')->with(compact('bankadd'));
            }
        } else {
            return back();
        }
    }




    /** --------------- Update bank account
     * =============================================*/
    public function update(Request $request, $key)
    {
        if (hasPermission('bank_account_show')) {

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
                    'bank_name'  => 'required',
                    'branch'  => 'required',
                    'account_number'  => 'required|numeric',
                    'account_type'  => 'required',
                    'account_holder'  => 'required',

                ]);

                $data = Bank::find($key);

                $data->bank_name = $request->bank_name;
                $data->branch = $request->branch;
                $data->account_number = $request->account_number;
                $data->account_type = $request->account_type;
                $data->account_holder = $request->account_holder;
                $data->balance = (is_null($request->balance) ? '0' : $request->balance);
                $data->routing = (is_null($request->routing) ? '0' : $request->routing);
                $data->swift = (is_null($request->swift) ? '0' : $request->swift);
                $data->school_id = authUser()->id;
                $data->save();
                Alert::success('Successfully Bank record Updated', 'Success Message');

                return redirect()->route('bankadd')->with('success', 'Record updated successfully');
            }
        } else {
            return back();
        }
    }



    /** --------------- Update bank account
     * =============================================*/
    public function destroy(Request $request)
    {
        if (authUser()->status == 0) {
            return redirect()->route('school.payment.info');
        } elseif (authUser()->status == 2) {
            toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
            return back();
        }

        $key = $request->key;

        $bankadd = Bank::where('id', $key)->delete();
        Alert::success('Successfully Bank record Deleted', 'Success Message');

        return redirect()->route('bankadd')->with('success', 'Record deleted successfully');
    }
}
