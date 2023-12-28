<?php

namespace App\Http\Controllers\School;

use App\Models\Subject;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\InstituteClass;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(hasPermission('subject_show')){
            $seoTitle = 'Subject Searchpage';
            $seoDescription = 'Subject Searchpage';
            $seoKeyword = 'Subject Searchpage';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $classes = InstituteClass::where('school_id',authUser()->id)->get();
    
            return view('frontend.school.subject.createShow',compact('classes','seo_array'));
        
        }
        else{
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @author CodeCell <support@codecell.com.bd>
     * @distributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param  $request
     * @return \Illuminate\Contracts\View\View|
     */
    public function show(Request $request)
    {   
        if(hasPermission('subject_show')){
            $seoTitle = 'Subject Show';
            $seoDescription = 'Subject Show';
            $seoKeyword = 'Subject Show';
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $subjects = Subject::where("class_id", $request->class_id)->get();
    
            return view('frontend.school.subject.show')->with(compact('subjects','seo_array'));
        
        }
        else{
            return back();
        }
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Subject_Check_Delete(Request $request){
        if(hasPermission('subject_delete')){
            $ids=$request->ids;
            Subject::withTrashed()->where('id', $id)->forcedelete();
            toast("Data delete permanently", "success");
            return back();
        }
        else{
            return back();
        }
    }
}
