<?php

namespace App\Http\Controllers;

use App\Models\ClassPeriod;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ClassPeriodController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (hasPermission('Period Show|Period Create')) {

            $seoTitle = 'Class PeriodeList';
            $seoDescription = 'Class PeriodeList';
            $seoKeyword = 'Class PeriodeList';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $rows = ClassPeriod::where('school_id', $this->school->id)->orderBy('shift', 'asc')->get();

            if ($rows->count() > 0) {
                return view('frontend.school.period.table')->with(compact('rows', 'seo_array'));
            } else {
                $rows = [];
                return view('frontend.school.period.form', compact('rows', 'seo_array'));
            }
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($shift = 2) // 2 for day shift
    {
        if (hasPermission('period_create')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }
            if (authUser()->is_editor != 3) {
                return back();
            } else {
                $seoTitle = 'Class PeriodeCreate ';
                $seoDescription = 'Class PeriodeCreate';
                $seoKeyword = 'Class PeriodeCreate';
                $seo_array = [
                    'seoTitle' => $seoTitle,
                    'seoKeyword' => $seoKeyword,
                    'seoDescription' => $seoDescription,
                ];
                $rows = [];

                if (is_null($shift)) {
                    return view('frontend.school.period.form', compact('rows', 'shift', 'seo_array'));
                } else {
                    $rows = ClassPeriod::where(['school_id' => $this->school->id, 'shift' => $shift])->get();

                    if ($rows->count() > 0) {
                        return view('frontend.school.period.form', compact('rows', 'shift', 'seo_array'));
                    } else {
                        return view('frontend.school.period.form', compact('rows', 'shift', 'seo_array'));
                    }
                }
            }
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (hasPermission('period_create')) {

            for ($i = 0; $i < count($request->title); $i++) {
                if (!is_null($request['start_time'][$i]) && !is_null($request['end_time'][$i])) {
                    DB::table('class_periods')->updateOrInsert(
                        [
                            'school_id'  =>  $this->school->id,
                            'shift'     =>  $request['shift'],
                            'title' =>  $request['title'][$i],
                        ],
                        [
                            'from_time' =>  $request['start_time'][$i],
                            'to_time' =>  $request['end_time'][$i],
                            'created_at' =>  now(),
                            'updated_at' =>  now(),
                        ]
                    );
                }
            }

            return redirect(route('period.index'));
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (hasPermission('period_edit')) {

            try {
                $row = ClassPeriod::where(['school_id' => $this->school->id, 'id' => $id]);

                if ($row->exists()) {
                    $row = $row->first();
                    return view('frontend.school.period.form', compact('row'));
                } else {
                    Alert::error('Record not found', "");
                    return back();
                }
            } catch (Exception $e) {
                Alert::error('Server Error', $e->getMessage());
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (hasPermission('period_update')) {


            try {
                $row = ClassPeriod::where(['school_id' => $this->school->id, 'id' => $id]);

                if ($row->exists()) {
                    $row = $row->update([
                        'shift'     =>  $request['shift'],
                        'title' =>  $request['title'],
                        'from_time' =>  $request['start_time'],
                        'to_time' =>  $request['end_time'],
                        'updated_at' =>  now(),
                    ]);

                    return redirect(route('period.index'));
                } else {
                    Alert::error('Record not found', "");
                    return back();
                }
            } catch (Exception $e) {
                Alert::error('Server Error', $e->getMessage());
                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function periodDelete($id)
    {
        if (hasPermission('period_delete')) {

            if (authUser()->status == 0) {
                return redirect()->route('school.payment.info');
            } elseif (authUser()->status == 2) {
                toast('Sorry Admin can Inactive Your Account Please Contact', 'error');
                return back();
            }

            $delete = ClassPeriod::where('id', $id)->delete();

            Alert::error('Period Deleted Successfully', 'Success Message');
            return redirect(route('period.index'));
        } else {
            return back();
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
}
