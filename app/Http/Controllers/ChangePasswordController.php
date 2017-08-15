<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ChangePasswordRequest;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
	public function index($id){
		$user = User::find($id);
		return view('business.changepassword.index',compact('user'));
	}
	public function update(ChangePasswordRequest $request,User $user,$id){
		if(Auth::check()){
			$current_password = User::find($id)->password;   
			if(Hash::check($request->passwordold,$current_password)){
				$obj_user = User::find($id);
				$obj_user->password = Hash::make($request->passwordnew);
				// return $request->all();
				$obj_user->save(); 
				if(Str::lower(Auth::user()->username) != "admin"){
					return redirect()->route('profile');
				}
				else{
					return redirect()->route('user');
				}
			}
			else {
				\Session::flash('error','Mật khẩu cũ không chính xác');
				return back();
			}
		}
		else
			return redirect()->route('login');
	}
	public function indexProfile(){
		$user = Auth::user();
		return view('business.changepassword.index',compact('user'));
	}
	public function updateProfile(ChangePasswordRequest $request,User $user,$id){
		if(Auth::check()){
			$current_password = Auth::user()->password;   
			if(Hash::check($request->passwordold,$current_password)){
				$obj_user = Auth::User();
				$obj_user->password = Hash::make($request->passwordnew);
				// return $request->all();
				$obj_user->save(); 
				return redirect('profile');
			}
			else {
				\Session::flash('error','Mật khẩu cũ không chính xác');
				return back();
			}
		}
		else
			return redirect()->route('login');
	}
}
