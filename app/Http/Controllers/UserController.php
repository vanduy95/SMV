<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use App\Menu;
use App\User;
use App\Assess;
use App\UserInfo;
use App\GroupUser;
use Carbon\Carbon;
use App\Organization;
use App\RetailSystem;
use App\User_Retailsystem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\AccountRegisterRequest;
use App\Http\Requests\UserChangePasswordEmployee;

class UserController extends Controller
{
	public function index(){
		$user = User::where([['organization_id','=','1'],['groupuser_id','<>',1]])->get();
		return view('business.user.index',compact('user'));
	}
	public function getcreate(){
		$organization = Organization::where('system','=','1')->get();
		$user = User::all();
		$groupuser = GroupUser::where('name','<>','Admin')->get();;
		return view('business.user.create',compact('user','groupuser','organization'));
	}
	public function postcreate(UserRequest $request,User $user,UserInfo $userinfo){
		$user = new User();
		$user->username = $request->username;
		$user->groupuser_id = $request->groupuser_id;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->status = $request->status;
		$user->organization_id = $request->organization;
		$user->syslock = '0';
		$user->save();
		\Session::flash('notify','Thêm người dùng thành công');
		return redirect()->route('indexuser');
	}
	public function show(Request $req){
		$user = User::find($req->user_id);
		$organization = Organization::where('system','=','1')->get();
		$groupuser = GroupUser::where('name','<>','Admin')->get();;
		return view('business.user.showuser',compact('user','groupuser','organization'));
	}
	public function update(Request $request){
		$user = User::find($request->user_id);
		$user->username = $request->username;
		$user->groupuser_id = $request->groupuser_id;
		$user->email = $request->email;
		$user->status = $request->status;
		$user->syslock = '0';
		$user->organization_id = $request->organization;
		$user->save();
		return response()->json(['user'=>$user,'groupuser'=>$user->groupuser,'organization'=>$user->organization]);
	}
	
	public function getProfile(){
		if(Auth::check()){
			$user = Auth::user();
			if($user->syslock == 1){
				return view('users.profileclient',compact('user'));
			}
			else{
				return view('users.profile',compact('user'));
			}
		}
		else
			return redirect()->route('login');
	}
	
	public function ajaxPostDeleteUser(Request $req)
	{
		User::find($req->user_id)->delete();
		return 'true';
	}

	public function checkUsername(Request $req)
	{
		if($req->has('user_id'))
		{
			$oldUsername=User::find($req->user_id)->username;
			if($oldUsername===$req->username)
			{
				return 'true';
			}
			else
			{
				if(User::where('username',$req->username)->get()->count())
					return 'false';
				else
					return 'true';

			}
		}
		else
		{
			if(User::where('username',$req->username)->get()->count())
					return 'false';
				else
					return 'true';
		}
	}

	public function checkEmail(Request $req)
	{
		if($req->has('user_id'))
		{
			$oldEmail=User::find($req->user_id)->email;
			if($oldEmail===$req->email)
			{
				return 'true';
			}
			else
			{
				if(User::where('email',$req->email)->get()->count())
					return 'false';
				else
					return 'true';

			}
		}
		else{
			if(User::where('email',$req->email)->get()->count())
					return 'false';
				else
					return 'true';
		}	
	}
	public function ajaxGetChangePassword(Request $req)
	{
		$user_id=$req->user_id;
		return view('business.user.changepassword',compact('user_id'));
	}

