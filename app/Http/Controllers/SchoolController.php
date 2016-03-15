<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use Session;
class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['schools'] = School::orderBy('created_at','DESC')->paginate(10);
        $data['page'] = 'school';
        return view('admin',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = 'school_create_edit';
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
        $this->validate($request,[
          'name'=>'required',
          'address'=>'required',
          'logo'=>'mimes:jpeg,jpg,png|max:3000'
        ]);

        School::store($request);
        return redirect('/school');
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
        $data['page'] = 'school_create_edit';
        $data['school'] = School::find($id);
        return view('admin',$data);
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
      $this->validate($request,[
        'name'=>'required',
        'address'=>'required'
      ]);

      School::store($request);
      return redirect('/school');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        if($school)
            $school->delete();
        Session::flash('success','School deleted successfully');
        return back();
    }

    public function removeLogo($id){
      $school = School::find($id);
      try{
          unlink($school->logo);
          $school->logo = '';
          $school->save();
      }catch(\Exception $e){
        $school->logo = '';
        $school->save();
      }
      Session::flash('succces','Logo removed successfully');
      return back();

    }
}
