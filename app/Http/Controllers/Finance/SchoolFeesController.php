<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FeesType;
use App\Models\InstituteClass;
use App\Models\StudentFee;
use App\Models\StudentMonthlyFee;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolFeesController extends Controller
{
    use HttpResponse;

    /**
     * view fees blade
     */
    public function index(Request $request)
    {  
        if (hasPermission('finance_school_fees_show')) {
            $seoTitle = 'School Fees';
            $seoDescription = 'School Fees';
            $seoKeyword = 'School Fees';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            try
            {
                $schoolId = authUser()->id;
                
                if($request->ajax())
                {
                    if(isset($request->classId) && !empty($request->classId))
                    {
                        $data = StudentFee::join('fees_types as f', 'f.id', 'student_fees.fees_type_id')
                                ->join('institute_classes as class', 'class.id', 'student_fees.class_id')
                                ->select('student_fees.id', 'f.title', 'student_fees.fees', 'student_fees.fees_type_id', 'class.class_name')
                                ->where('student_fees.class_id', $request->classId)
                                ->where('student_fees.school_id', $schoolId)
                                ->get()->toArray();

                        return $this->success("data fetched", $data);
                    }
                    else
                    {
                        return $this->error("Something went wrong. Please try again");
                    }
                }
                else
                {
                    
                    $data['classes'] = InstituteClass::where('school_id', $schoolId)->get();
                    $typeOfFees = FeesType::where('school_id', $schoolId)->get();
                // @dd($typeOfFees);
                    $classes = InstituteClass::where('school_id', $schoolId)->get();

                    if($typeOfFees->count() == 0)
                    {
                        $newTypeOfFees = FeesType::create(
                            ['school_id'=> $schoolId,'title'=>'Monthly Fee'],
                            ['school_id'=> $schoolId,'title'=>'Absent Fee'],
                        );

                        foreach($classes as $class)
                        {
                            StudentFee::create(['class_id'=>$class->id, 'fees_type_id'=>$newTypeOfFees->id, 'fees'=>$class->class_fess, 'school_id'=>$schoolId]);
                        }

                        $data['fee_types'] = $typeOfFees = FeesType::where('school_id', $schoolId)->get();
                    }
                
                    return view('frontend.school.finance.fees-create',compact('seo_array'))->with($data);
                }
            }
            catch(Exception $e)
            {
                if($request->ajax())
                {
                    return $this->error($e->getMessage());
                }
                else
                {
                    alert("Server Problem", $e->getMessage());
                    return back();
                }
            }
        }
        else {
            return back();
        }
        
    }


    /**
     *  store school fees type
     */
    public function createSchoolFees(Request $request)
    {
        if(hasPermission('finance_school_fees_create')){
            try {
                $request->validate([
                    'fees_title'     => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
                ]);
    
                if(FeesType::where(['school_id' =>  authUser()->id,'title'=>$request['fees_title']])->exists())
                {
                    return $this->error("Fees type already exists");
                }
                else
                {
                    $feesType = FeesType::create(['school_id' =>  authUser()->id,'title'=>$request['fees_title']]);
                }
    
                $classes = InstituteClass::where('school_id', authUser()->id)->pluck('id');
    
                foreach($classes as $classId)
                {
                    StudentFee::updateOrCreate(
                        ['school_id'=>authUser()->id,'class_id'=>$classId,'fees_type_id'=>$feesType->id],
                        ['fees'=>0]
                    );
                }
    
                return $this->success("created", $request->except('_token'));
            } 
            catch (Exception $e) 
            {
                return $this->error($e->getMessage());
            }
        }
        else 
            return back();
        
    }


    /**
     * store class fees for a school
     */
    public function storeSchoolFees(Request $request)
    {
        try {
            // return $request;
            $request->validate([
                'classId'  =>  ['required', 'integer'],
                'feesId.*'  =>  ['required', 'numeric'],
                'fees.*'      =>  'required|integer'
            ]);

            foreach ($request->feesId as $key => $item) {
                StudentFee::updateOrCreate(
                    [
                        'school_id' =>  authUser()->id,
                        'class_id'     =>  $request->classId,
                        'id'  =>  $item
                    ], 
                    ['fees' => $request['fees'][$key] ?? 0]
                );
            }

            return $this->success("Records stored");
        }
        catch (Exception $e) 
        {
            return $this->error($e->getMessage());
        }
    }


    /**
     * 
     */
    public function destorySchoolFees(Request $request)
    {
        if(hasPermission('finance_school_fees_delete')){
            try
            {
                $stFee = StudentFee::where('fees_type_id', $request->feesTypeId)->pluck('id');
                StudentMonthlyFee::whereIn('id', $stFee)->delete();
                StudentFee::where('fees_type_id', $request->feesTypeId)->delete();
                FeesType::findOrFail($request->feesTypeId)->delete();

                return $this->success("Record deleted");
            }
            catch(Exception $e)
            {
                return $this->error($e->getMessage());
            }
        }
        else{
            return back();
        }
        
    }
}
