<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Topic;
use Validator, Session;
class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['topics'] = Topic::paginate(10);
        $data['page'] = 'topic';
        return view('admin',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = 'topic_create';
        return view('admin',$data);
    }

    protected function validator(array $data,$rules)
    {
        return Validator::make($data, $rules);
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
           'name' => 'required',
           'description' => 'required',
       ]);

        $this->addEditTopic($request);
        return redirect('/topic');
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
        $data['topic'] = Topic::find($id);
        $data['page'] = 'topic_create';
        return view('admin',$data);
    }


    private function addEditTopic($request){
      Topic::store($request);
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
      $this->validate($request, [
         'subject_id' => 'required',
         'name' => 'required',
         'description' => 'required',
     ]);
      Topic::store($request);
      return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic  = Topic::find($id);
        if($topic){
          $topic->delete();
          Session::flash('success','Topic delete successfully');
        }
        return back();
    }

    public function getTopics(Request $request){

      $topics = Topic::where('subject_id',$request->subject_id)->get();
      return ['status'=>'success','topics'=>$topics];

    }
}
