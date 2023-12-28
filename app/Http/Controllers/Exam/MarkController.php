<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\InstituteClass;
use App\Models\MarkType;
use App\Models\SchoolMarkType;
use App\Models\schoolManualMarkType;
use App\Models\School;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class MarkController extends Controller
{
    /**
     * Show Mark Type Page
     *
     * @return \Illuminate\Contracts\View
     */
    public function index($id)
    {   
        $seoTitle = 'Result Setting';
        $seoDescription = 'Result Setting' ;
        $seoKeyword = 'Result Setting';
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $resultSettingId = $id;
        $classes = InstituteClass::where('school_id', authUser()->id)->get();
        $result_mark_setting = School::find(authUser()->id)->result_mark_type;
        $markType = SchoolMarkType::where('school_id', authUser()->id)->get();
        
        
        // return $markType;
        if(hasPermission('result_upload_show'))
            return view('frontend.school.mark_type.mark_type', compact('classes', 'resultSettingId','seo_array', 'markType','result_mark_setting'));
        else 
            return back();

        }

    /**
     * Store Mark Types in Database
     *
     * @param Request
     * @param $request
     * @return back
     */
    public function store(Request $request)
    {   
        try {
            DB::beginTransaction();
            DB::table('mark_types')->where('school_id', authUser()->id)->delete();

            if(isset($request->subjects))
            {
                foreach ($request->subjects as $key => $value) {
                    foreach ($value as $subject) {
                        MarkType::create([
                            'institute_classes_id'      => $key,
                            'school_id'                 => authUser()->id,
                            'mark_type'                 => $subject,
                        ]);
                    }
                }
                toast("Mark Type Add Successfully", 'success');

                return redirect()->route("result.mark.set", ['id' => $request->resultSettingId]);
            }
            else
            {
                toast("Please select an item", 'error');
                return back();
            }
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    // add new mark Type
    public function markTypeCreate(Request $request){
        if(hasPermission('result_upload_show')){
            $request -> validate([
                'type_name' => 'required',
            ]);
    
            // dd($request);
    
            SchoolMarkType::create([
                'type_name' => $request->type_name,
                'school_id'     => authUser()->id,
                
            ]);
            return back();
        }
        else
            return back();
        
    }

    public function manualMarkTypeStore(Request $request)
    { 
        if(hasPermission('result_upload_show')){
            // return $request;  
            try {
                DB::beginTransaction();
                DB::table('school_manual_mark_types')->where('school_id', authUser()->id)->delete();

                if(isset($request->subjects))
                {
                    foreach ($request->subjects as $key => $value) {
                        
                        foreach ($value as $subject) {
                            schoolManualMarkType::updateOrCreate([
                                'institute_class_id'      => $key,
                                'school_id'               => authUser()->id,
                                'result_mark_type_id'     => $subject,

                                // 'institute_class_id'      => 1,
                                // 'school_id'               => 1,
                                // 'result_mark_type_id'     => 1,
                            ]);
                        }
                    }
                    toast("Mark Type Add Successfully", 'success');

                    return redirect()->route("result.mark.set", ['id' => $request->resultSettingId]);
                }
                else
                {
                    toast("Please select an item", 'error');
                    return back();
                }
            DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return $e;
            }
        }
        else 
            return back();
        
    }




}
