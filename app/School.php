<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class School extends Model
{
    protected $table = 'schools';
    protected $guarded = array();


    public static function store($request){
      $school = School::firstOrNew(array('id'=>$request->id));
      $school->name = $request->name;
      $school->address = $request->address;
      $school->description = $request->description;
      $school->logo = ($request->hasFile('logo'))? self::uploadLogo($request):'';
      $school->save();
      Session::flash('success','School saved successfully');
      return true;
    }

    private static function uploadLogo($request){
      $dir = 'logos';
      $file = $request->file('logo');
      $extension = $file->getClientOriginalExtension();
      $fileName = time().'_'.$file->getClientOriginalName();
      $file->move($dir, $fileName);
      return $fileName;
    }
}