	public function ajaxPostChangePassword(Request $req)
	{
		$user=User::find($req->user_id);
		$user->password=bcrypt($req->password);
		$user->save();
	}
	public function AjaxCheckUser(Request $r){
		$user = DB::table('user')->where('username','=',$r->username);
		if($user->count()==0 && strlen($r->username) > 5){
			return response()->json(['success'=>'success']);
		}
		else if($user->count()==1 && strlen($r->username) > 5){
			if(session()->get('username')==$r->username){
				return response()->json(['success'=>'success']);
			}
			else{
				return response()->json('Bạn không có quyền đổi mật khẩu!!!');
			}
		}
		else if($user->count()>1){
			return response()->json(['Tài khoản đã tồn tại nhập tại!!!']);
		}
		else{
			return response()->json('Tài khoản không hợp lệ!!!');
		}
	}
	public function UserChangePasswordEmployee(UserChangePasswordEmployee $r){
		if($r->re_password==$r->password){
			$user = DB::table('user')->where('username','=',session()->get('username'))->count();
			if($user==1){
				$id = DB::table('user')->select('user.id')->where('username','=',session()->get('username'))->get()->first();
				$query = DB::table('user')->where('user.id','=',$id->id)->update([
					'user.username'=>$r->username,
					'user.password'=>Hash::make($r->password),
					'user.remember_token'=>$r->_token
					]);
				if($query==1){
					session()->forget('username');
					\Session::flash('user_success1','Thay đổi tài khoản thành công.');
					\Session::flash('user_success2','Vui lòng đăng nhập lại!');
					return redirect()->route('getlogin');
				}
			}
			else if ($user==0){
				\Session::flash('mess_user','Tài khoản không tồn tại!!!');
			}
			else if($user > 1){
				\Session::flash('mess_user','Tài khoản đã tồn tại!!!');
			}
		}
		else{
			\Session::flash('mess_re','Mật khẩu nhập lại không khớp!!!');
		}
	}
	public function account(){
		$user=UserInfo::where('user_id',session('customer_id'))->first();
		$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
		$name = RetailSystem::groupBy('nameretail')->pluck('nameretail');
		return view('business.user.register',compact('user','city','name'));
	}
	public function accountcreate(Request $request){
		if(isset($request->ctv)){
			$user = new User;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->groupuser_id = 4;
			$user->organization_id = 1;
			$user->password = Hash::make($request->password);
			$user->status = 0;
			$user->syslock = 0;
			$userinfo = new Userinfo;
			$userinfo->phone1 = $request->phone;
			$userinfo->address1 = $request->address1;
			$userinfo->fullname = $request->fullname;
			$userinfo->assess_id = 10;
			$user->save();
			$user->userinfo()->save($userinfo);
			return redirect()->route('getlogin');
		}
		else if(isset($request->dt)){
			$market = '%'.$request->select_market.'%';
			$dis = '%'.$request->select_dis.'%';
			$city = '%'.$request->select_city.'%';
			$store = '%'.$request->select_store.'%';
			$retailsystem_id = DB::table('retailsystem')->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->where('nameretail','like',$market)->where('name_center','like',$store)->pluck('id');
			$user = new User;
			$user->username = $request->usernamedt;
			$user->email = $request->emaildt;
			$user->groupuser_id = 6;
			$user->organization_id = 1;
			$user->password = Hash::make($request->passworddt);
			$user->status = 0;
			$user->syslock = 0;
			$id = $this->checkuserretailsystem();
			$user->save();
			$user->retailsystem()->attach($retailsystem_id,['phone'=>$request->phonedt,'address'=>$request->addressdt]);
			return redirect()->route('getlogin');
		}
		else
			return redirect()->route('accountcreate');
	}
	public function checkuserretailsystem(){
		$retailsystem = User_Retailsystem::all();
		if($retailsystem->count()==0){
			return $retailsystem->count();
		}
		else{
			return $retailsystem->last()->id;
		}
	}

	public function accountregister(){
		$user3 = DB::table('user')->join('userinfo','userinfo.user_id','=','user.id')->where('groupuser_id','=','3')->select('user.id','username','email','phone1','status','user.created_at','userinfo.address1')->where('status','=',0)->get();
		$user6 = DB::table('user')->join('user_retailsystem','user_retailsystem.user_id','=','user.id')->where('groupuser_id','=','6')->select('user.id','username','email','phone','status','user.created_at','address')->where('status','=',0)->get();
		return view('business.user.accountnew',compact('user6','user3'));
	}
	public function checkStatus(Request $r){
		if(!empty($r->user_6)){
			$user = DB::table('user')->join('user_retailsystem','user_retailsystem.user_id','=','user.id')->where('user_id','=',$r->user_6)->get();
			return response()->json($user);
		}
		if(!empty($r->user_3)){
			$user = DB::table('user')->join('userinfo','userinfo.user_id','=','user.id')->where('groupuser_id','=','3')->select('user.id','username','email','phone1','status','user.created_at')->where('user.id','=',$r->user_3)->get();
			return response()->json($user);
		}
	}
	public function ajaxPostStatus(Request $r){
		if($r->user_6){
			$user = DB::table('user')->where('user.id','=',$r->user_6)->update(['status'=>$r->process_id]);
			return response()->json($user);
		}
		if($r->user_3){
			$user = DB::table('user')->where('user.id','=',$r->user_3)->update(['status'=>$r->process_id]);
			return response()->json($user);
		}
	}

	public function indexaccountant()
	{
		$user = User::where([['organization_id','=','1'],['groupuser_id','=','8']])->get();
		return view('business.user.index',compact('user'));
	}

	public function getcountant()
	{
		$store = RetailSystem::groupBy('nameretail')->pluck('nameretail');
		return view('business.user.Accountant.create',compact('store'));
	}

	public function postcountant(Request $request)
	{
		// dd($request);
		$liststore = $this->checkstore($request->store);
		$user = new User;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->status = $request->status;
		$user->groupuser_id = 8;
		$user->organization_id = 1;
		$user->syslock = 0;
		$user->save();
		foreach ($liststore as $key => $value) {
			$user->retailsystem()->attach($value);
		}
		return redirect()->route('indexaccountant');
	}
	
	public function checkstore($namestore)
	{
		return DB::table('retailsystem')->where('nameretail','=',$namestore)->pluck('id');
	}

	public function updatecountant()
	{
		
	}

	public function postupdatecountant()
	{
		
	}
	public function destroyaccountant()
	{
		
	}
}
