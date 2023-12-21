<?php

namespace App\Http\Controllers;

use App\Models\InstituteClass;
use App\Models\MarkType;
use App\Models\User;
use Exception;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use App\Models\ResultSubjectCountableMark;
use App\Models\ResultSetting as ModelsResultSetting;
use App\Models\Section;

class ResultSetting extends Controller
{
    /**
     * Show Result Create Setting Page (Sajjad Devel)
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createSetting()
    {
        if (hasPermission('result_upload_create')) {

            $seoTitle = 'Result Setting';
            $seoDescription = 'Result Setting';
            $seoKeyword = 'Result Setting';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $create = "createResultSetting";
            return view("frontend.school.student.result.result_setting", compact('create', 'seo_array'));
        } else {
            return back();
        }
    }


    /**
     * Author by Sajjad
     * Show All Result Setting with ajax
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function showResultSetting()
    {
        if (hasPermission('result_upload_create')) {


            $leatestResultSetting = ModelsResultSetting::where('school_id', authUser()->id)->latest()->first();

            return response()->json($leatestResultSetting);
        } else {
            return back();
        }
    }

    /**
     * Save Setting (Sajjad Devel)
     *
     * @param Request
     * @param $request
     * @return \Illuminate\Routing\Redirector
     */
    public function saveSetting(Request $request)
    {
        $request->validate([
            "title"          => "required|regex:/^[a-zA-Z0-9\s]+$/u",
            "pass_mark"      => "required|numeric",
            "subject_mark"   => "required|numeric"
        ]);

        try {
            $id =  ModelsResultSetting::create([
                "title"                 => $request->title,
                "pass_mark"             => $request->pass_mark,
                "all_subject_mark"      => $request->subject_mark,
                "school_id"             => authUser()->id
            ]);

            toast("Your Result Setting Successful", "success");
            return redirect()->route("show.mark.type", ['id' => $id->id]);
        } catch (\Exception $e) {
            toast("$e", "error");
        }
    }

    /**
     * Update Result Setting
     *
     * @param Request
     * @param $request
     * @return
     */
    public function updateSetting(Request $request)
    {
        if (hasPermission('result_upload_create')) {

            $resultSettingId = $request->resultSettingId;

            $request->validate([
                "title"          => "required|regex:/^[a-zA-Z0-9\s]+$/u",
                "pass_mark"      => "required|numeric",
                "subject_mark"   => "required|numeric"
            ]);

            ModelsResultSetting::where("school_id", authUser()->id)->where('id', $request->resultSettingId)->update([
                "title"                 => $request->title,
                "pass_mark"             => $request->pass_mark,
                "all_subject_mark"      => $request->subject_mark,
                "school_id"             => authUser()->id
            ]);

            toast("Update Result Setting Successfuly", 'success');
            return redirect()->route("show.mark.type", ['id' => $resultSettingId]);
        } else {
            return back();
        }
    }

    /**
     * Duplicate Result Setting
     *
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param $id
     * @return \Illuminate\Routing\Redirector
     */
    public function duplicateResultSetting($id)
    {
        if (hasPermission('result_upload_duplicate')) {

            $resultSetting = ModelsResultSetting::findOrFail($id);
            $title = $resultSetting->title;
            $resultSubjectCountableMarks = ResultSubjectCountableMark::where('school_id', authUser()->id)->where('result_setting_id', $id)->get();
            $number = filter_var($title, FILTER_SANITIZE_NUMBER_INT);
            $findTitle = str_replace($number, '', $title);
            $maxNum = [];

            $searchTitles = ModelsResultSetting::where('school_id', authUser()->id)->where('title', 'like', '%' . $findTitle . '%')->get();
            foreach ($searchTitles as $searchTitle) {
                $number = filter_var($searchTitle->title, FILTER_SANITIZE_NUMBER_INT);
                $maxNum[] = $number;
            }

            $maxTermNum = max($maxNum);
            if ($maxTermNum == null) {
                $newTitle = $title . ' ' . '1';
            } else {
                $newTitle = $findTitle . ' ' . ++$maxTermNum;
            }

            try {
                $id =  ModelsResultSetting::create([
                    "title"                 => $newTitle,
                    "pass_mark"             => $resultSetting->pass_mark,
                    "all_subject_mark"      => $resultSetting->all_subject_mark,
                    "school_id"             => authUser()->id
                ]);

                foreach ($resultSubjectCountableMarks as $resultSubjectCountableMark) {
                    ResultSubjectCountableMark::create([
                        "result_setting_id"         => $id->id,
                        "institute_class_id"        => $resultSubjectCountableMark->institute_class_id,
                        "subject_id"                => $resultSubjectCountableMark->subject_id,
                        "school_id"                 => authUser()->id,
                        "mark"                      => $resultSubjectCountableMark->mark,
                    ]);
                };
                return response()->json(['status' => 'success']);
            } catch (Exception $e) {
                toast($e->getMessage(), 'error');

                return back();
            }
        } else {
            return back();
        }
    }

