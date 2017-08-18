<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Loan;
use App\Menu;
use Hash;
use App\User;
use App\Orders;
use App\Menu_Group;
use App\ProcessStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
  public function index(){
   if(Auth::guard('web')->check())
   {
    return redirect()->route('dashboard');
  }
  return view('users.login');
}
// public function indexchangeUser(){
// if(session()->get('username')){
 // return view('business.user.changeuser',compact(session()->get('username')));
 // return view('business.user.demo');

// }
// else{
//   return view('users.login');
// }
// }
public function login(LoginRequest $request){
  if($request->back_url != null){
    $nameroute = $request->back_url;
  }
  else{
    $nameroute= 'dashboard';
  }

  $username = Auth::attempt(['username'=>$request->username,'password'=>$request->password,'status'=>1]);
  $email = Auth::attempt(['email'=>$request->username,'password'=>$request->password,'status'=>1]);
  if($username==true){
    return redirect()->route($nameroute);
  }
  else if($email==true){
    return redirect()->route($nameroute);
  }
  else{
    $errors = new MessageBag(['errorslogin'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
    return redirect()->back()->withErrors($errors);
  }
// if($auth==true){
//   $user =  DB::table('user')->select('remember_token','username')->where('user.username','=',$request->username)->get()->first();
//   if($user->remember_token==""){
//     Auth::guard('web')->logout();
//     session()->put('username',$user->username);
//     return redirect()->route('indexChangeUser');
//   }else{
//     return redirect()->route($nameroute);
//   }
// }
// else{
//   $errors = new MessageBag(['errorslogin'=>'Tên đăng nhập hoặc mật khẩu không đúng']);
//   return redirect()->back()->withErrors($errors);
// }
}
public function signout(){
  Auth::guard('web')->logout();
  return redirect()->route('getlogin');
}
}
