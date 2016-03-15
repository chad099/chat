<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input,Auth;
use Illuminate\Http\Request;
use Session;
use App\File, App\SchoolVideo;
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
      $video->title = $request->title;
      $video->video = ($request->hasFile('video'))? self::uploadVideo($request):'';
      $video->save();

      if($request->hasFile('files') && count($request->input('files')>0)){
        $files = $request->files;
        foreach($files as $key=>$value){
            foreach ($value as $key=>$value) {
                $fileDetails = self::fileUpload($value);
                $file = File::firstOrNew(array('id'=>''));
                $file->video_id = $video->id;
                $file->name = $fileDetails['name'];
                $file->path = $fileDetails['path'];
                $file->type = $fileDetails['type'];
                $file->save();
            }
        }

      }

      self::assignToSchool($request, $video->id);

      Session::flash('success','Tutorial created successfully');
      return true;
    }

    public static function assignToSchool($request,$id){
        $schools = $request->schools;
        SchoolVideo::where('video_id', $id)->delete();
        if(count($schools)>0){
          foreach($schools as $school){
              $school_video = new SchoolVideo;
              $school_video->school_id = $school;
              $school_video->video_id =$id;
              $school_video->save();
          }
        }
      return true;
    }

    public static function fileUpload($file){
        $destinationPath = 'files'; // upload path
        $data['name'] = explode('.',$file->getClientOriginalName())[0];
        $data['type'] = $extension = $file->getClientOriginalExtension(); // getting image extension
        $data['path'] = $fileName  = 'file_'.rand(11111,99999).'.'.$extension; // renameing image
        $file->move($destinationPath, $fileName); // uploading file to given path
        return $data;
    }

    public static function uploadVideo($request){
      $destinationPath = 'files'; // upload path
      $video = $request->file($request->input('video'));
      $video = $video["video"];
      $extension = $video->getClientOriginalExtension(); // getting image extension
      $fileName = 'video_'.rand(11111,99999).'.'.$extension; // renameing image
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

    public function files(){
      return $this->hasMany('App\File','video_id','id');
    }

    public function getAssindTutorial(){
      $data = [];
      $school_videos = SchoolVideo::where('video_id',$this->id)->get();
      if(count($school_videos)>0){
        foreach($school_videos as $school_video){
          if(!in_array($school_video->school_id,$data)){
              array_push($data,$school_video->school_id);
          }
        }
      }
      return $data;
    }
}
