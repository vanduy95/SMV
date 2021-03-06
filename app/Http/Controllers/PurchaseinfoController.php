<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseinfoRequest;
use DB;
use App\Organization;
use App\User;
use App\Assess;
use Response;
// use App\Uploadfile;
use App\UploadFile;
use App\Orders;
use App\UserInfo;
use App\RetailSystem;
class PurchaseinfoController extends Controller
{ 
	public function getsearch(){
		$company = DB::table('organization')->where('ma','<>','HT')->select('name','id')->get();
		// return view('sucmua.index',compact('company'));
		// dd($company);
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
	public function postAddUserinfo(Request $r){
		$user_id =$r["_user"];
		$upMoreInfo = new UserInfo();
		$path = "uploadfile/userinfo";
		if($r->hasFile("upIden")){
			$temp="";
			$obj= $r->file("upIden");
			foreach ($obj as $item) {
				$name = $item->getClientOriginalName();
				$temp.= $name."***";
				$item->move($path,$name);
			}
			$query= DB::table('userinfo')->where('user_id','=',$user_id)->update(["identitycard_image"=>$temp]);
		}
		if($r->hasFile("_upHome")){
			$temp="";
			$obj= $r->file("_upHome");
			foreach ($obj as $item) {
				$name = $item->getClientOriginalName();
				$temp.= $name."***";
				$item->move($path,$name);	
			}
			$query= DB::table('userinfo')->where('user_id','=',$user_id)->update(["household_image"=>$temp]);
		}
		if($r->hasFile("_upBill")){
			$temp="";
			$obj= $r->file("_upBill");
			foreach ($obj as $item) {
				$name = $item->getClientOriginalName();
				$temp.= $name."***";
				$item->move($path,$name);	
			}
			$query= DB::table('userinfo')->where('user_id','=',$user_id)->update(["bill_image"=>$temp]);
		}
		if($r->hasFile("_upOther")){
			$temp="";
			$obj= $r->file("_upOther");
			foreach ($obj as $item) {
				$name = $item->getClientOriginalName();
				$temp.= $name."***";
				$item->move($path,$name);
			}
			$query= DB::table('userinfo')->where('user_id','=',$user_id)->update(["other_image"=>$temp]);
		}
		return view('business.checkuser.success');
	}
	public function getAjaxUser(Request $r){
		$cmt = $_POST['cmt'];
		if(!empty($cmt)){
			$count = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')
					->where([
						['userinfo.identitycard','=',$cmt],
						['orders.process_id','=',5],
						['organization.ma','<>','HT'],
						['user.syslock','=',1],
						['user.status','=',0]
						])
					->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
					// return $count;
				if($count==0){
					$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
						->where([
							['userinfo.identitycard','=',$cmt],
							['organization.ma','<>','HT'],
							['user.syslock','=',1],
							['user.status','=',0]
							])
						->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
						if($count_d==1){
							$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
							->where([
								['userinfo.identitycard','=',$cmt],
								['organization.ma','<>','HT']])
							->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
							session()->put('customer_id', $userall[0]->id);
							return Response::json($userall);
						}
						else{
							return Response::json(['error_null'=>'Không tồn tại khách hàng']);
						}
				}
				if($count==1){
						$userall= DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
						->where([
							['orders.process_id','=',5],
							['userinfo.identitycard','=',$cmt],
							['user.syslock','=',1],
							['user.status','=',0]])
						->select(DB::raw('user.id,SUM(orders.price) as price, SUM(orders.prepay) as prepay,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
						session()->put('customer_id', $userall[0]->id);
						$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
						// return $cal;
						if($cal==0 || $cal < 0){
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'prepay' =>$userall[0]->prepay,
							'fullname'=>$userall[0]->fullname,
							'salary'=>round_down($userall[0]->salary),
							'error_notify'=>'notify1']];
							return Response::json($usercut);
						}
						else if($cal > 0){
							session()->put('customer_id', $userall[0]->id);
							$user_megre = array_merge($userall,['error_notify'=>'nonotify']);
							return Response::json($user_megre);
						}
						else{
							$usercut = [
							['price'=>round_down($userall[0]->price),
							'fullname'=>$userall[0]->fullname,
							'prepay' =>$userall[0]->prepay,
							'salary'=>round_down($userall[0]->salary),
							'error_notify'=>'notify']];
							return Response::json($usercut);
						}
				}else if($count > 1){
					return Response::json(['error_data'=>'Lỗi truy xuất dữ liệu!']);
				}

		}else{
			return Response::json(['error_cmt'=>'khong hon le']);
		}
		// if (!empty($id_com) && ((!empty($cmt) || !empty($code)))) {
		// 	try{
		// 		if(empty($cmt)){
		// 			$count = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')
		// 			->where([
		// 				['organization.id','=',$id_com],
		// 				['userinfo.employee_id','=',$code],
		// 				['orders.process_id','=',5],
		// 				['organization.ma','<>','HT'],
		// 				['user.syslock','=',1],
		// 				['user.status','=',0]
		// 				])
		// 			->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
		// 		}
		// 		else{
		// 			$count = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')
		// 			->where([
		// 				['organization.id','=',$id_com],
		// 				['userinfo.identitycard','=',$cmt],
		// 				['orders.process_id','=',5],
		// 				['organization.ma','<>','HT'],
		// 				['user.syslock','=',1],
		// 				['user.status','=',0]
		// 				])
		// 			->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
		// 		}
		// 		if(!empty($_POST['id_com'] && !empty($_POST['code']) && !empty($_POST['cmt']))){
		// 			if($count==0){
		// 				$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['userinfo.identitycard','=',$cmt],
		// 					['organization.ma','<>','HT'],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
		// 				if($count_d==1){
		// 					$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 					->where([
		// 						['organization.id','=',$id_com],
		// 						['userinfo.identitycard','=',$cmt],
		// 						['organization.ma','<>','HT']])
		// 					->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
		// 					session()->put('customer_id', $userall[0]->id);
		// 					return Response::json($userall);
		// 				}
		// 				else{
		// 					return Response::json(['data'=>'Không tồn tại khách hàng']);
		// 				}
		// 			}
		// 			if($count>0){
		// 				$userall= DB::table('userinfo')->join('user','user.id','=','user.id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['orders.process_id','=',5],
		// 					['userinfo.identitycard','=',$cmt],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]])
		// 				->select(DB::raw('user.id,SUM(orders.price) as price, SUM(orders.prepay) as prepay,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
		// 				session()->put('customer_id', $userall[0]->id);
		// 				$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
		// 				if($cal==0 || $cal < 0){
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay' =>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 				else if($cal > 0){
		// 					session()->put('customer_id', $userall[0]->id);
		// 					$user_megre = array_merge($userall,['error_notify'=>'nonotify']);
		// 					return Response::json($user_megre);
		// 				}
		// 				else{
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay' =>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'error_notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 			}
		// 		}
		// 		if(!empty($_POST['cmt']) && !empty($_POST['id_com'])){
		// 			if(!is_numeric($_POST['cmt'])){
		// 				return Response::json(["cmt"=>"Chứng minh nhân dân không được chứa chữ"]);
		// 			}
		// 			if($count==0){
		// 				$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['userinfo.identitycard','=',$cmt],
		// 					['organization.ma','<>','HT'],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
		// 				$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['userinfo.identitycard','=',$cmt],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
		// 				if($count_d==1){
		// 					session()->put('customer_id', $userall[0]->id);
		// 					return Response::json($userall);
		// 				}else{
		// 					return Response::json(['data'=>'Không tồn tại khách hàng']);
		// 				}
		// 			}
		// 			if($count>0){
		// 				$userall= DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['orders.process_id','=',5],
		// 					['userinfo.identitycard','=',$cmt],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select(DB::raw('user.id,SUM(orders.price) as price, SUM(orders.prepay) as prepay,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
		// 				// dd($userall);
		// 				session()->put('customer_id', $userall[0]->id);
		// 				$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
		// 				if($cal==0 || $cal < 0){
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay' =>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 				else if($cal > 0){
		// 					session()->put('customer_id', $userall[0]->id);
		// 					$user_megre = array_merge($userall,['nonotify'=>'nonotify']);
		// 					return Response::json($user_megre);
		// 				}
		// 				else{
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay' =>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 			}
		// 		}
		// 		if(!empty($_POST['id_com']) && !empty($_POST['code'])){
		// 			if(!preg_match('/[^!@#$%^&&&&*()_+~`<>?\/]/',($_POST['code']))){
		// 				return Response::json(["code_t"=>"Mã nhân viên không được chứa ký tự đặc biệt"]);
		// 			}
		// 			if($count==0){
		// 				$count_d = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['userinfo.employee_id','=',$code],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->count();
		// 				if($count_d==1){
		// 					$userall = DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')
		// 					->where([
		// 						['userinfo.employee_id','=',$code],
		// 						['organization.id','=',$id_com],
		// 						['user.syslock','=',1],
		// 						['user.status','=',0]
		// 						])
		// 					->select('user.organization_id','userinfo.employee_id','user.id','userinfo.salary','userinfo.identitycard','userinfo.fullname')->get()->toArray();
		// 					session()->put('customer_id', $userall[0]->id);
		// 					return Response::json($userall);
		// 				}else{
		// 					return Response::json(['data'=>'Không tồn tại khách hàng']);
		// 				}
		// 			}
		// 			if($count>0){
		// 				$userall= DB::table('userinfo')->join('user','user.id','=','userinfo.user_id')->join('organization','organization.id','=','user.organization_id')->join('orders','orders.user_id','=','user.id')->groupBy('user.id','userinfo.fullname','userinfo.salary')
		// 				->where([
		// 					['organization.id','=',$id_com],
		// 					['orders.process_id','=',5],
		// 					['userinfo.employee_id','=',$code],
		// 					['user.syslock','=',1],
		// 					['user.status','=',0]
		// 					])
		// 				->select(DB::raw('user.id,SUM(orders.price) as price, SUM(orders.prepay) as prepay,userinfo.fullname,userinfo.salary,user.id'))->get()->toArray();
		// 				$cal = ($userall[0]->salary*2.5)-$userall[0]->price;
		// 				if($cal==0 || $cal < 0){
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay'=>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 				else if($cal > 0){
		// 					session()->put('customer_id', $userall[0]->id);
		// 					$user_megre = array_merge($userall,['nonotify'=>'nonotify']);
		// 					return Response::json($user_megre);
		// 				}
		// 				else{
		// 					$usercut = [
		// 					['price'=>round_down($userall[0]->price),
		// 					'fullname'=>$userall[0]->fullname,
		// 					'prepay'=>$userall[0]->prepay,
		// 					'salary'=>round_down($userall[0]->salary),
		// 					'notify'=>'notify']];
		// 					return Response::json($usercut);
		// 				}
		// 			}
		// 		}
		// 	}
		// 	catch(\Expression $ex){
		// 		return Response::json(["data"=>$ex]);
		// 	}
		// }
		// else if(empty($r->id_com) && empty($r->cmt) && empty($r->code)){
		// 	return Response::json(['error_all'=>' ']);
		// }
		// else if(empty($r->id_com) && empty($r->cmt)){
		// 	return Response::json(["error_cmt"=>' ']);
		// }
		// else if(empty($r->id_com) && empty($r->code)){
		// 	return Response::json(["error_code"=>' ']);
		// }
		// else if(empty($r->id_com)){
		// 	return Response::json(["error_com"=>' ']);
		// }
		// else{
		// 	return Response::json(["error_cmt_code"=>' ']);
		// }
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
		if(!empty($request->btn_update_info) || !empty($request->btn_update_info_xs)){
			return view('business.orders.update_info');
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
