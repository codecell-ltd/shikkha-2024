<?php

namespace App\Http\Controllers\School;

use App\Models\Term;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ClassSyllabus;
use App\Models\InstituteClass;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SchoolController;
use App\Models\CommonClass;
use App\Models\ResultSetting;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\Caster\ClassStub;

class SyllabusController extends Controller
{
    public function SyllabusTestList()
    {
        $classes = InstituteClass::where('school_id', authUser()->id)->get();
        return view('frontend.school.syllabus.syllabusList', compact('classes'));
    }
    public function SyllabusTestshow($id)
    {
        if(hasPermission('Syllabus Show')){
            $term = Term::where('school_id', authUser()->id)->orderby('id', 'desc')->get();
            $class = InstituteClass::where('id', $id)->first('id');
            $subjects = Subject::where('school_id', authUser()->id)->where('class_id', $id)->get();
    
            $syllabus = ClassSyllabus::with('termRelation')->where('class_id', $id)->where('school_id', authUser()->id)->get()->groupBy('term_id');
            $school = School::find(authUser()->id);
    
            if ($syllabus->count() > 0) {
                return view('frontend.school.syllabus.show', compact('syllabus', 'school', 'term', 'class', 'subjects'));
            } else {
                Alert::error('Sorry', "No record found");
                return back();
            }
        }
        else{
            return back();
        }
    }
    public function SyllabusTestcreate($id)
    {
        if(hasPermission('Syllabus Create')){
            $term = ResultSetting::where('school_id', authUser()->id)->orderby('id', 'desc')->get();
            $subjects = Subject::where('school_id', authUser()->id)->where('class_id', $id)->get();
            $class = InstituteClass::where('id', $id)->first('id');
            return view('frontend.school.syllabus.create', compact('class', 'subjects', 'term'));    
        }
        else{
            return back();
        }
    }
    public function SyllabusCreatePost(Request $request)
    {
        // return $request;
        $request->validate([
            'term_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'syllabus' => 'required'

        ]);

        $syllabus = strip_tags($request->input('syllabus'), '<a><strong><em><ul><ol><li>');
        $data = ClassSyllabus::where('class_id', $request->class_id)->where('term_id', $request->term_id)->where('subject_id', $request->subject_id)->first();
        if ($data == null) {


            $data = ClassSyllabus::create([
                'term_id' => $request->term_id,
                'school_id' => authUser()->id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'syllabus' => $syllabus

            ]);
        } else {
            Alert::error('Sorry you have alredy data in this term', 'if you want you can edit', 'Success Message');
        }
        return back();
    }
    public function SyllabusDelete($id)
    {
        if(hasPermission('Syllabus Delete')){
            ClassSyllabus::find($id)->delete();
            return redirect()->route('syllabus.test.list');
        }
        else{
            return back();
        }
        
    }
    public function SyllabusTestupdate(Request $request)
    {
        if(hasPermission('Syllabus Edit')){
            $data = ClassSyllabus::find($request->id);
            $data->update([
                'term_id' => $request->term_id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'syllabus' => $request->syllabus
            ]);
            Alert::success('Syllabus updated Succesfully', 'Success Message');
    
            return back();
        }
        else{
            return back();
        }
        
    }
}
