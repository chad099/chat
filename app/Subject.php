<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Subject extends Model
{

    protected $table = 'subject';
    protected $guarded = array();
    public static function store($request){
      $subject = Subject::firstOrNew(array('id'=>$request->id));
      $subject->std_class = $request->std_class;
      $subject->name = $request->name;
      $subject->save();
      Session::flash('success','Subject saved successfully');
      return true;
    }
}
