<?php

namespace App\Http\Controllers;

use App\Models\AccesoriesTransaction;
use App\Models\MarkType;
use App\Models\ResultSetting;
use App\Models\ResultSubjectCountableMark;
use Str;
use Exception;
use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Transection;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AjaxController extends Controller
{
    public function ajaxLoaderSubject(Request $request)
    {
        $data = Subject::where('class_id', $request->class_id)->where('school_id', authUser()->id)->get();

        $html = '<label><b>Subject</b></label><select class="form-select mb-3" name="subject_id" id="subject_id">
        <option value="" selected>Subject</option>';

        foreach ($data as $subject) {
            $html .= '<option value="' . $subject->id . '">' . $subject->subject_name . '</option>';
        }

        $html .= '</select>';

        return $html;
    }
  
    
    public function loadBill(Request $request)
    {
        
        $id = $request->input('id');
         return $data = School::where('id', $id)->get();
        return response()->json($data);
    }

    public function ajaxLoaderaccesories(Request $request)
    {
        Transection::create([
            'purpose' => 'Receipt Accesories Payment',
            'payment_method' => 1,
            'type' => '3',
            'amount' => $request->amount,
            'name' => 'admin',
            'school_id' =>  authUser()->id
        ]);
    }

    /**
     * Save Accesories (Sunnah)
     *
     * @param Request
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAccesorisTransaction(Request $request)
    {
        $access = AccesoriesTransaction::create([
            "name" => $request->name,
            "roll" => $request->roll,
            "class" => $request->class,
            "section" => $request->section,
            "amount" => $request->amount,
            "quantity" => $request->quantity,
            "accesories" => $request->accesories,
            'school_id' =>  authUser()->id
        ]);

        return response()->json(['success' => true, 'access' => $access]);
    }

    public function ajaxLoadStudents(Request $request)
    {
        $request->validate([
            'shift' =>  ['required', 'integer'],
            'classId' =>  ['required', 'exists:institute_classes,id', 'integer'],
        ]);

        $rows = User::where(['school_id' => authUser()->id, 'shift' => $request->shift, 'class_id' => $request->classId])->get();

        $html = '<label>Student</label>  <select class="form-select mb-3" name="student_id" required>
        <option value="0" selected>All Students</option>';

        foreach ($rows as $row) {
            $html .= '<option value="' . $row->phone . '">' . $row->name . '</option>';
        }

        $html .= '</select>';

        return $html;
    }


    /**
     *
     */
    public function zkTeck()
    {
        try {

            $zk = new ZKTeco('192.168.0.114', '4370');

            if ($zk->connect()) {
                $zk->disableDevice();
                // $zk->setUser(3, 119001, "Akbar Sir", '12345678', 0);
                // $zk->removeUser(3);
                // $zk->clearUsers();
                // return  $zk->getUser();

                $att =  $zk->getAttendance();
                // $zk->clearAttendance();
                $zk->enableDevice();
                return $att;
            }

            return "Not connect";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function ajaxLoaderSection(Request $request)
    {
        $data = Section::where('class_id', $request->class_id)->where('school_id', authUser()->id)->get();

        $html = '<label class="form-label">Section</label><select class="form-select mb-3" name="section_id" id="section_id">
        <option value="" selected>Section</option>';

        foreach ($data as $section) {
            $html .= '<option value="' . $section->id . '">' . $section->section_name . '</option>';
        }

        $html .= '</select>';

        return $html;
    }

    /**
     * Subject Load
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param $request
     * @return html
     */
    public function ajaxLoaderSubjectResult(Request $request)
    {   
        $subjects = Subject::where('class_id', $request->class_id)->where('school_id', authUser()->id)->get();
       
        $html = ' ';
        
        $resultSetting = ResultSetting::findOrFail($request->resultSettingId);
        foreach ($subjects as $key => $subject) {
            $subjectMark = ResultSubjectCountableMark::where(["school_id" => authUser()->id, "result_setting_id"  => $resultSetting->id, "institute_class_id" => $request->class_id, "subject_id" => $subject->id])->first();
            $mark = ($subjectMark != null) ? $subjectMark->mark : $resultSetting->all_subject_mark;
            $mcq = isset($subjectMark->mcq) ? $subjectMark->mcq : '';
            $written = isset($subjectMark->written) ? $subjectMark->written : " ";
            $practical = isset($subjectMark->practical) ? $subjectMark->practical : '';
        
            $html .=
            '<div class="mb-1 row">
                <label class="col-sm col-form-label">'.$subject->subject_name.' </label>
                <input type="hidden" name="resultSettingId" value="'.$resultSetting->id.'">

                <div class="d-none col-sm mcq">
                    
                    <input placeholder="MCQ(Pass Mark)" type="number" min="1" id="mcq'.$subject->id.'" name="mcqMark['.$subject->class_id.']['.$subject->id. ']" class="form-control" value="'. $mcq.'" onkeyup="keyUpDistributionMarkSave('.$resultSetting->id.', '.$subject->class_id.', '.$subject->id.');" required>
                </div>

                <div class="d-none col-sm written">
                    
                    <input placeholder="Written(Pass Mark)" type="number" min="1" id="written'.$subject->id.'" name="writtenMark['.$subject->class_id.']['.$subject->id. ']" class="form-control" value="'. $written.'" onkeyup="keyUpDistributionMarkSave('.$resultSetting->id.', '.$subject->class_id.', '.$subject->id.');" required>
                </div>

                <div class="d-none col-sm practical">
                    
                    <input placeholder="Practical(Pass Mark)" type="number" min="1" id="practical'.$subject->id.'" name="practicalMark['.$subject->class_id.']['.$subject->id. ']" class="form-control" value="'. $practical.'" onkeyup="keyUpDistributionMarkSave('.$resultSetting->id.', '.$subject->class_id.', '.$subject->id.');" required>
                </div>

                <div class="col-md">
                    <input type="number" min="1" id="mark'.$subject->id.'" name="subjectMark['.$subject->class_id.']['.$subject->id. ']" class="form-control input-field" value="'. $mark.'" onkeyup="keyUpDistributionMarkSave('.$resultSetting->id.', '.$subject->class_id.', '.$subject->id.');" required>
                </div>
            </div>';
        }

        return $html;
    }
}
