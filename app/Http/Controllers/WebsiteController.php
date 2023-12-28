<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Models\GovorningBody;
use App\Models\InstituteClass;
use App\Models\Notice;
use App\Models\School;
use App\Models\Speech;
use App\Models\Teacher;
use App\Models\User;
use App\Models\webAbout;
use App\Models\WebBlog;
use App\Models\WebsiteImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;
use App\Models\AllUser;
use PhpParser\Node\Stmt\Return_;

class WebsiteController extends Controller
{
    
    public function singlePageWebsite($user_name){
        $school = School::where('user_name', $user_name)->first();
        if($school != null){
            $GovorningBodies = GovorningBody::where('school_id',$school->id)->get();
            $speech = Speech::where('school_id',$school->id)->first();
            $about = webAbout::where('school_id',$school->id)->first();
            $blogs = WebBlog::where('school_id', $school->id)->latest()->take(2)->get();
            $teachers = Teacher::where('school_id', $school->id)->get();
            $basicinfo['user'] = User::where('school_id', $school->id)->count();
            $basicinfo['teacher'] = Teacher::where('school_id', $school->id)->count();
            $basicinfo['class'] = InstituteClass::where('school_id', $school->id)->count();
            $classes = InstituteClass::where('school_id', $school->id)->get();
            $notices = Notice::where('school_id', $school->id)->latest()->take(5)->get();
            $slider = WebsiteImage::where('school_id', $school->id)->where('type', 1)->latest()->take(3)->get();
            $gellary = WebsiteImage::where('school_id', $school->id)->where('type', 2)->latest()->take(8)->get();

            return view('frontend.school.website.singlePage', compact('school', 'GovorningBodies', 'speech', 'about', 'blogs', 'teachers', 'basicinfo', 'notices', 'slider', 'classes', 'gellary'));
        }
        else{
            return redirect('/');
        }
    }
    
    
    public function index(){
        
        $GovorningBody = GovorningBody::where('school_id',authUser()->id)->get();
        
        $data = Speech::where('school_id',authUser()->id)->first();
        $dataAbout = webAbout::where('school_id',authUser()->id)->first();
        return view('frontend.school.website.index',compact('data', 'GovorningBody', 'dataAbout'));
    }

    
    public function createGoverPost(Request $request){
        // return $request;

        $data = new GovorningBody();
        // return $data;
        if ($request->hasFile('image')) {
            // File::delete(public_path($data->image));
            $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('uploads/website'), $fileName);
            $filePath = "/uploads/website/" . $fileName;
            $data->image = $filePath;
            // return $fileName;
        }
        
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->school_id = authUser()->id;
        $data -> save();
        
        // return $data;
        
        $GovorningBody = GovorningBody::where('school_id',authUser()->id)->get();
        
