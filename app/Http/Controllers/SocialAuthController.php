<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite, Auth, App\User;
class SocialAuthController extends Controller
{
  public function socialLogin($type)
 {
     return Socialite::driver($type)->redirect();
 }

 public function redirect($type)
 {
     $user = Socialite::driver($type)->user();
     if (!$user)
         return abort(404);
    echo  "<pre>"; print_r($user); die;     
    $table = User::firstOrNew(['email'=>$user->email]);
    $table->name             = $user->name;
    $table->email            = $user->email;
    $table->token            = $user->token;
    $table->profile_picture  = ( $type == 'facebook' )? $user->avatar_original : $user->avatar;
    $table->auth_type        = $type;
    $table->save();

   Auth::loginUsingId($table->id);
   return redirect('/dashboard');
 }

}
