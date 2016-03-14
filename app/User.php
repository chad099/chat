<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash,Auth,Session;
use App\License;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function store($request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('success','Profile update successfully');
        return true;
    }

    public static function userRegister($request){
      $user = User::firstOrNew(array('id'=>$request->id));
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      if($user->save()){
        if($request->has('license_key') && $request->license_key == 'yes')
          self::UserLicenseCreate($user);
      }
      Session::flash('success','user update successfully');
      return true;
    }

    public static function UserLicenseCreate($user){
      $license = License::firstOrNew(array('user_id'=>$user->id));
      $license->user_id = $user->id;
      $license->license_key = base64_encode(json_encode($user->id));
      if(!$license->id)
          $license->start_date = date('Y-m-d');
      $license->save();
      return true;
    }

    public function license(){
      $license = License::where('user_id',$this->id)->first();
      if($license)
        return true;
        
      return false;
    }

}
