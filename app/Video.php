<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input,Auth;
use Illuminate\Http\Request;
use Session;
class Video extends Model
{
    protected $table = 'videos';
    protected $guarded = array();

    public static function store($request){
      $video  = Video::firstOrNew(array('id'=>$request->id));
      $video->user_id = Auth::user()->id;
      $video->std_class = $request->std_class;
      $video->subject_id = $request->subject_id;
      $video->description = $request->description;
      $video->topic_id = $request->topic_id;
      $video->video = self::uploadVideo($request);
      $video->save();
      Session::flash('success','Tutorial created successfully');
      return true;
    }

    public static function uploadVideo($request){
      //echo  "<pre>"; print_r($request->all()); die;
      $destinationPath = 'videos'; // upload path
      $video = $request->file($request->input('video'));
      $video = $video["video"];


      //echo "<pre>"; print_r($video); die;
      $extension = $video->getClientOriginalExtension(); // getting image extension
      $fileName = rand(11111,99999).'.mp4'; // renameing image
      $video->move($destinationPath, $fileName); // uploading file to given path
      return $fileName;
    }

    public function subject(){

      return $this->hasOne('App\Subject','id','subject_id');
    }

    public function topics(){
      return Topic::where('subject_id',$this->subject_id)->get();

    }

    public function subjects(){
      return Subject::where('std_class',$this->std_class)->get();
    }
}
