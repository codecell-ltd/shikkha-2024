<?php

namespace App\Http\Controllers;

use App\Models\InstituteClass;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function sessionCreate()
  {
    return view('frontend/school/Session/session');
  }
  public function newClass()
  {
  return  $classkg = InstituteClass::where('class_name', 'kg')->get();
    foreach ($classkg as $kg) {
      $kg->class_name = 'KG';
      $kg->save();
    }

    
  }
}