        $data = Speech::where('school_id',authUser()->id)->first();
        $dataAbout = webAbout::where('school_id',authUser()->id)->first();
        return view('frontend.school.website.index',compact('data', 'GovorningBody', 'dataAbout'));
    }

    public function Goverdelete($id)
    {
        $data = GovorningBody::where('id', $id)->delete();
        toast('Data Successfully Deleted', 'success');
        
        $GovorningBody = GovorningBody::where('school_id',authUser()->id)->get();
        
        $data = Speech::where('school_id',authUser()->id)->first();
        $dataAbout = webAbout::where('school_id',authUser()->id)->first();
        return view('frontend.school.website.index',compact('data', 'GovorningBody', 'dataAbout'));
        
    }

    public function createAboutPost(Request $request){
        // return $request;

         $data = webAbout::where('school_id', authUser()->id)->first();
        // return $data;
        if(!empty($data->image)){
            $filePath = $data->image;
        }
        else{
            $filePath = null;
        }
        if ($request->hasFile('image')) {
            if(!empty($data->image)){
                File::delete(public_path($data->image));
            }            
            $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('uploads/website'), $fileName);
            $filePath = "/uploads/website/" . $fileName;
        //    return $data->image = $filePath;
            // return $fileName;
        
       
    }
        // return $data;
        webAbout::updateOrCreate([            
            'school_id' => authUser()->id,  //search by School id then Update it.
        ],[
            'image' =>$filePath,
            'about' => $request['about'],
            
        ]);
        

        $GovorningBody = GovorningBody::where('school_id',authUser()->id)->get();
        
        $data = Speech::where('school_id',authUser()->id)->first();
        $dataAbout = webAbout::where('school_id',authUser()->id)->first();
        return view('frontend.school.website.index',compact('data', 'GovorningBody', 'dataAbout'));
    }

    public function createPost(Request $request){
        // return $request;

        $data = Speech::where('school_id', authUser()->id)->first();
        if(!empty($data->p_image)){
            $filePath = $data->p_image; 
        }
        else{
            $filePath = null; 
        }
             

        if ($request->hasFile('p_image')) {
            if(!empty($data->p_image)){
                File::delete(public_path($data->p_image));
            }
            
            $fileName = date('Ymdhmsis') . '.' . $request->file('p_image')->getclientOriginalExtension();
            $request->file('p_image')->move(public_path('uploads/website'), $fileName);
            $filePath = "/uploads/website/" . $fileName;
            // $data->p_image = $filePath;
            // return $data->p_image;
        }

        // return $data;
        Speech::updateOrCreate([            
            'school_id' => authUser()->id,  //search by School id then Update it.
        ],[
            'name' => $request['name'],
            'designation' => $request['designation'],
            'p_image' => $filePath,
            'speech' => $request['speech'],
        ]);
        

        $GovorningBody = GovorningBody::where('school_id',authUser()->id)->get();
        $dataAbout = webAbout::where('school_id',authUser()->id)->first();
        $data = Speech::where('school_id',authUser()->id)->first();
        return view('frontend.school.website.index',compact('data', 'GovorningBody', 'dataAbout'));
    }

    public function blogShow(){
        $blogs = WebBlog::where('school_id', authUser()->id)->get();
        return view('frontend.school.website.blogTable', compact('blogs'));
    }

    public function blog(){
        return view('frontend.school.website.blog');
    }

    public function blogPost(Request $request){
        // return $request;
        $request->validate([
            'title' => 'required',
            'details' => 'required',
        ]);
        $data = new WebBlog();
        if ($request->hasFile('image')) {
            $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('uploads/web_blog'), $fileName);
            $filePath = "/uploads/web_blog/" . $fileName;
            $data->image = $filePath;
            // return $fileName;
        }

        $data->title = $request->title;
        if ($request->hasFile('image')) {
            // $data->image = $fileName;
        }
        $data->details = $request->details;
        $data->school_id = authUser()->id;

        // return $data;
        $data->save();
        toast('Successfully Blog Created', 'success');

        $blogs = WebBlog::where('school_id', authUser()->id)->get();
        return view('frontend.school.website.blogTable',compact('blogs'));
    }

    public function blogEdit($id)
    {
        $data = WebBlog::find($id);
        
        return view('frontend.school.website.blog',compact('data'));
        
    }

    public function blogUpdate(Request $request,$id){
        // return $request;
        $request->validate([
            'title' => 'required',
            'details' => 'required',
        ]);
        $data = WebBlog::find($id);
        if ($request->hasFile('image')) {
            File::delete(public_path($data->image));
            $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('uploads/web_blog'), $fileName);
            $filePath = "/uploads/web_blog/" . $fileName;
            $data->image = $filePath;
            
        }

        $data->title = $request->title;
        if ($request->hasFile('image')) {
        }
        $data->details = $request->details;
        $data->school_id = authUser()->id;

        // return $data;
        $data->save();
        toast('Successfully Blog updated', 'success');

        $blogs = WebBlog::where('school_id', authUser()->id)->get();
        return view('frontend.school.website.blogTable', compact('blogs'));
    }

    public function blogDelete($id)
    {
        $data = WebBlog::where('id', $id)->delete();
        toast('Successfully Blog Deleted', 'success');
        return back();
        
    }

    public function image(){
        $sliderImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 1)->latest()->get();
        $gellaryImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 2)->latest()->get();
        return view('frontend.school.website.image', compact('sliderImage', 'gellaryImage'));
    }


    public function imagePost(Request $request){
        // return $request;
        $data = new WebsiteImage();
        if ($request->hasFile('image')) {
            $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('uploads/web_image'), $fileName);
            $filePath = "/uploads/web_image/" . $fileName;
            $data->image = $filePath;
            
        }
        $data->type = $request->type;
        $data->school_id = authUser()->id;
        
        $data->save();
        // return $data->image;
        $sliderImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 1)->latest()->get();
        $gellaryImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 2)->latest()->get();
        return view('frontend.school.website.image', compact('sliderImage', 'gellaryImage'));

        
    }

    public function Gallerydelete($id)
    {
        $data = WebsiteImage::where('id', $id)->delete();
        toast('Image Successfully Deleted', 'success');
        
        $sliderImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 1)->latest()->get();
        $gellaryImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 2)->latest()->get();
        alert('Image Deleted');
        return view('frontend.school.website.image', compact('sliderImage', 'gellaryImage'));
        
    }

    public function Sliderdelete($id)
    {
        $data = WebsiteImage::where('id', $id)->delete();
        toast('Image Successfully Deleted', 'success');
        
        $sliderImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 1)->latest()->get();
        $gellaryImage = WebsiteImage::where('school_id', authUser()->id)->where('type', 2)->latest()->get();
        alert('Image Deleted');
        return view('frontend.school.website.image', compact('sliderImage', 'gellaryImage'));
        
    }
    
    
    public function migrateTeachersToUsers()
    {
     $teachers = Teacher::all();

     foreach ($teachers as $teacher) {
        $existingUser = AllUser::where('guard_id', $teacher->id)->where('guard','teacher')->get();

        if (!$existingUser) {
            AllUser::create([
                "email" => $teacher->email,
                "phone" => $teacher->phone,
                "password" => $teacher->password,
                "guard" => "teacher",
                "guard_id" => $teacher->id,
                "school_from" => $teacher->school_id,
            ]);
        }
    }

}
    
    
}
