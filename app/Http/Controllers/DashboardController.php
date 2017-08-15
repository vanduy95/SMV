<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use DB;
use App\Orders;
use App\ProcessStatus;
use App\User_Retailsystem;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
	public function dashboard(){
		$order = Orders::all();
		$ProcessStatus=ProcessStatus::all();
		$user = Auth::user();
		$namegroup = str_slug($user->groupuser->name);
		switch ($namegroup) {
			case 'admin':
			return $this->dashboardadmin();
			break;
			case 'cap-nhat-thong-tin':
			return $this->capnhatthongtin();
			break;
			case 'xac-thuc-thong-tin':
			return $this->xacnhanthongtin();
			break;
			case 'duyet':
			return $this->duyet();
			break;
			case 'nhan-vien-ban-hang':
			return $this->nhanvienbanhang();
			break;
			case 'ke-toan':
			return $this->nhanvienbanhang();
			break;
			case 'test':
			return $this->test();
			break;
		}
	}
	public function dashboardadmin(){
		$datetimenow = \Carbon::now();
		$user = DB::table('user')->whereIn('groupuser_id',[3,6])->where('status',0)->get()->count();
		$countuser = User::where('groupuser_id','=','2')->count();
		$datenow = \Carbon::parse($datetimenow)->format('Y-m-d');
		$menu = Menu::where('created_at','!=',null)->get();
		$count= 0;
		foreach($menu as $m){
			$createdate=\Carbon::parse($m->created_at)->format('Y-m-d');
			if($datenow == $createdate){
				$count++;
			}
		}
		$ordernow = Orders::whereDay('created_at','=',date('d'))->whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->get()->count();
		return view('dashboard.admin.dashboard',compact('datenow','countuser','count','ordernow','user'));
	}

	public function capnhatthongtin(){
		$order = Orders::where('process_id','=','1')->orderBy('id','desc')->get();
		$ProcessStatus=ProcessStatus::all();
		return view('dashboard.capnhatthongtin.dashboard',compact('order','ProcessStatus'));
	}

	public function xacnhanthongtin(){
		$order = Orders::where('process_id','=','2')->orderBy('created_at','desc')->get();
		$ProcessStatus=ProcessStatus::all();
		return view('dashboard.xacthucthongtin.dashboard',compact('order','ProcessStatus'));
	}

	public function duyet(){
		$order = Orders::where('process_id','=','3')->orderBy('created_at','desc')->get();
		$ProcessStatus=ProcessStatus::all();
		return view('dashboard.duyet.dashboard',compact('order','ProcessStatus'));
	}

	public function nhanvienbanhang(){
		$sys_id=DB::table('user_retailsystem')->where('user_id',Auth::user()->id)->pluck('retailsystem_id');
		$order = Orders::whereIn('process_id',['4','5','6'])->whereIn('retailsystem_id',$sys_id)->orderBy('created_at','desc')->get();
		$ProcessStatus=ProcessStatus::all();
		return view('dashboard.nhanvienbanhang.dashboard',compact('order','ProcessStatus'));
	}
	public function test()
	{
		$order = Orders::all();
		$ProcessStatus=ProcessStatus::all();
		return view('dashboard.nhanvienbanhang.dashboard',compact('order','ProcessStatus'));
	}

	
}
