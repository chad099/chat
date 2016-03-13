<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject, Session;
class AddSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page'] = 'subjectlist';
        $data['subjects'] = Subject::paginate(10);
        return view('admin',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['page'] = 'create_edit_subject';
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
        $this->addEditSubject($request);
        return  redirect('/addsubject');
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
      $data['subject'] = Subject::find($id);
      $data['page'] = 'create_edit_subject';
      return view('admin',$data);
    }

    private function addEditSubject($request){
        Subject::store($request);
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
        $this->addEditSubject($request);
        return  redirect('/addsubject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject  = Subject::find($id);
        if($subject){
          $subject->delete();
          Session::flash('success','Subject delete successfully');
        }

        return back();
    }

    public function getsubjects(Request $request){
      $subjects = Subject::where('std_class',$request->std_class)->get();

      return ['status'=>'success','subjects'=>$subjects];

    }
}
