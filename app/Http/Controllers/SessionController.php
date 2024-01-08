<?php

namespace App\Http\Controllers;

use App\Models\InstituteClass;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function sessionCreate(Request $request)
    {
      /**
       * update(['last_session_updated_year' => 2023]) DB classes which does not have any student to update their session. (For the first time on Live SQL - Hridoy)
       * 
       * $classes_has_student = InstituteClass::with('students')->has('students')->get()->pluck('id');
       * InstituteClass::with('students')->whereNotIn('id', $classes_has_student)->update(['last_session_updated_year' => 2023]);
       * return InstituteClass::with('students')->whereNotIn('id', $classes_has_student)->get();
       */

      if($request->class_id){
        $class = InstituteClass::find($request->class_id);
        $next_class = InstituteClass::whereRank($class->rank + 1)->first();

        if(!empty($next_class)){
          if($request->update_session){
            $passed_students = $request->passed_students;
            
            foreach ($request->student_id as $key => $student_id) {
              
                # Find the student by ID and update the roll number & class_id
                if(in_array($student_id, $passed_students)) User::where('id', $student_id)->update(['roll_number' => 0]);
                else User::where('id', $student_id)->update([
                          'roll_number' => $request->new_role_number[$key],
                          'class_id' => $next_class->id
                        ]);
            }

            # Update the session year of the class.
            $class->update([
              'last_session_updated_year' => date('Y') - 1
            ]);
    
            toast('Session updated successfully for this class.', 'success');
          }else {
            $students = User::whereSchoolId(auth('web')->id())->orderBy('roll_number', 'ASC')->whereClassId($request->class_id)->get();
            return view('frontend.school.Session.student_list', compact('students', 'class', 'next_class'));
          }
        }else toast('Next class not available.', 'error');
        return redirect()->route('session.create');
      }

      $classes = InstituteClass::with('students')->has('students')->whereSchoolId(auth('web')->id())->where('last_session_updated_year', date('Y') - 2)->get();
      
      $already_ranked = array_filter($classes->toArray(), function ($class) {
          return isset($class['rank']);
      });

      if (count($already_ranked) == $classes->count()) return view('frontend/school/Session/session', compact('classes'));

      toast('All classes does not have rank properly.', 'error');
      return redirect()->route('class.show');
    }
}