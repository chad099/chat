<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Topic extends Model
{
    protected $table = 'topics';
    protected $guarded = array();

    public static function store($request){
      $topic = Topic::firstOrNew(array('id'=>$request->id));
      $topic->subject_id = $request->subject_id;
      $topic->name       = $request->name;
      $topic->description       = $request->description;
      $topic->save();
      Session::flash('success','Topic saved successfully');
      return true;
    }

    public function subject(){
      return $this->hasOne('App\Subject','id','subject_id');
    }

}
