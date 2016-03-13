<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Support\Facades\Input;
use Session;
class addTutorialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

   public function __construct(){
     $this->middleware('auth');
   }
  public function index()
  {
      $data['page'] = 'tutorial';
      $data['videos'] = Video::paginate(10);
      return view('admin',$data);
  }

  protected function validator(array $data,$rules)
  {
      return Validator::make($data, $rules);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $data['page']='tutorial_create_edit';
      return view('admin',$data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
        $this->validate($request, [
           'subject_id' => 'required',
           'std_class' => 'required',
           'topic_id' => 'required',
           'video' => 'required',
       ]);
      $this->addEditVideo($request);
      return redirect('/addtutorial');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data['video'] = Video::find($id);
    $data['page']='tutorial_create_edit';
    return view('admin',$data);
  }

  private function addEditVideo($request){
    Video::store($request);
    return true;
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
      $this->addEditVideo($request);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $video = Video::find($id);
      if($video){
        $video->delete();
        Session::flash('success','Tutorial delete successfully');
      }

      return back();
  }
}
