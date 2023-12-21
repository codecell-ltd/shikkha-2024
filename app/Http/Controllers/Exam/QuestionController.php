<?php

namespace App\Http\Controllers\Exam;

use App\Models\Term;
use App\Models\Subject;
use App\Models\Question;
use App\Models\ExamRoutine;
use Illuminate\Http\Request;
use App\Models\InstituteClass;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Show Question Create Page
     * 
     * @return \Illuminate\Contracts\View\ 
     */
    public function index()
    {   
        $seoTitle = 'Question Add';
        $seoDescription = 'Question Add' ;
        $seoKeyword = 'Question Add' ;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $data['classes'] = InstituteClass::where('school_id', authUser()->id)->get();
        $data['terms']   = Term::where('school_id', authUser()->id)->get();
        $data['json'] = Question::get();
        if(hasPermission('question_show'))
            return view('frontend.school.question.index', $data,compact('seo_array'));
        else 
            return back();
    }

    /**
     * Save Question
     * 
     * @param Request
     * @param $request
     * @return \Illuminate\Contracts\View\ 
     */
    public function questionStore(Request $request)
    {   
        // $question = Question::where('school_id', authUser()->id)->where('type', $request->question_type)
        //                     ->where('term_id', $request->exam_term)->where('class_id', $request->class_name)
        //                     ->where('subject_id', $request->subject_name)->get();
        
        if(hasPermission('question_create')){
            $question_top = Validator::make($request->only('exam_term', 'class_name', 'subject_name', 'hours', 'total_mark'), [
                'exam_term'         => 'required|',
                'class_name'        => 'required',
                'subject_name'      => 'required',
                'hours'             => 'required|numeric|min:1|max:100',
                'total_mark'        => 'required|numeric|min:1|max:100',
            ], [
                    "exam_term.required"          => "Exam field term is required",
                    "class_name.required"         => "Class field is required",
                    "subject_name.required"       => "Subject field is required",
                    "total_mark.required"         => "Total mark field is required",
            ]);

            if ($question_top->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'error'  => $question_top->errors()->toArray()
                ]);
            }

            if (!empty($request->question_title[1])) {

                $unValid = Validator::make($request->all(), [
                    'exam_term'         => 'required|',
                    'class_name'        => 'required',
                    'subject_name'      => 'required',
                    'hours'             => 'required|numeric|min:1|max:100',
                    'total_mark'        => 'required|numeric|min:1|max:100',
                    'question_title.*'    => 'required',
                    'question_mark.*'     => 'required',
                    'questions.*'          => 'required',
                    
                ], [

                    "exam_term.required"          => "Exam field term is required",
                    "class_name.required"         => "Class field is required",
                    "subject_name.required"       => "Subject field is required",
                    "total_mark.required"         => "Total mark field is required",
                    "question_title.*.required"   => "Question title field is required",
                    "question_mark.*.required"    => "Mark field is required",
                    "questions.*.required"        => "Question field is required"   
                ]);

                if ($unValid->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $unValid->errors()->toArray()
                    ]);
                }

                if (is_null($request->question_id)) {

                    Question::create([
                        'type'          => $request->question_type,  
                        'school_id'     => authUser()->id,
                        'term_id'       => $request->exam_term,
                        'class_id'       => $request->class_name,
                        'subject_id'       => $request->subject_name,
                        'hours'          => $request->hours,
                        'total_marks'   => $request->total_mark,   
                        'question_title' => $request->question_title,
                        'question_mark' => $request->question_mark,
                        'question'     => $request->questions
                    ]);

                } else {
                    $question_id = Question::findOrFail($request->question_id);
                    
                    $question_id->update([
                        'type'          => $request->question_type,  
                        'school_id'     => authUser()->id,
                        'term_id'       => $request->exam_term,
                        'class_id'       => $request->class_name,
                        'subject_id'       => $request->subject_name,
                        'hours'          => $request->hours,
                        'total_marks'   => $request->total_mark,   
                        'question_title' => $request->question_title,
                        'question_mark' => $request->question_mark,
                        'question'     => $request->questions
                ]);
                }

                toast('Question Create Successful', 'success');
                return response()->json(['status' => 'success']);

            }  elseif (!empty($request->mcqQuestion_no[1][1])) {

                $unValid = Validator::make($request->all(), [
                    'exam_term'         => 'required',
                    'class_name'        => 'required',
                    'subject_name'      => 'required',
                    'hours'             => 'required|numeric|min:1|max:100',
                    'total_mark'        => 'required|numeric|min:1|max:100',
                    'mcqQuestion_no.*'    => 'required',
                    'mcqQuestions.*'    => 'required',
                    
                ], [
                    "exam_term.required"    => "Exam field term is required",
                    "class_name.required"   => "Class field is required",
                    "subject_name.required" => "Subject field is required",
                    "total_mark.required"   => "Total mark field is required",
                    "mcqQuestion_no.*.required"   => "Mcq question field is required",
                    "mcqQuestions.*.required"   => "Question field is required",
                ]);

                if ($unValid->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $unValid->errors()->toArray()
                    ]);
                }

                if (is_null($request->question_id)) {

                    Question::create([
                        'type'          => $request->question_type,
                        'school_id'     => authUser()->id,
                        'term_id'       => $request->exam_term,
                        'class_id'       => $request->class_name,
                        'subject_id'       => $request->subject_name,
                        'hours'          => $request->hours,
                        'total_marks'   => $request->total_mark,
                        'mcq_question'  => $request->mcqQuestion_no,   
                        'question_mark' => $request->mcqQuestion_mark,
                        'question'     => $request->mcqQuestions
                    ]);
                } else {
                    $question_id = Question::findOrFail($request->question_id);
                    $question_id->update([
                        'type'          => $request->question_type,
                        'school_id'     => authUser()->id,
                        'term_id'       => $request->exam_term,
                        'class_id'       => $request->class_name,
                        'subject_id'       => $request->subject_name,
                        'hours'          => $request->hours,
                        'total_marks'   => $request->total_mark,
                        'mcq_question'  => $request->mcqQuestion_no,   
                        'question_mark' => $request->mcqQuestion_mark,
                        'question'     => $request->mcqQuestions
                    ]);
                }

                toast('Question Create Successful', 'success');
                return response()->json(['status' => 'success']);

            } elseif (!empty($request->creQuestions[1])) {
                
                $unValid = Validator::make($request->all(), [
                    'exam_term'             => 'required',
                    'class_name'            => 'required',
                    'subject_name'          => 'required',
                    'hours'                 => 'required|numeric|min:1|max:100',
                    'total_mark'            => 'required|numeric|min:1|max:100',
                    'creQuestion_no.*'      => 'required',
                    'creQuestion_mark.*'    => 'required',
                    'creQuestions.*'        => 'required',
                    
                ], [
                    "exam_term.required"            => "This exam field term is required",
                    "class_name.required"           => "This class field is required",
                    "subject_name.required"         => "This subject field is required",
                    "total_mark.required"           => "This total mark field is required",
                    "creQuestions.*.required"       => "This question field is required",
                    "creQuestion_no.*.required"     => "This creative question field is required",
                    "creQuestion_mark.*.required"   => "This question mark field is required",
                ]);

                if ($unValid->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $unValid->errors()->toArray()
                    ]);
                }
                
                if (is_null($request->question_id)) {

                    Question::create([
                        'type'              => $request->question_type,
                        'school_id'         => authUser()->id,
                        'term_id'           => $request->exam_term,
                        'class_id'          => $request->class_name,
                        'subject_id'        => $request->subject_name,
                        'hours'             => $request->hours,
                        'total_marks'       => $request->total_mark,
                        'cre_question'      => $request->creQuestion_no,   
                        'question_mark'     => $request->creQuestion_mark,
                        'question'          => $request->creQuestions
                    ]);
                } else {
                    $question_id = Question::findOrFail($request->question_id);
                    $question_id->update([
                        'type'              => $request->question_type,
                        'school_id'         => authUser()->id,
                        'term_id'           => $request->exam_term,
                        'class_id'          => $request->class_name,
                        'subject_id'        => $request->subject_name,
                        'hours'             => $request->hours,
                        'total_marks'       => $request->total_mark,
                        'cre_question'      => $request->creQuestion_no,   
                        'question_mark'     => $request->creQuestion_mark,
                        'question'          => $request->creQuestions
                    ]);

                }

                toast('Question Create Successful', 'success');
                return response()->json(['status' => 'success']);
            }
            
            toast(' Check your question field blank', 'error');
            return back();
        }
        else 
            return back();
        
    }

    /**
     * Save Question
     * 
     * @param Request
     * @param $request
     * @return \Illuminate\Contracts\View\ 
     */
    public function ajaxQuestionStore(Request $request)
    {   

        if(hasPermission('question_create') | hasPermission('question_edit')){
            if ($request->question_type == "Written") {
            
                $validator = Validator::make($request->all(), [
                    'exam_term'         => 'required|',
                    'class_name'        => 'required',
                    'subject_name'      => 'required',
                    'hours'             => 'required|min:1|numeric',
                    'total_mark'        => 'required|min:1|numeric',
                    'question_title.*'    => 'required',
                    'question_mark.*'     => 'required',
                    // 'questions.*'          => 'required',
                    
                ], [
                    "exam_term.required"            => "This exam field term is required",
                    "class_name.required"           => "This class field is required",
                    "subject_name.required"         => "This subject field is required",
                    "total_mark.required"           => "This total mark field is required",
                    "question_title.*.required"     => "This question title field is required",
                    "question_mark.*.required"      => "This mark field is required",
                    "questions.*.required"          => "This question field is required"   
                ]);
    
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $validator->errors()->toArray()
                    ]);
                }else {
                    if (is_null($request->question_id)) {
                        
                        $id =  Question::create([
                              'type'          => $request->question_type,  
                              'school_id'     => authUser()->id,
                              'term_id'       => $request->exam_term,
                              'class_id'       => $request->class_name,
                              'subject_id'       => $request->subject_name,
                              'hours'          => $request->hours,
                              'total_marks'   => $request->total_mark,   
                              'question_title' => $request->question_title,
                              'question_mark' => $request->question_mark,
                              'question'     => $request->questions
                          ]);
                          
                          if($id->id != null) {
                              return response()->json($id);
                          }
                    } else {
                        $question_id = Question::findOrFail($request->question_id);
                        
                        $question_id->update([
                              'type'          => $request->question_type,  
                              'school_id'     => authUser()->id,
                              'term_id'       => $request->exam_term,
                              'class_id'       => $request->class_name,
                              'subject_id'       => $request->subject_name,
                              'hours'          => $request->hours,
                              'total_marks'   => $request->total_mark,   
                              'question_title' => $request->question_title,
                              'question_mark' => $request->question_mark,
                              'question'     => $request->questions
                        ]);
                    }
                }
            }  elseif ($request->question_type == "MCQ") {
               
                $validator = Validator::make($request->all(), [
                    'exam_term'         => 'required',
                    'class_name'        => 'required',
                    'subject_name'      => 'required',
                    'hours'             => 'required|min:1|numeric',
                    'total_mark'        => 'required|min:1|numeric',
                    'mcqQuestion_no.*'    => 'required',
                    // 'mcqQuestions.*'    => 'required',
                    
                ], [
                    "exam_term.required"    => "This exam field term is required",
                    "class_name.required"   => "This class field is required",
                    "subject_name.required" => "This subject field is required",
                    "total_mark.required"   => "This total mark field is required",
                    "mcqQuestion_no.*.required"   => "This mcq question field is required",
                    // "mcqQuestions.*.required"   => "This question field is required",
                ]);
                
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $validator->errors()->toArray()
                    ]);
                }else{
                    if (is_null($request->question_id)) {
                        
                       $id = Question::create([
                            'type'          => $request->question_type,
                            'school_id'     => authUser()->id,
                            'term_id'       => $request->exam_term,
                            'class_id'       => $request->class_name,
                            'subject_id'       => $request->subject_name,
                            'hours'          => $request->hours,
                            'total_marks'   => $request->total_mark,
                            'mcq_question'  => $request->mcqQuestion_no,   
                            'question_mark' => $request->mcqQuestion_mark,
                            'question'     => $request->mcqQuestions
                        ]);
        
                        return response()->json($id);
                    }
                    $question_id = Question::findOrFail($request->question_id);
        
                    $question_id->update([
                        'type'          => $request->question_type,
                        'school_id'     => authUser()->id,
                        'term_id'       => $request->exam_term,
                        'class_id'       => $request->class_name,
                        'subject_id'       => $request->subject_name,
                        'hours'          => $request->hours,
                        'total_marks'   => $request->total_mark,
                        'mcq_question'  => $request->mcqQuestion_no,   
                        'question_mark' => $request->mcqQuestion_mark,
                        'question'     => $request->mcqQuestions
                    ]);
                }
            } elseif ($request->question_type == "Creative") {
                $validator = Validator::make($request->all(), [
                    'exam_term'             => 'required',
                    'class_name'            => 'required',
                    'subject_name'          => 'required',
                    'hours'                 => 'required|min:1|numeric',
                    'total_mark'            => 'required|min:1|numeric',
                    'creQuestion_no.*'      => 'required',
                    'creQuestion_mark.*'    => 'required',
                    // 'creQuestions.*'        => 'required',
                    
                ], [
                    "exam_term.required"            => "This exam field term is required",
                    "class_name.required"           => "This class field is required",
                    "subject_name.required"         => "This subject field is required",
                    "total_mark.required"           => "This total mark field is required",
                    // "creQuestions.*.required"       => "This question field is required",
                    "creQuestion_no.*.required"     => "This creative question field is required",
                    "creQuestion_mark.*.required"   => "This question mark field is required",
                ]);
    
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'fail',
                        'error'  => $validator->errors()->toArray()
                    ]);
                }else{
    
                    if (is_null($request->question_id)) {
        
                      $id =  Question::create([
                        'type'              => $request->question_type,
                        'school_id'         => authUser()->id,
                        'term_id'           => $request->exam_term,
                        'class_id'          => $request->class_name,
                        'subject_id'        => $request->subject_name,
                        'hours'             => $request->hours,
                        'total_marks'       => $request->total_mark,
                        'cre_question'      => $request->creQuestion_no,   
                        'question_mark'     => $request->creQuestion_mark,
                        'question'          => $request->creQuestions
                        ]);
        
                        return response()->json($id);
                    }
                    $question_id = Question::findOrFail($request->question_id);
        
                    $question_id->update([
                    'type'              => $request->question_type,
                    'school_id'         => authUser()->id,
                    'term_id'           => $request->exam_term,
                    'class_id'          => $request->class_name,
                    'subject_id'        => $request->subject_name,
                    'hours'             => $request->hours,
                    'total_marks'       => $request->total_mark,
                    'cre_question'      => $request->creQuestion_no,   
                    'question_mark'     => $request->creQuestion_mark,
                    'question'          => $request->creQuestions
                    ]);
                }
        
            }
        }
        else 
            return back();
    }
    
    /**
     * Ckeditor Upload Image
     * 
     * @param Request 
     * @param $request
     * @return \Illuminate\Contracts\View\ 
     */
    public function imageUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->move('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/'.$filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }

    /** 
     * Show All Question
     * 
     * @return View
     */
    public function showQuestion()
    {  
        $seoTitle = 'Question List';
        $seoDescription = 'Question List' ;
        $seoKeyword = 'Question List' ;
        $seo_array = [
            
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $data['questions'] = Question::with('term', 'class', 'subject')->where('school_id', authUser()->id)->get();
        $data['classes'] = InstituteClass::where('school_id', authUser()->id)->get();
        $data['terms']   = Term::where('school_id', authUser()->id)->orderBy('id','desc')->get();
        if(hasPermission('question_show'))
            return view('frontend.school.question.questionShow', $data , compact('seo_array'));
        else 
            return back();
    
    }
    
    /**
     * View Single Question with ajax
     * 
     * @param $id
     * @return 
     */
    public function viewSingleQuestion($id)
    {   
        
        $questions = Question::with('school', 'term', 'class', 'subject')->where('school_id', authUser()->id)
                                ->where('id', $id)->latest()->get(); 

        return response()->json($questions);
    }

    /**
     * View Single Question
     * 
     * @param $id
     * @return 
     */
    public function viewMcqCreativeQuestion($id)
    {   
        $seoTitle = 'Question View';
        $seoDescription = 'Question View' ;
        $seoKeyword = 'Question View' ;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $questions = Question::with('school', 'term', 'class', 'subject')->where('school_id', authUser()->id)
                                ->where('id', $id)->latest()->get();
        if(hasPermission('question_show'))
            return view('frontend.school.question.view_single_question', compact('questions','seo_array'));                        
        else 
            return back();
    }

    /**
     * Term Wies Question 
     * 
     * @param $id
     * @return 
     */
    public function termWiseQuestion($id)
    {
        $questions = Question::with('school', 'term', 'class', 'subject')->where('school_id', authUser()->id)
                                ->where('class_id', $id)->latest()->get();                 

        return response()->json($questions);
    }

    /**
     * Edit Question 
     * 
     * @param $id
     * @return 
     */
    public function editQuestion($id)
    {   
        $seoTitle = 'Question Edit';
        $seoDescription = 'Question Edit' ;
        $seoKeyword = 'Question Edit' ;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $data['question'] = Question::with('school', 'term', 'class', 'subject')
                                ->where('school_id', authUser()->id)
                                ->where('id', $id)->first();
        $data['classes'] = InstituteClass::where('school_id', authUser()->id)->get();
        $data['terms']   = Term::where('school_id', authUser()->id)->get();
        $data['subjects'] = Subject::where('school_id', authUser()->id)->get();
        if(hasPermission('question_edit'))
            return view('frontend.school.question.edit_question', $data ,compact('seo_array'));
        else 
            return back();
    
    }

    /**
     * Update Question
     *   
     * @param Request
     * @param $request
     * @param $id
     * @return redirect 
     */
    public function updateQuestion(Request $request, $id)
    { 
        $qnUpdate = Question::where('school_id', authUser()->id)->where('id', $id);
        
        if (!empty($request->question_title[1])) {

            $request->validate([
                'question_type'     => 'required', 
                'exam_term'         => 'required|',
                'class_name'        => 'required',
                'subject_name'      => 'required',
                'hours'             => 'required|numeric|min:1|max:100',
                'total_mark'        => 'required|numeric|max:100',
                'question_title.*'    => 'required',
                'question_mark.*'     => 'required|numeric',
                'questions.*'          => 'required',
                
            ], [
                "question_type.required"    => "Question type field is required",
                "exam_term.required"        => "Exam field term is required",
                "class_name.required"       => "Class field is required",
                "subject_name.required"     => "Subject field is required",
                "total_mark.required"       => "Total mark field is required",
                "question_title.*.required"   => "Question title field is required",
                "question_mark.*.required"    => "Mark field is required",
                "questions.*."                 => "Question field is required"   
            ]);
    
            $qnUpdate->update([
                'type'          => $request->question_type,  
                'school_id'     => authUser()->id,
                'term_id'       => $request->exam_term,
                'class_id'       => $request->class_name,
                'subject_id'       => $request->subject_name,
                'hours'          => $request->hours,
                'total_marks'   => $request->total_mark,   
                'question_title' => $request->question_title,
                'question_mark' => $request->question_mark,
                'question'     => $request->questions
            ]);
            toast('Question Update Successful', 'success');
    
            return redirect()->route('show.question');

        }  elseif (!empty($request->mcqQuestion_no[1][1])) {
            $request->validate([
                'question_type'     => 'required',
                'exam_term'         => 'required',
                'class_name'        => 'required',
                'subject_name'      => 'required',
                'hours'             => 'required|numeric|min:1|max:100',
                'total_mark'        => 'required|numeric|max:100',
                'mcqQuestion_no.*'  => 'required',
                'mcqQuestions.*'    => 'required',
                
                
            ], [
                "question_type.required"    => "Question type field is required",
                "exam_term.required"    => "Exam field term is required",
                "class_name.required"   => "Class field is required",
                "subject_name.required" => "Subject field is required",
                "total_mark.required"   => "Total mark field is required",
                "mcqQuestion_no.*.required"   => "Mcq question field is required",
                "mcqQuestions.*.required"   => "Question field is required",
            ]);
    
            $qnUpdate->update([
                'type'          => $request->question_type,
                'school_id'     => authUser()->id,
                'term_id'       => $request->exam_term,
                'class_id'       => $request->class_name,
                'subject_id'       => $request->subject_name,
                'hours'          => $request->hours,
                'total_marks'   => $request->total_mark,
                'mcq_question'  => $request->mcqQuestion_no,   
                'question'     => $request->mcqQuestions
            ]);
            toast('Question Update Successful', 'success');
    
            return redirect()->route('show.question');

        } elseif (!empty($request->creQuestions[1])) {
            // dd($request->all());
            $request->validate([
                'question_type'     => 'required',
                'exam_term'         => 'required',
                'class_name'        => 'required',
                'subject_name'      => 'required',
                'hours'             => 'required|numeric|min:1|max:100',
                'total_mark'        => 'required|numeric|max:100',
                'creQuestion_no.*'    => 'required',
                'creQuestion_mark.*'    => 'required',
                'creQuestions.*'    => 'required',
                
            ], [
                "question_type.required"    => "Question type field is required",
                "exam_term.required"    => "Exam field term is required",
                "class_name.required"   => "Class field is required",
                "subject_name.required" => "Subject field is required",
                "total_mark.required"   => "Total mark field is required",
                "creQuestions.*.required"   => "Question field is required",
                "creQuestion_no.*.required"   => "Creative question field is required",
                "creQuestion_mark.*.required"   => "Question mark field is required",
            ]);
    
            $qnUpdate->update([
                'type'          => $request->question_type,
                'school_id'     => authUser()->id,
                'term_id'       => $request->exam_term,
                'class_id'       => $request->class_name,
                'subject_id'       => $request->subject_name,
                'hours'          => $request->hours,
                'total_marks'   => $request->total_mark,
                'cre_question'  => $request->creQuestion_no,   
                'question_mark' => $request->creQuestion_mark,
                'question'     => $request->creQuestions
            ]);
            toast('Question Update Successful', 'success');
    
            return redirect()->route('show.question');
        }
        
        return redirect()->back(); 
    }

    /**
     * Delete Question
     * 
     * @param $id
     * @return redirect
     */
    public function deleteQuestion($id)
    {
        if(hasPermission('question_delete')){
            $deleteQuestion = Question::where('school_id', authUser()->id)->findOrFail($id);
            $deleteQuestion->delete();
            toast("Question Delete Successful", "success");

            return redirect()->back();
        }
        else
            return back();
        
    }
    public function Question_check_delete(Request $request)
    {
        if(hasPermission('question_delete')){
            $ids = $request->ids;
            Question::whereIn('id',$ids)->delete();
            Alert::success(' Selected Questions are deleted', 'Success Message');
            return response()->json(['status'=>'success']);
        }
        else
            return back();
        
    }

    /**
     * Ajax Delete Question
     * 
     * @param $id
     * @return redirect
     */
    public function ajaxDeleteQuestion($id)
    {
        if(hasPermission('question_delete'))
        {
            $deleteQuestion = Question::where('school_id', authUser()->id)->findOrFail($id);
            $deleteQuestion->delete();
            toast("Question Delete Successful", "success");

            return redirect()->back();
        }
        else{
            return back();
        }
    }

    /**
     * Pdf Download
     * 
     * @param $id
     * @return 
     */
    public function pdfQuestion($id)
    {
        $question = Question::with('school', 'term', 'class', 'subject')
        ->where('school_id', authUser()->id)
        ->where('id', $id)->first();
        $pdf = Pdf::loadView('frontend.school.question.question_pdf', compact('question'));
        return $pdf->download('question.pdf');
        // return view('frontend.school.question.question_pdf', compact('question'));
    }
    
    public function PdeleteQuestion( $id)
    {
        Question::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public function restoreQuestion($id){
        Question::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }

    public function QuestionBankPage(){

        $seoTitle = 'Question Bank';
        $seoDescription = 'Question Bank' ;
        $seoKeyword = 'Question Bank' ;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        $questionbank=Question::get();
        return view('frontend.school.question.questionBankPage',compact('seo_array','questionbank'));
    }
    
    public function Question_searchpage(){
        $data['terms'] = Term::where('school_id', authUser()->id)->orderBy('id','desc')->get();
        $data['questions'] = Question::with('term')->where('school_id', authUser()->id)->get();
        
        return view('frontend.school.question.questionsearchpage',$data);
    }
    public function Question_classpage($term_id){

       
        $data['questions'] = Question::with('class')->where('term_id', $term_id)->where('school_id', authUser()->id)->get();
        $data['classes'] = InstituteClass::where('school_id', authUser()->id)->get();
        $data['terms']   = Term::where('school_id', authUser()->id)->orderBy('id','desc')->get();
         
        return view('frontend.school.question.questionClasspage',$data);
    }

    public function QuestionBankClass(){

        $seoTitle = 'Question Bank';
        $seoDescription = 'Question Bank' ;
        $seoKeyword = 'Question Bank' ;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        return view('frontend.school.question.questionBankPage',compact('seo_array'));
    }

}
