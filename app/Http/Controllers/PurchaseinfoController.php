<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseinfoRequest;
use DB;
use App\Organization;
use App\User;
use App\Assess;
use Response;
use App\Orders;
use App\UserInfo;
use App\RetailSystem;
class PurchaseinfoController extends Controller
{ 
	public function getsearch(){
		$company = DB::table('organization')->where('ma','<>','HT')->select('name','id')->get();
		// return view('sucmua.index',compact('company'));
		return view('home_page.index',compact('company'));
	}
	public function getAjaxCompany(Request $r){
		if($r->ajax()){
			if($_POST['name']=="all"){
				$company = DB::table('organization')->where('ma','<>','HT')->select('*')->get()->toArray();
				// dd($company);
				return $company;
			}
			else{
				$json = "%".$_POST['name']."%";
				$company = DB::table('organization')->where('ma','<>','HT')->where('name','like',$json)->select('name','id')->get()->toArray();
				return $company;
			}
		}
	}
	public function getAjaxUser(Request $r){
		$id_com = $_POST['id_com'];
		$cmt = $_POST['cmt'];
		$code = $_POST['code'];
		if (!empty($id_com) &&(!empty($cmt) || !empty($code))) {
			try{
				$count = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')
				->where([
					['organization.id','=',$id_com],
					['userinfo.employee_id','=',$code],
					['orders.process_id','=',5],
					['organization.ma','<>','HT'],
					['user.syslock','=',1]
					])
				->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
				if(!empty($_POST['id_com'] && !empty($_POST['code']) && !empty($_POST['cmt']))){
					if($count==0){
						$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
						->where([
							['organization.id','=',$id_com],
							['userinfo.employee_id','=',$code],
							['organization.ma','<>','HT'],
							['user.syslock','=',1]
							])
						->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
						if($count_d==1){
							$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
							->where([
								['organization.id','=',$id_com],
								['userinfo.employee_id','=',$code],
								['organization.ma','<>','HT']])
							->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
							session()->put('customer_id', $userall[0]->id);
							return Response::json($userall);
						}
						else{
							return Response::json(['data'=>'Không tồn tại khách hàng']);
						}
					}
					if($count>0){
						$userall= DB::table('userinfo')->join('user','user.id','=','user.id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
						->where([
							['organization.id','=',$id_com],
							['orders.process_id','=',5],
							['userinfo.employee_id','=',$code],
							['user.syslock','=',1]])
						->select(DB::raw('user.id,SUM(orders.price) as price,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
						session()->put('customer_id', $userall[0]->id);
						$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
						if($cal==0 || $cal < 0){
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
						else if($cal > 0){
							session()->put('customer_id', $userall[0]->id);
							$user_megre = array_merge($userall,['nonotify'=>'nonotify']);
							return Response::json($user_megre);
						}
						else{
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
					}
				}
				if(!empty($_POST['cmt']) && !empty($_POST['id_com'])){
					if(!is_numeric($_POST['cmt'])){
						return Response::json(["cmt"=>"Chứng minh nhân dân không được chứa chữ"]);
					}
					if($count==0){
						$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
						->where([
							['organization.id','=',$id_com],
							['userinfo.identitycard','=',$cmt],
							['organization.ma','<>','HT'],
							['user.syslock','=',1]
							])
						->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
						$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
						->where([
							['organization.id','=',$id_com],
							['userinfo.identitycard','=',$cmt],
							['user.syslock','=',1]
							])
						->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
						if($count_d==1){
							session()->put('customer_id', $userall[0]->id);
							return Response::json($userall);
						}else{
							return Response::json(['data'=>'Không tồn tại khách hàng']);
						}
					}
					if($count>0){
						$userall= DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
						->where([
							['organization.id','=',$id_com],
							['orders.process_id','=',5],
							['userinfo.identitycard','=',$cmt],
							['user.syslock','=',1]
							])
						->select(DB::raw('user.id,SUM(orders.price) as price,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
						session()->put('customer_id', $userall[0]->id);
						$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
						if($cal==0 || $cal < 0){
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
						else if($cal > 0){
							session()->put('customer_id', $userall[0]->id);
							$user_megre = array_merge($userall,['nonotify'=>'nonotify']);
							return Response::json($user_megre);
						}
						else{
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
					}
				}
				if(!empty($_POST['id_com']) && !empty($_POST['code'])){
					if($count==0){
						$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
						->where([
							['organization.id','=',$id_com],
							['userinfo.employee_id','=',$code],
							['user.syslock','=',1]
							])
						->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
						if($count_d==1){
							$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
							->where([
								['userinfo.employee_id','=',$code],
								['organization.id','=',$id_com],
								['user.syslock','=',1]
								])
							->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
							session()->put('customer_id', $userall[0]->id);
							return Response::json($userall);
						}else{
							return Response::json(['data'=>'Không tồn tại khách hàng']);
						}
					}
					if($count>0){
						$userall= DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
						->where([
							['organization.id','=',$id_com],
							['orders.process_id','=',5],
							['userinfo.employee_id','=',$code],
							['user.syslock','=',1]
							])
						->select(DB::raw('user.id,SUM(orders.price) as price,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
						$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
						if($cal==0 || $cal < 0){
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
						else if($cal > 0){
							session()->put('customer_id', $userall[0]->id);
							$user_megre = array_merge($userall,['nonotify'=>'nonotify']);
							return Response::json($user_megre);
						}
						else{
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'notify'=>'notify']];
							return Response::json($usercut);
						}
					}
				}
			}
			catch(\Expression $ex){
				return Response::json(["data"=>$ex]);
			}
		}
		else if(!empty($r->id_com)){
			return Response::json(["error_com"=>' ']);
		}
		else{
			return Response::json(['error_r'=>' ']);
		}
	}
	public function postsearch(Request $request){
		if(!empty($request->btn_orders) || !empty($request->btn_orders_xs)){
			if(session()->has('customer_id')){
				$buy=Orders::where(['user_id'=>session('customer_id'),'process_id'=>5])->get()->sum('price');
				$user=UserInfo::where('user_id',session('customer_id'))->first();
				$buy=$user->salary*2.5-$buy;
				$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
				$name = RetailSystem::groupBy('nameretail')->pluck('nameretail');
				return view('business.orders.create',compact('user','city','name','buy'));
			}
			else
			{
				return redirect('/');
			}
		}
		if(!empty($request->btn_upload) || !empty($request->btn_upload_xs)){
			$user=User::where('id',session('customer_id'))->first();
			$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
			$name = RetailSystem::groupBy('nameretail')->pluck('nameretail');
			return view('business.orders.upload',compact('user','city','name'));
		}
		else
		{
			return redirect('/');
		}
	}
	public function ordershowadd(){
		$today = \Carbon::today();
		// $user=UserInfo::where('user_id',session('customer_id'))->first();	
		$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
		$name = RetailSystem::groupBy('nameretail')->pluck('nameretail');
		$company = DB::table('organization')->where('ma','<>','HT')->select('name','id')->get();
		return view('business.orders.ordershowadd',compact('city','name','company','today'));
	}

	public function aboutus()
	{
		return view('home_page.aboutus');
	}
}