    /**
     * Delete Result Setting
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSetting($id)
    {
        if (hasPermission('result_upload_delete')) {

            $countResult = ResultSubjectCountableMark::where('result_setting_id', $id)->delete();

            $result = Result::where('term_id', $id)->delete();

            ModelsResultSetting::findOrFail($id)->delete();
            ResultSubjectCountableMark::where("result_setting_id", $id)->where('school_id', authUser()->id)->delete();
            Result::where('term_id', $id)->where('school_id', authUser()->id)->delete();

            toast("Result Setting Delete Successfuly", "success");
            return back();
        } else {
            return back();
        }
    }
    /**
     * Edit Result System
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editResultSetting($id)
    {
        if (hasPermission('result_upload_edit')) {

            return redirect()->route("result.up.first.step", ['id' => $id]);
        } else {
            return back();
        }
    }
    /**
     * Just Edit Result Setting
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function justEditResultSetting($id)
    {
        $editResultSetting = ModelsResultSetting::findOrFail($id);
        $create = "editSetting";
        return view("frontend.school.student.result.result_setting", compact('editResultSetting', 'create'));
    }

    /**
     * Store Subject Mark
     *
     * @param Request
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubjectMark(Request $request)
    {
        $request->validate([
            "resultSettingId"   => 'required',
            "subjectMark.*"     =>  'required|min:1'
        ]);

        foreach ($request->subjectMark as $class_id => $marks) {
            foreach ($marks as $subject_id => $mark) {
                ResultSubjectCountableMark::updateOrCreate(
                    [
                        "result_setting_id"         => $request->resultSettingId,
                        "institute_class_id"        => $class_id,
                        "subject_id"                => $subject_id,
                        "school_id"                 => authUser()->id,
                    ],
                    [
                        "mcq"                       => $request->mcqMark[$class_id][$subject_id],
                        "written"                   => $request->writtenMark[$class_id][$subject_id],
                        "practical"                 => $request->practicalMark[$class_id][$subject_id],
                        "mark"                      => $mark,
                    ]
                );
            }
        }

        return response()->json(['status' => "success"]);
    }

    /**
     * Store Subject Mark
     *
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function storeSingleSubjectMark(Request $request)
    {
        ResultSubjectCountableMark::updateOrCreate(
            [
                "result_setting_id"         => $request->resultSettingId,
                "institute_class_id"        => $request->class_id,
                "subject_id"                => $request->subject_id,
                "school_id"                 => authUser()->id,
            ],
            [
                "mcq"                       => $request->mcq,
                "written"                   => $request->written,
                "practical"                 => $request->practical,
                "mark"                      => $request->mark,
            ]
        );

        return response()->json(['status' => "success"]);
    }

    /**
     * Get Section With Ajax
     * 
     * @param $class_id
     * @return \Illuminate\Http\Response
     */
    public function getSectionWithAjax($class_id)
    {
        $sections = Section::where('school_id', authUser()->id)
            ->where('class_id', $class_id)
            ->get();

        return response()->json($sections);
    }

    /**
     * Result pdf download first step
     * 
     * @param Request 
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function resultPdf(Request $request)
    {
        if (hasPermission('result_pdf')) {

            $seoTitle = 'Result Pdf';
            $seoDescription = 'Result Pdf';
            $seoKeyword = 'Result Pdf';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $class = InstituteClass::where('school_id', authUser()->id)->get();
            $terms = ModelsResultSetting::where('school_id', authUser()->id)->orderBy('id', 'desc')->get();
            $users = User::where('school_id', authUser()->id)->get();
            return view('frontend.school.result.result_pdf', compact('class', 'terms', 'users', 'seo_array'));
        } else {
            return back();
        }
    }

    /**
     * View All Result Class Wise
     * 
     * @param Request 
     * @param $request
     * @return \Illuminate\Contracts\View\View
     */
    public function resultPdfDownload(Request $request)
    {
        if (hasPermission('result_pdf')) {

            $request->validate([
                "student_wise_term_id" => 'required',
                "student_wise_class_id" => 'required',
                "section_name.*"    => 'required'
            ]);

            if (!isset($request->section_name)) {
                toast("At least select one section", 'error');
                return back();
            }

            try {
                $markType = MarkType::where('institute_classes_id', $request->student_wise_class_id)
                    ->where('school_id', authUser()->id)->orderBy('id', 'Asc')->get();

                $markTypeCount = MarkType::where('institute_classes_id', $request->student_wise_class_id)
                    ->where('school_id', authUser()->id)->count();

                $term = ModelsResultSetting::where('school_id', authUser()->id)
                    ->where('id', $request->student_wise_term_id)->first();

                $results = Result::where('school_id', authUser()->id)
                    ->where('institute_class_id', $request->student_wise_class_id)
                    ->whereIn('section_id', $request->section_name)
                    ->where('term_id', $request->student_wise_term_id)
                    ->orderBy("student_roll_number", "ASC")
                    ->get()
                    ->groupBy('student_id');

                $markTypeCount = $markTypeCount + 1;
            } catch (\Exception $e) {
                return $e->getMessage();
            }

            // return $results;
            return view('frontend.school.result.result_pdf_download', compact('results', 'term', 'markType', 'markTypeCount'));
        } else {
            return back();
        }
    }
    public  function resultrestore($id)
    {
        Result::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public  function pdeleteresult($id)
    {
        Result::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public  function resultSettingrestore($id)
    {
        ModelsResultSetting::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public  function pdeleteresultSetting($id)
    {
        ModelsResultSetting::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    public  function resultCountablemarkrestore($id)
    {
        ResultSubjectCountableMark::withTrashed()->where('id', $id)->restore();
        toast("Restore data", "success");
        return back();
    }
    public  function pdeleteresultCountablemark($id)
    {
        ResultSubjectCountableMark::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
}
