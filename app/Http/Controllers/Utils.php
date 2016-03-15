<?php
namespace App\Http\Controllers;
use App\Subject;
use App\School;
class Utils{

  public static function getsubjects($id){
    return $subjects =  Subject::where('std_class',$id)->get();
  }

  public static function subjects($topic){
    $subject = Subject::where('id', $topic->subject_id)->first();
    return self::getsubjects($subject->std_class);
  }

  public static function schools(){
    return School::all();
  }

}
