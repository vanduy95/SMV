<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Mail;
use App\User;
use App\Orders;
use App\UserInfo;
use Notification;
use Carbon\Carbon;
use App\Uploadfile;
use App\Organization;
use App\RetailSystem;
use App\ProcessStatus;
use Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\OrderAddRequest;
use Cviebrock\EloquentSluggable\findBySlug;
use App\Http\Requests\OrderUploadFileRequest;
use App\Http\Requests\postOrdersRequestCreate;
use App\Notifications\CheckOrdersNotification;
use App\Notifications\CreateOrderNotification;
use Cviebrock\EloquentSluggable\findBySlugOrFail;
use App\Notifications\UserNotification;
class myObject{
	public $fullname;
	public $salary;
}
class indexObject{
	public $supmarket;
	public $user_name;
	public $product_reg;
	public $price;
	public $prepay;
	public $lead_time;
	public $processstartus;
	public $created_at;
}
function convertname($str) {
	// In thường
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);    
	// In đậm
	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	$str = preg_replace("/(Đ)/", 'D', $str);
	     return $str; // Trả về chuỗi đã chuyển
	 } 
	 class OrdersController extends Controller
	 {
	 	public function first_day_payment($update_day,$salaryday){	
	 		// eq() equals
	 		// ne() not equals
	 		// gt() greater than
	 		// gte() greater than or equals
	 		// lt() less than
	 		// lte() less than or equals
	 		$c = new \Carbon;
	 		$a = new \Carbon;
	 		$ud = new \Carbon;
	 		$d_orders = $update_day->day;
	 		$y = $update_day->year;
	 		$m = $update_day->month;
	 		$d_salary = $salaryday;
	 		$c->setDate($y,$m,$d_salary);
	 		$a->setDateTime($y,$m,$d_salary,0,0,0,0);
	 		$temp_d = $update_day->addDays(10);
	 		$boole = ($ud->setDateTime($temp_d->year,$temp_d->month,$temp_d->day,0,0,0,0))->eq($a);
	 		$boolt = ($ud->setDateTime($temp_d->year,$temp_d->month,$temp_d->day,0,0,0,0))->lt($a);
	 		// dd($boole);
	 		if($salaryday==null){
	 			if($update_day->day>11&&$update_day->day<25)
	 			{
	 				return $c->setDate($y,$m+1,5);
	 			}
	 			else
	 			{
	 				return $c->setDate($y,$m+1,25);
	 			}
	 		}
	 		if($d_orders > $d_salary){
	 			if($a->addMonths(1)->subDays(10)->gte($update_day->setDateTime($y,$m,$d_orders,0,0,0,0))==true){
	 				return $c->setDate($y,$m+1,$d_salary);
	 			}
	 			else{
	 				return $c->setDate($y,$m+2,$d_salary);
	 			}
	 		}
	 		else{
	 			if($boole==true && $boolt==true){
	 				return $c->setDate($y,$m,$d_salary);
	 			}
	 			else{
	 				return $c->setDate($y,$m+1,$d_salary);
	 			}
	 		}
	 			// if($d_salary > $update_day->day && (abs($d_salary-$update_day->day)>10)){
	 			// 	return $c->setDate($y,$m,$d_salary);
	 			// }
	 			// else if($d_salary < $update_day->day && (abs(($d_salary-$update_day->day))<=10)){
	 			// 	return $c->setDate($y,$m+1,$d_salary);
	 			// }
	 			// else if($d_salary < $update_day->day && (abs(($d_salary-$update_day->day))>10)){
	 			// 	return $c->setDate($y,$m,$d_salary);
	 			// }
	 			// else if($d_salary > $update_day->day && (abs($d_salary-$update_day->day)<=10)){
	 			// 	return $c->setDate($y,$m+1,$d_salary);
	 			// }
	 			// else{
	 			// 	return $c->setDate($y,$m+1,$d_salary);
	 			// }
	 	}
	 	public function createOrders(postOrdersRequestCreate $r){
	 		try{
	 			$user = User::find($r->user_id);
	 			$today = \Carbon::now();
	 			$search = [' đồng','.'];
	 			$buy = UserInfo::where('user_id',$r->user_id)->first()->salary*2.5; 
	 			$price =  str_replace($search,"",$r['price']);
	 			$city = "%".$r['select_city']."%";
	 			$dis= "%".$r['select_dis']."%";
	 			$market = "%".$r['market']."%";
	 			$store = "%".$r['select_store']."%";	
	 			if($r->pre_pay == null){
	 				$prepay = $price*str_replace($search,"",$r['pre_pay']);
	 			}
	 			else{
	 				$prepay = str_replace($search,"",$r['pre_pay']);
	 			}
	 			$id="";
	 			$r_id = DB::table('retailsystem')->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->where('nameretail','like',$market)->where('name_center','like',$store)->get();
	 			$order=new Orders;
	 			$order->name=$r['name'];
	 			$order->buy_now=$buy;
	 			$order->product_reg=$r['product'];
	 			$order->product_code=$r['code_product'];
	 			$order->color=$r['color'];
	 			$order->price=$price;
	 			$order->prepay=$prepay;
	 			$order->select_rate=$r['select_rate'];
	 			$order->lead_time=$r['lead_month'];
	 			$order->supmarket=$r['market'];
	 			$order->city=$r['select_city'];
	 			$order->district=$r['select_dis'];
	 			$order->store =$r['select_store'];
	 			$order->salesman=$r['sales_man'];
	 			$order->phonesale=$r['phone_sale'];
	 			$order->user_id=$user->id;
	 			$order->process_id='1';
	 			$order->retailsystem_id=$r_id[0]->id;
	 			$order->created_at=$today;
	 			$order->save();
	 			$users=User::whereIn('groupuser_id',[1,3])->get();
	 			Notification::send($users, new CreateOrderNotification($r->name,$order));
	 			session()->forget('customer_id');
	 			$this->sendMail($r,$user->id,$r_id[0]->phonecontact);
	 			\Session::flash('mess_order','Insert New Record Success');
	 			return redirect()->route('success');
	 		}
	 		catch(\Expression $ex){
	 			echo $ex->getMessage()."</br>";
	 			echo "Đã xảy ra lỗi click để tạo mới lại =>> <a href='/orders/create' class='col-lg-12'>Return Create Orders</a>";
	 		}
	 	}
	 	public function getAjax(Request $r){
	 		if($r->ajax()){				
	 			if(!empty($_POST['market']) && !empty($_POST['dis']) && !empty($_POST['city'])) {
	 				$dis = "%".$_POST['dis']."%";
	 				$city= "%".$_POST['city']."%";
	 				$market = "%".$_POST['market']."%";
	 				$store = RetailSystem::where('retailcity','like',$city)->where('retaildistrict','like',$dis)->where('nameretail','like',$market)->pluck('name_center');
	 				return  $store;
	 			}
	 			if(!empty($_POST['dis']) && !empty($_POST['city'])){
	 				$dis = "%".$_POST['dis']."%";
	 				$city= "%".$_POST['city']."%";
	 				$market = RetailSystem::groupBy('nameretail')->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->pluck('nameretail');	
	 				return $market;	
					// return "market";
	 			}
	 			if(!empty($_POST['city'])){
	 				$city= "%".$_POST['city']."%";
	 				$market = !empty($_POST['market'])?("%".$_POST['market']."%"):"%%";
	 				$dis = RetailSystem::groupBy('retaildistrict')->where('retailcity','like',$city)->where('nameretail','like',$market)->pluck('retaildistrict');
	 				return $dis;
			// return $market;
	 			}
	 			if(!empty($_POST['market']) && empty($_POST['city']) && empty($_POST['dis'])){
	 				$market= "%".$_POST['market']."%";
	 				$city = RetailSystem::groupBy('retailcity')->where('nameretail','like',$market)->pluck('retailcity');
	 				return $city;
	 			}
	 		}
	 	}
	 	public function getupload($id){
	//edit thanh posst
	 		$user = User::find($id);
	 		return view('business.orders.upload',compact('user'));
	 	}
	 	public function postupload(OrderUploadFileRequest $request,$id){
	 		try{
	 			$today = \Carbon::now();
	 			$upload = new Uploadfile();
	 			if($request->hasFile('filename')){
	 				$path = 'uploadfile/orders/';
	 				$file = $request->file('filename');
	 				$name = str_slug($file->getClientOriginalName());
	 				do{
	 					$filename = str_random(4)."_".$name;
	 				}while(file_exists("uploadfile/orders".$filename));
	 				$file->move($path,$filename);
	 				$upload->path = $filename;
	 				$upload->type = 1;      
	 			}
	 			else {
	 				$upload->path="";
	 			}
	 			if(!empty($request->lb_market) && !empty($request->lb_dis) && !empty($request->lb_city) && !empty($request->lb_store)) {
	 				$market = '%'.$request->lb_market.'%';
	 				$dis = '%'.$request->lb_dis.'%';
	 				$city = '%'.$request->lb_city.'%';
	 				$store = '%'.$request->lb_store.'%';
	 				$r_id = DB::table('retailsystem')->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->where('nameretail','like',$market)->where('name_center','like',$store)->get()->toArray();
	 				$name = DB::table('userinfo')->where('user_id','=',$id)->get();
	 				$orders=new Orders;
	 				$orders->name=$name[0]->fullname;
	 				$orders->supmarket=str_replace('%','',$market);
	 				$orders->city=str_replace('%','',$city);
	 				$orders->district=str_replace('%','',$dis);
	 				$orders->store=str_replace('%','',$store);
	 				$orders->user_id=$id;
	 				$orders->process_id=1;
	 				$orders->retailsystem_id=$r_id[0]->id;
	 				$orders->created_at=$today;
	 				$orders->save();
	 				$upload->orders_id = $orders->id;
	 				$upload->save();
	 				$users=User::whereIn('groupuser_id',[1,3])->get();
	 				Notification::send($users, new CreateOrderNotification(User::find($id)->UserInfo->fullname,$orders));
 				//$this->sendMail();
	 				return redirect()->route('success');
	 			}
	 		}
	 		catch(\Expression $ex){
	 			echo $ex->getMessage()."</br>";
	 			echo "Đã xảy ra lỗi click để tạo mới lại =>> <a href='/' class='col-lg-12'>Quay lại trang chủ</a>";
	 		}
	 	}
	 	public function indexUploadFile(){
	 		$data = DB::table('uploadfile')->join('user','user.id','=','uploadfile.user_id')->join('userinfo','userinfo.user_id','=','user.id')->select(DB::raw('uploadfile.*'),'userinfo.fullname')->get()->toArray();
	 		return view('business.uploadfile.index',compact('data'));
	 	}
	 	public function indexadmin(){
	 		$order = Orders::orderBy('created_at','desc')->get();
	 		$ProcessStatus=ProcessStatus::all();
	 		return view('business.orders.index',compact('order','ProcessStatus'));
	 	}
	 	public function getnameprocess($processstartus,$process_id){
	 		foreach ($processstartus as $key => $value) {
	 			if($value->id == $process_id){
	 				$name=$value->name;
	 			}
	 		}
	 		return $name;
	 	}
	 	public function getnameuser($user,$user_id){
	 		foreach ($user as $key => $value) {
	 			if($value->user_id == $user_id){
	 				$fullname=$value->fullname;
	 			}
	 		}
	 		return $fullname;
	 	}

	 	public function ajaxGetUserOders(Request $req)
	 	{
	 		$UserInfo=UserInfo::where('user_id',$req->user_id)->first()->toArray();
	 		$email=User::find($req->user_id)->email;
	 		$UserInfo=array_merge($UserInfo,array('email'=>$email));
	 		return response()->json($UserInfo);

	 	}

 	// public function ajaxEditOrder(Request $req)
 	// {
 	// 	$Orders=Orders::find($req->order_id);
 	// 	if($req->process_id==$Orders->process_id){
 	// 		return 'false';
 	// 	}
 	// 	$Orders->process_id=$req->process_id;
 	// 	$Orders->save();
 	// 	switch ($req->process_id) {
 	// 		case '1':
 	// 		$users=User::whereIn('groupuser_id',[3])->get();
 	// 		Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã yêu cầu cập nhập lại đơn hàng của '.$Orders->name));
 	// 		break;
 	// 		case '2':
 	// 		$users=User::whereIn('groupuser_id',[4])->get();
 	// 		Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã cập nhập đơn hàng của '.$Orders->name.' vui lòng xác nhận thông tin'));
 	// 		break;
 	// 		case '3':
 	// 		$users=User::whereIn('groupuser_id',[5])->get();
 	// 		Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã xác thực đơn hàng của '.$Orders->name.' vui lòng duyệt thông tin'));
 	// 		break;
 	// 		case '4':
 	// 		$users=User::whereIn('groupuser_id',[6])->get();
 	// 		Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã duyệt đơn hàng của '.$Orders->name.'. vui lòng giao hàng'));
 	// 		break;
 	// 		case '5':
 	// 		$users=User::whereIn('groupuser_id',[1])->get();
 	// 		Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã giao hàng cho '.$Orders->name));
 	// 		break;
 	// 		default:

 	// 		break;
 	// 	}
 	// 	return response()->json($Orders);
 	// }

	 	public function ajaxGetUserInfor(Request $req)
	 	{
	 		$UserInfo=UserInfo::where('user_id',$req->user_id)->first()->toArray();
	 		$email=User::find($req->user_id)->email;

	 		$UserInfo=array_merge($UserInfo,array('email'=>$email));

	 		return view('business.orders.ajax.inforuser',compact('UserInfo'));
	 	}

	 	public function ajaxDeleteOrder(Request $req)
	 	{
	 		$Orders=Orders::find($req->order_id);
	 		$Orders->delete();
	 		return 'true';
	 	}

	 	public function sendMail($req,$userid,$store_phone)
	 	{
		//dd($userid);
	 		$User=User::find($userid);
	 		$Organization=Organization::find($User->organization_id);
	 		$UserInfo=UserInfo::where('user_id',$userid)->first();
	 		$data=$req->toArray();
	 		$data['email']=$User->email;
	 		$data['phone_user']=$UserInfo->phone1;
	 		$data['store_phone']=$store_phone;
	 		$data['organization_name']=$Organization->name;
	 		Mail::send('email.sendinfor',$data, function ($message) use ($data){
	 			$message->from('vanduy.glview@gmail.com', 'Sức mua việt');

	 			$message->to('vanduybn95@gmail.com',$data['name']);

	 			$message->replyTo('vanduy.glview@gmail.com', 'Sức mua việt');

	 			$message->subject('Thông tin orders');
	 		});


	 	}

	 	public function ajaxGetOrderInfor(Request $req)
	 	{
	 		$orders=Orders::find($req->order_id);
	 		$buy=Orders::where(['user_id'=>$orders->user_id,'process_id'=>5])->get()->sum('price');
	 		$buy=$orders->buy_now-$buy;
	 		$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
	 		return view('business.orders.ajax.orderinfor',compact('orders','city','buy'));
	 	}
	 	public function printOrders(Orders $order)
	 	{
	 		if($order->process_id==4||$order->process_id==5)
	 		{
	 			$fileName = "orders/order.docx";
	 			$doc = new \PhpOffice\PhpWord\TemplateProcessor($fileName);
	 			$doc->setValue('name',$order->user->userinfo->fullname);
	 			$doc->setValue('order_id',orderId($order->retailsystem_id,$order->id));
	 			$doc->setValue('created_at',\Carbon::parse($order->created_at)->format('d/m/Y'));
	 			$doc->setValue('updated_at',\Carbon::parse($order->updated_at)->format('d/m/Y'));
	 			$doc->setValue('organization_id',$order->user->organization->ma);
	 			$doc->setValue('organization_add',$order->user->organization->address);
	 			$doc->setValue('birthday',\Carbon::parse($order->user->userinfo->birthday)->format('d/m/Y'));
	 			$doc->setValue('store',$order->store);
	 			$doc->setValue('address',$order->user->organization->address);
	 			// dd($order);
	 			if($order->user->userinfo->sex==1)
	 			{
	 				$doc->setValue('sex','Nam');
	 				$doc->setValue('men','x');
	 				$doc->setValue('women','');
	 			}

	 			else if($order->user->userinfo->sex==2)
	 			{
	 				$doc->setValue('men','');
	 				$doc->setValue('women','x');
	 				$doc->setValue('sex','Nữ');
	 			}
	 			else 
	 			{
	 				$doc->setValue('sex','');
	 				$doc->setValue('men','');
	 				$doc->setValue('women','');
	 			}

	 			$doc->setValue('identitycard',$order->user->userinfo->identitycard);
	 			$doc->setValue('dateissue',\Carbon::parse($order->user->userinfo->dateissue)->format('d/m/Y'));

	 			if($order->user->userinfo->maritalstatus==1)
	 			{
	 				$doc->setValue('maritalstatus','Đã kết hôn');
	 				$doc->setValue('ismarital','x');
	 				$doc->setValue('single','');
	 			}
	 			else if($order->user->userinfo->maritalstatus==2)
	 			{
	 				$doc->setValue('maritalstatus','Độc thân');
	 				$doc->setValue('ismarital','');
	 				$doc->setValue('single','x');
	 			}
	 			else
	 			{
	 				$doc->setValue('maritalstatus','');
	 				$doc->setValue('ismarital','');
	 				$doc->setValue('single','');
	 			}
	 			$doc->setValue('issuedby',$order->user->userinfo->issuedby);
	 			$doc->setValue('issuedby',$order->user->userinfo->issuedby);
	 			$doc->setValue('address1',$order->user->userinfo->address1);
	 			$doc->setValue('phone1',$order->user->userinfo->phone1);
	 			$doc->setValue('address2',$order->user->userinfo->address2);
	 			$doc->setValue('phone4',$order->user->userinfo->phone4);
	 			$doc->setValue('phone2',$order->user->userinfo->phone2);
	 			$doc->setValue('email',$order->user->email);
	 			$doc->setValue('phone3',$order->user->userinfo->phone3);
	 			$doc->setValue('organization',$order->user->organization->name);
	 			$doc->setValue('salary',number_format($order->user->userinfo->salary));
	 			$doc->setValue('employee_id',$order->user->userinfo->employee_id);
	 			$doc->setValue('bank',$order->user->userinfo->bank_name);
	 			$doc->setValue('product',$order->product_reg);
	 			$doc->setValue('code_product',$order->product_code);
	 			$doc->setValue('color',$order->color);
	 			$doc->setValue('position',$order->user->userinfo->position);
	 			$doc->setValue('number_account',$order->user->userinfo->number_account);
	 			$doc->setValue('time_worked',$order->user->userinfo->time_worked);
	 			$doc->setValue('department',$order->user->userinfo->department);
	 			$doc->setValue('pay_per_month',(number_format(($order->retailSystem->interest_rate*((double)$order->price-(double)$order->prepay)+((double)$order->price-(double)$order->prepay)/$order->lead_time)+11000)));
	 			$doc->setValue('pay_month',$order->user->userinfo->salary_day);
	 			$days = $this->first_day_payment($order->updated_at,$order->user->userinfo->salary_day);
	 			$doc->setValue('start',date('d-m-Y',strtotime($days)));
	 			$doc->setValue('finish',date('d-m-Y',strtotime($days->addMonths($order->lead_time-1))));

	 			if ($order->prepay) {
	 				$doc->setValue('pre_pay',number_format($order->prepay));
	 			}
	 			else
	 			{
	 				$doc->setValue('pre_pay',number_format($order->price*$order->select_rate/100));
	 			}

	 			$doc->setValue('time',$order->lead_time);
	 			$doc->setValue('slow',number_format($order->price-$order->prepay));
	 			$doc->setValue('price',number_format($order->price));
	 			$name=time().'.docx';
	 			$doc->saveAs($name);
	 			header('Content-Description: File Transfer');
	 			header('Content-Type: application/octet-stream');
	 			header('Content-Disposition: attachment; filename=Hợp đồng_'.$order->name.'.docx');
	 			header('Content-Transfer-Encoding: binary');
	 			header('Expires: 0');
	 			header('Content-Length: ' . filesize($name));
	 			readfile($name);
	 			unlink($name);
	 		}
	 		return redirect('admin');


	 	}


	 	public function printAutoPay(Orders $order)
	 	{
	 		if($order->process_id==4||$order->process_id==5)
	 		{
	 			$fileName = "orders/order2.docx";
	 			$doc = new \PhpOffice\PhpWord\TemplateProcessor($fileName);
	 			$doc->setValue('organization',$order->user->organization->name);
	 			$doc->setValue('name',$order->name);
	 			$doc->setValue('identitycard',$order->user->userinfo->identitycard);
	 			$doc->setValue('dateissues',\Carbon::parse($order->user->userinfo->dateissue)->format('d/m/Y'));
	 			$doc->setValue('issuedby',$order->user->userinfo->issuedby);
	 			$doc->setValue('phone',$order->user->userinfo->phone1);
	 			$doc->setValue('bank_number',$order->user->userinfo->number_account);
	 			$doc->setValue('day',Carbon::now()->day);
	 			$doc->setValue('month',Carbon::now()->month);
	 			$doc->setValue('year',Carbon::now()->year);
	 			$doc->setValue('day_pay',\Carbon::parse($order->created_at)->format('d/m/Y'));
	 			$doc->setValue('time',$order->lead_time);
	 			$name2=time().'2.docx';
	 			$doc->saveAs($name2);
	 			header('Content-Description: File Transfer');
	 			header('Content-Type: application/octet-stream');
	 			header('Content-Disposition: attachment; filename=YÊU CẦU THANH TOÁN TỰ ĐỘNG_'.$order->name.'.docx');
	 			header('Content-Transfer-Encoding: binary');
	 			header('Expires: 0');
	 			header('Content-Length: ' . filesize($name2));

	 			readfile($name2);
	 			unlink($name2);
	 		}

	 	}

	 	public function exportOrders(Request $req)
	 	{
	 		// dd($req);
	 		if(!empty($req->date1) && !empty($req->date2)){
	 			$today=Carbon::today()->format('d-m-Y');
	 			$sys_id=DB::table('user_retailsystem')->where('user_id',Auth::user()->id)->pluck('retailsystem_id');
 		// $order=DB::table('orders')->select(DB::raw('name as Tên,buy_now as "Sức mua hiện tại",product_reg as "Sản phẩm đăng kí",product_code as "Mã sản phẩm",color as "Màu sắc",price as "Giá bán",prepay as "Trả trước",select_rate as "Tỉ lệ",lead_time as "Thời hạn",supmarket as "Siêu thị",city as "Thành phố",district as "Quận Huyện", store as "Cửa hàng",salesman as "Người bán hàng",phonesale as "Số điện thoại bán hàng",created_at as "Ngày Tạo"'))->get();
	 			$order = Orders::select('name','buy_now','product_reg','product_code','color','price','prepay','select_rate','lead_time','supmarket','city','district','store','salesman','phonesale','created_at')->whereIn('retailsystem_id',$sys_id)->whereBetween('created_at', array($req->date1, $req->date2))->get();
	 			Excel::create('Danh sách đơn hàng '.$today,function($excel) use ($order)
	 			{
	 				$excel->sheet('sheet 1',function ($sheet) use ($order)
	 				{
	 					$sheet->fromArray($order,null,'A1',false,false);
	 					$headings = array('Tên', 'Sức mua hiện tại', 'Sản phẩm đăng kí', 'Mã sản phẩm','Màu sắc','Giá bán','Trả trước','Tỉ lệ','Thời hạn','Siêu thị','Thành phố','Quận Huyện','Cửa hàng','Người bán hàng','Số điện thoại người bán','Ngày tạo');
	 					$sheet->prependRow(1, $headings);
	 				});
	 			})->download('xlsx');
	 		}
	 		else{

	 		}
	 	}

	 	public function ajaxPostEditOrderUser(Request $req)
	 	{
	 		$UserInfo=UserInfo::where('user_id',$req->user_id)->first();
	 		$UserInfo->employee_id=$req->employee_id;
	 		$UserInfo->fullname=$req->name;
	 		$UserInfo->birthday=$req->birthday;
	 		$UserInfo->sex=$req->sex;
	 		$UserInfo->phone1=$req->phone;
	 		$UserInfo->address1=$req->address1;
	 		$UserInfo->identitycard=$req->identitycard;
	 		$UserInfo->save();
	 		$user=User::find($req->user_id);
	 		$user->email=$req->email;
	 		$user->save();
	 		$Orders=Orders::where('user_id',$req->user_id)->get();
	 		$order=array();
	 		foreach ($Orders as $key => $value) {
	 			$order[]=$value;
	 			$value->name=$req->name;
	 			$value->save();
	 		}

	 		return response()->json($order);
	 	}
 	// controller show add (order)
 	// public function orderadd(OrderAddRequest $request){
 	// 	$User = new User();
 	// 	$UserInfo = new UserInfo();
 	// 	$User->groupuser_id= 2;
 	// 	$User->username = str_replace(' ','',convertname($request->fullname));
 	// 	$User->password = Hash::make(str_random(6));
 	// 	$User->status = 1;
 	// 	$User->syslock=1;
 	// 	$User->organization_id = $request->company;
 	// 	$User->created_at = \Carbon::today();
 	// 	$UserInfo->employee_id = rand(100000,999999);
 	// 	$UserInfo->fullname = $request->fullname;
 	// 	$UserInfo->address1 = $request->address;
 	// 	$UserInfo->dateissue = $request->dateissue;
 	// 	$UserInfo->salary = str_replace(['.',' đồng'],"",$request->salary);
 	// 	$UserInfo->issuedby = $request->issuedby;//noi cap
 	// 	$UserInfo->identitycard = $request->identitycard;
 	// 	$UserInfo->phone1 = $request->phone;
 	// 	$UserInfo->assess_id = 1;
 	// 	$UserInfo->created_at=\Carbon::now();
 	// 	// return $UserInfo;
 	// 	$User->save();
 	// 	$User->UserInfo()->save($UserInfo);
 	// 	$r_id = DB::table('retailsystem')->where('retailcity','like','%'.$request->select_city.'%')->where('retaildistrict','like','%'.$request->select_dis.'%')->where('nameretail','like','%'.$request->market.'%')->where('name_center','like','%'.$request->select_store.'%')->get();
 	// 	$query = DB::table('orders')->insert([
 	// 		'name'=>$request->fullname,
 	// 		'buy_now'=>str_replace(['.',' đồng'],"",$request->salary),
 	// 		'product_reg'=>$request->product,
 	// 		'product_code'=>$request->code_product,
 	// 		'color'=>$request->color,
 	// 		'price'=>str_replace(['.',' đồng'],"",$request->price),
 	// 		'prepay'=>str_replace(['.',' đồng'],"",$request->pre_pay),
 	// 		'lead_time'=>$request->lead_month,
 	// 		'city'=>$request->select_city,
 	// 		'district'=>$request->select_dis,
 	// 		'supmarket'=>$request->market,
 	// 		'store'=>$request->select_store,
 	// 		'user_id'=>$User->id,
 	// 		'process_id'=>1,
 	// 		'retailsystem_id'=>$r_id[0]->id,
 	// 		'created_at'=>\Carbon::today()
 	// 		]);
 	// 	if($query==true){
 	// 		return redirect()->route('success');
 	// 	}
 	// }

	 	public function orderInfo($id)
	 	{

	 		$orders=!empty(Orders::find($id))?Orders::find($id):"0";
	 		$UserInfo = $orders->user->userinfo;
	 		$warning_order = ((round_down($UserInfo->salary*2.5)) - ($orders->price-$orders->prepay));
	 		if($orders!="0"){
	 			if(((\Carbon::now()->subMonths(2))->lt($UserInfo->updated_at))==true){
	 				$comparison  = "0";
	 			}
	 			else{
	 				$comparison  = "Cảnh báo đơn hàng này đã quá 2 tháng";
	 			}
	 			if(((\Carbon::now()->subMonths(2))->lt($UserInfo->updated_at))==true){
	 				$comparison  = "";
	 			}
	 			else{
	 				$comparison  = "Cảnh báo đơn hàng này đã quá 2 tháng";
	 			}

 			$buys = Orders::where(['user_id'=>$orders->user_id,'process_id'=>5])->get()->sum('price')-Orders::where(['user_id'=>$orders->user_id,'process_id'=>5])->get()->sum('prepay');//sức mua đã sử dụng
 			$total_buy=round_down($orders->User->UserInfo->salary*2.5);
 			$buy=$total_buy-$buys;// sức mua hiện tại
 			$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
 			$retailsystem = RetailSystem::groupBy('nameretail')->pluck('nameretail');
 			$organization=Organization::all();
 			// dd($retailsystem);
 		}
 		else{
 			return redirect('admin');
 		}
 	// dd($UserInfo->salary_avg);
 		switch (Auth::user()->groupuser_id) {
 			case 1:
 			if($orders->process_id==1){
 				return view('business.orders.update.order_info',compact('UserInfo','orders','city','buy','buys','retailsystem','organization','total_buy','warning_order'));
 			}
 			if($orders->process_id==2){
 				return view('business.orders.accuracy.index',compact('UserInfo','orders','city','buy','buys','retailsystem','comparison','total_buy','warning_order'));
 			}
 			if($orders->process_id==3){
 				$days = $this->first_day_payment($orders->updated_at,$UserInfo->salary_day);
 				if($days!=null)
 					$day=$days;
 				else
 					$day=\Carbon::setDate(0,0,0);
 				return view('business.orders.approval.index',compact('UserInfo','orders','city','buy','buys','retailsystem','day','total_buy','warning_order'));
 			}
 			if($orders->process_id==4 || $orders->process_id==6|| $orders->process_id==5){
 				return view('business.orders.sale.index',compact('UserInfo','orders','city','buy','buys','retailsystem','total_buy','warning_order'));
 			}
 			break;
 			case 3:
 			if($orders->process_id==1){
 				return view('business.orders.update.order_info',compact('UserInfo','orders','city','buy','buys','retailsystem','organization','total_buy','warning_order'));
 			}
 			else{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 			case 4:
 			if($orders->process_id==2){
 				return view('business.orders.accuracy.index',compact('UserInfo','orders','city','buy','buys','retailsystem','comparison','total_buy','warning_order'));
 			}
 			else{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 			case 5:
 			if($orders->process_id==3){
 				$days = $this->first_day_payment($orders->updated_at,$UserInfo->salary_day);
 				if($days!=null)
 					$day=$days;
 				return view('business.orders.approval.index',compact('UserInfo','orders','city','buy','buys','retailsystem','day','total_buy','warning_order'));
 			}
 			else{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 			case 6:
 			$sys_id=DB::table('user_retailsystem')->where('user_id',Auth::user()->id)->pluck('retailsystem_id');
 			if($sys_id->contains($orders->retailsystem_id)&&($orders->process_id==4 || $orders->process_id==6|| $orders->process_id==5)){
 				return view('business.orders.sale.index',compact('UserInfo','orders','city','buy','buys','retailsystem','total_buy'));
 			}
 			else
 			{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 			case 7:
 			if($orders->process_id==4 || $orders->process_id==6|| $orders->process_id==5){
 				return view('business.orders.sale.index',compact('UserInfo','orders','city','buy','buys','retailsystem','total_buy'));
 			}
 			else
 			{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 			case 8:
 			$sys_id=DB::table('user_retailsystem')->where('user_id',Auth::user()->id)->pluck('retailsystem_id');
 			if($sys_id->contains($orders->retailsystem_id)&&($orders->process_id==4 || $orders->process_id==6|| $orders->process_id==5)){
 				return view('business.orders.sale.index',compact('UserInfo','orders','city','buy','buys','retailsystem','total_buy'));
 			}
 			else
 			{
 				\Session::flash('success_accruracy','Đơn hàng đã được xử lý hoặc đã chuyển trạng thái');
 				return redirect('admin');
 			}
 			break;
 		}

 	}
 	public function ajaxPostRetailOrders(Request $r){
 		$market= "%".$r->market."%";
 		$city = "%".$r->city."%";
 		$dis = "%".$r->dis."%";
 		if(!empty($r->market) && !empty($r->city) && !empty($r->dis)){
 			$data = DB::table('retailsystem')->groupBy('name_center')->where('nameretail','like',$market)->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->pluck('name_center');
 			return response()->json($data);
 		}
 		else if(!empty($r->market) && !empty($r->city)){
 			$data = DB::table('retailsystem')->groupBy('retaildistrict')->where('nameretail','like',$market)->where(
 				'retailcity','like',$city
 				)->pluck('retaildistrict');
 			return response()->json($data);
 		}
 		else if(!empty($r->market)){
 			$data = RetailSystem::groupBy('retailcity')->where('nameretail','like',$market)->pluck('retailcity');
 			return response()->json($data);
 		}
 	}

 	public function postAccuracyOrder(Request $r){
 		$orders = Orders::find($r->orders_id);
 		if(!empty($r->btn_accuracy)){
 			if($orders->user->status!=0)
 			{
 				$u=User::find($orders->user->id);
 				$u->status=0;
 				$u->save();
 			}
 			if(preg_replace("/[ đồng.]/","",$r->salary_avg)!=''){
 				$query = DB::table('userinfo')->where('user_id','=',$r->user_id)->update([
 					'number_account'=>$r->number_account,
 					'exchange_status'=>$r->exchange_status,
 					'salary_avg'=>preg_replace("/[ đồng.]/","",$r->salary_avg),
 					'salary'=>preg_replace("/[ đồng.]/","",$r->salary_avg),
 					'phone4'=>$r->phone4,
 					'bank_name'=>$r->bank_name,
 					'salary_day'=>$r->salary_day,
 					'time_worked'=>$r->time_work,
 					]);
 			}
 			else
 			{
 				$query = DB::table('userinfo')->where('user_id','=',$r->user_id)->update([
 					'number_account'=>$r->number_account,
 					'exchange_status'=>$r->exchange_status,
 					'salary_avg'=>preg_replace("/[ đồng.]/","",$r->salary_avg),
 					'phone4'=>$r->phone4,
 					'bank_name'=>$r->bank_name,
 					'salary_day'=>$r->salary_day,
 					'time_worked'=>$r->time_work,
 					]);
 			}
 			// return $query;
 			if($query<=1){
 				$data = DB::table('orders')->where('id','=',$r->orders_id)->update([
 					'process_id'=>'3',
 					'note'=>''
 					]);
 				$users=User::whereIn('groupuser_id',[5])->get();
 				Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã yêu cầu phê duyệt đơn hàng '.$orders->name,$orders));
 				\Session::flash('success_accruracy','Xác thực thành công. Đơn hàng đã chuyển cho người kiểm duyệt');
 				return redirect('admin');
 			}
 			else{
 				return redirect('admin');
 			}
 		}
 		else if(!empty($r->btn_update)){
 			$query = DB::table('orders')->where('id','=',$r->orders_id)->update([
 				'process_id'=>'1'
 				]);
 			if($query<=1){
 				$users=User::whereIn('groupuser_id',[3])->get();
 				Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã cập nhật đơn hàng '.$orders->name,$orders));
 				\Session::flash('success_accruracy','Cập nhật thành công. Đơn hàng đã chuyển cho người Cập nhật');
 				return redirect('admin');
 			}
 		}
 	}
 	public function postUpdateOrder(Request $req)
 	{
 		if($req->has('delete'))
 		{
 			$orders=Orders::find($req->orders_id);
 			$orders->delete();
 			if($orders->user->status!=0)
 			{
 				$orders->user->delete();
 			}
 			\Session::flash('success_approval','Đã hủy đơn hàng');
 			return redirect('admin');
 		}
 		$userinfo=UserInfo::find($req->userinfo_id);
 		$user=User::find($req->user_id);
 		//$user->organization_id=$req->organization_id;
 		//$user->save();
 		$userinfo->employee_id=$req->employee_id;
 		$userinfo->user_id=$req->user_id;
 		$userinfo->fullname=$req->name;
 		$userinfo->address1=$req->address1;
 		$userinfo->address2=$req->address2;
 		$userinfo->dateissue=date('Y-m-d',strtotime(str_replace("/","-",$req->dateissue)));
 		$userinfo->salary=preg_replace("/[ đồng.,]/","",$req->salary);
 		$userinfo->issuedby=$req->issuedby;
 		$userinfo->phone1=$req->phone1;
 		$userinfo->phone2=$req->phone2;
 		$userinfo->phone3=$req->phone3;
 		$userinfo->phone4=$req->phone4;
 		$userinfo->birthday=date('Y-m-d',strtotime(str_replace("/","-",$req->birthday)));
 		$userinfo->sex=$req->sex;
 		$userinfo->identitycard=$req->identitycard;
 		$userinfo->exchange_status=$req->exchange_status;
 		$userinfo->note1=$req->note1;
 		$userinfo->note2=$req->note2;
 		$userinfo->type_identifycation=$req->type_identifycation;
 		$userinfo->time_worked=$req->time_work;
 		$userinfo->department=$req->department;
 		// $userinfo->number_account=$req->number_account;
 		// $userinfo->bank_name=$req->bank_name;
 		// $userinfo->salary_avg=preg_replace("/[ đồng.,]/","",$req->salary_avg);
 		// $userinfo->salary_day=$req->salary_day;
 		$userinfo->identifycation_number=$req->identifycation_number;
 		$userinfo->position=$req->position;
 		$userinfo->dateissue_identifycation=date('Y-m-d',strtotime(str_replace("/","-",$req->dateissue_identifycation)));
 		$userinfo->issuedby_identifycation=$req->issuedby_identifycation;
 		$userinfo->save();
 		// return $userinfo;
 		$search = [' đồng','.'];
 		$price =  str_replace($search,"",$req->price);
 		$orders=Orders::find($req->order_id);
 		$r_id = DB::table('retailsystem')->where('retailcity','like','%'.$req->adcity.'%')->where('retaildistrict','like','%'.$req->addis.'%')->where('nameretail','like','%'.$req->admarket.'%')->where('name_center','like','%'.$req->adstore.'%')->get();
 		$orders=Orders::find($req->orders_id);
 		$orders->lead_time=$req->lead_month;
 		$orders->color=$req->color;
 		if($req->select_rate=='')
 		{
 			$prepay = str_replace($search,"",$req->pre_pay);
 		}
 		else
 		{
 			$prepay = $price*$req->select_rate;
 		}
 		$orders->prepay=$prepay;
 		$orders->buy_now=str_replace(['đồng',' ','.',','],'',$req->salary)*2.5;
 		$orders->price=$price;
 		$orders->city=$req->adcity;
 		$orders->supmarket=$req->admarket;
 		$orders->product_reg=$req->product;
 		$orders->product_code=$req->code_product;
 		$orders->select_rate=$req->select_rate;
 		$orders->district=$req->addis;
 		$orders->store=$req->adstore;
 		$orders->retailsystem_id=$r_id[0]->id;
 		if($req->type=='accuracy')
 		{
 			\Session::flash('success_accuracy','Cập nhật thành công. Đơn hàng đã chuyển cho người xác thực');
 			$orders->process_id=2;
 			$orders->note='';
 			$users=User::whereIn('groupuser_id',[4])->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã cập nhập đơn hàng '.$orders->name,$orders));
 		}
 		else
 		{
 			\Session::flash('approval','Cập nhật thành công. Đơn hàng đã chuyển cho người kiểm duyệt');
 			$orders->process_id=3;
 			$orders->note='';
 			$users=User::whereIn('groupuser_id',[5])->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã cập nhập đơn hàng của '.$orders->name.' vui lòng xác nhận thông tin',$orders));
 		}
 		$orders->save();
 		return redirect('admin');
 	}
 	public function postSaleOrder(Request $req)
 	{	
 		$order=Orders::find($req->order_id);
 		if($req->has('print_contract'))
 		{
 			$this->printOrders($order);
 		}
 		if($req->has('print_auto_pay'))
 		{
 			$this->printAutoPay($order);
 		}
 		if($req->has('print_notification'))
 		{
 			$this->print_notification($order);
 		}
 		if($req->has('print_pay'))
 		{
 			$this->print_pay($order);
 		}
 		if($req->has('back'))
 		{
 			return redirect('admin');
 		}
 		if($req->has('ship'))
 		{
 			\Session::flash('success_accruracy','Đã giao hàng');
 			$order->process_id=5;
 			$order->save();
 			return redirect('admin');
 		}
 	}
 	public function print_pay($order)
 	{
 		if($order->process_id==4||$order->process_id==5)
 		{
 			$fileName = "orders/order4.docx";
 			$doc = new \PhpOffice\PhpWord\TemplateProcessor($fileName);
 			$image=$order->uploadfile->where('type',0)->first();
 			if($image)
 			{
 				$doc->setImageValueAlt('images.png','uploadfile/orders/'.$image->path);
 			}
 			else
 			{
 				$doc->deleteImage('images.png');
 			}
 			$name2=time().'4.docx';
 			$doc->saveAs($name2);
 			header('Content-Description: File Transfer');
 			header('Content-Type: application/octet-stream');
 			header('Content-Disposition: attachment; filename=Chứng từ thanh toán _'.$order->name.'.docx');
 			header('Content-Transfer-Encoding: binary');
 			header('Expires: 0');
 			header('Content-Length: ' . filesize($name2));
 			readfile($name2);
 			unlink($name2);
 		}
 	}
 	public function print_notification(Orders $order)
 	{
 		if($order->process_id==4||$order->process_id==5)
 		{
 			$fileName = "orders/order3.docx";
 			$doc = new \PhpOffice\PhpWord\TemplateProcessor($fileName);
 			$doc->setValue('name',$order->user->userinfo->fullname);
 			$doc->setValue('phone',$order->user->userinfo->phone1);
 			$doc->setValue('birthday',\Carbon::parse($order->user->userinfo->birthday)->format('d/m/Y'));
 			if($order->user->userinfo->sex==1)
 			{
 				$doc->setValue('sex','Nam');
 			}

 			else if($order->user->userinfo->sex==2)
 			{
 				$doc->setValue('sex','Nữ');
 			}
 			else 
 			{
 				$doc->setValue('sex','');
 			}

 			if($order->user->userinfo->type_identifycation==null)
 				$doc->setValue('type_identifycation','Chứng minh nhân dân');
 			else
 			{
 				switch ($order->user->userinfo->type_identifycation) {
 					case 1:
 					$doc->setValue('type_identifycation','Hộ chiếu');
 					break;
 					case 2:
 					$doc->setValue('type_identifycation','Giấy phép lái xe');
 					break;
 					case 3:
 					$doc->setValue('type_identifycation','Căn cước');
 					break;
 					default:
 						# code...
 					break;
 				}
 			}
 			if ($order->user->userinfo->type_identifycation==null) {
 				$doc->setValue('number_ind',$order->user->userinfo->identitycard);
 			}
 			else
 			{
 				$doc->setValue('number_ind',$order->user->userinfo->identifycation_number);
 			}
 			if($order->user->userinfo->type_identifycation==null)
 				$doc->setValue('dateissue',\Carbon::parse($order->user->userinfo->dateissue)->format('d/m/Y'));
 			else
 				$doc->setValue('dateissue',\Carbon::parse($order->user->userinfo->dateissue_identifycation)->format('d/m/Y'));

 			if($order->user->userinfo->type_identifycation==null)
 				$doc->setValue('issueby',$order->user->userinfo->issuedby);
 			else
 				$doc->setValue('issueby',$order->user->userinfo->issuedby_identifycation);
 			$doc->setValue('product',$order->product_reg);
 			$doc->setValue('product_id',$order->product_code);
 			$doc->setValue('color',$order->color);
 			$doc->setValue('price',number_format($order->price)." đồng");
 			$doc->setValue('prepay',number_format($order->prepay)." đồng");
 			$doc->setValue('select_rate',number_format($order->price-$order->prepay)." đồng");
 			$doc->setValue('address',$order->user->userinfo->address1);
 			$doc->setValue('store',$order->retailSystem->name_center);
 			$doc->setValue('date',\Carbon::parse($order->updated_at)->format('d/m/Y'));
 			$name2=time().'3.docx';
 			$doc->saveAs($name2);
 			header('Content-Description: File Transfer');
 			header('Content-Type: application/octet-stream');
 			header('Content-Disposition: attachment; filename=Thông báo _'.$order->name.'.docx');
 			header('Content-Transfer-Encoding: binary');
 			header('Expires: 0');
 			header('Content-Length: ' . filesize($name2));
 			readfile($name2);
 			unlink($name2);
 		}
 	}
 	public function postApprovalOrder(Request $r){
 		$orders=Orders::find($r->order_id);
 		if(!empty($r->update)){
 			DB::table('orders')->where('id','=',$r->order_id)->update([
 				'process_id'=>'1',
 				'note'=>$r->note_update,
 				]);
 			$users=User::whereIn('groupuser_id',[3])->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã cập nhật đơn hàng '.$orders->name,$orders));
 			\Session::flash('success_accruracy','Đơn hàng đã chuyển cho người Cập nhật');
 			return redirect('admin');
 		}
 		if(!empty($r->deactive)){
 			DB::table('orders')->where('id','=',$r->order_id)->update([
 				'process_id'=>'6'
 				]);
 			DB::table('user')->where('id','=',$r->user_id)->update([
 				'status'=>'2'
 				]);
 			$users=User::whereIn('groupuser_id',[6])->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã từ chối đơn hàng '.$orders->name,$orders));
 			\Session::flash('success_accruracy','Đơn hàng đã bị từ chối!!!');
 			return redirect('admin');
 		}
 		if(!empty($r->accuracy)){
 			DB::table('orders')->where('id','=',$r->order_id)->update([
 				'process_id'=>'2',
 				'note'=>$r->note_accuracy,
 				]);
 			$users=User::whereIn('groupuser_id',[4])->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã yêu cầu xác thực đơn hàng '.$orders->name,$orders));
 			\Session::flash('success_accruracy','Đơn hàng đã chuyển cho người Xác thực');
 			return redirect('admin');
 		}
 		else if(!empty($r->approval)){
 			$u=User::find($orders->user->id);
 			$u->status=0;
 			$u->save();
 			DB::table('orders')->where('id','=',$r->order_id)->update([
 				'process_id'=>'4'
 				]);
 			$user_id=DB::table('user_retailsystem')->where('retailsystem_id',$orders->retailsystem_id)->pluck('user_id');
 			$users=User::whereIn('id',$user_id)->get();
 			Notification::send($users, new CheckOrdersNotification(Auth::user()->username.' đã duyệt  đơn hàng '.$orders->name,$orders));
 			\Session::flash('success_accruracy','Xét duyệt thành công. Đơn hàng đã chuyển cho người Bán hàng');
 			return redirect('admin');
 		}
 	}
 	public function exportExcelUserinfoApproval(Request $r,$id){
 		$data = UserInfo::select('employee_id','fullname','address1','identitycard','dateissue','issuedby','salary','phone1','birthday','time_worked','department','position','bank_name','number_account','note1','note2')->where('id','=',$id)->get();
 		Excel::create('Thông tin khách hàng '.$data[0]->fullname, function($excel) use ($data) {
 			$excel->sheet('Sheet1', function($sheet) use ($data)
 			{
 				$sheet->fromArray($data,null,'A1',false,false);
 				$headings=array('Mã nhân viên','Họ tên','Địa chỉ','Số CMND','Ngày Cấp','Nơi Cấp','Lương','Số điệ thoại','Ngày Sinh','Kinh nghiệm làm việc','Phòng ban','Chức vụ','Ngân Hàng','Số tài khoản','Ghi Chú 1','Ghi chú 2');
 				$sheet->prependRow(1, $headings);
 			});
 		})->download('xls');
 	}
 	public function uploadImage(Request $req)
 	{
 		$image=Uploadfile::where(['type'=>0,'orders_id'=>$req->order_id])->first();
 		if(!$image){
 			$upload = new Uploadfile();
 			if($req->hasFile('file')){
 				$path = 'uploadfile/orders/';
 				$file = $req->file('file');
 				$name = $file->getClientOriginalName();
 				do{
 					$filename = str_random(4)."_".$name;
 				}while(file_exists("uploadfile/orders".$filename));
 				$file->move($path,$filename);
 				$upload->path = $filename;
 				$upload->type=0;
 				$upload->orders_id=$req->order_id;   
 			}
 			else {
 				$upload->path="";
 			}
 			$upload->save();
 		}
 		else
 		{
 			$img=Uploadfile::find($image->id);
 			unlink('uploadfile/orders/'.$img->path);
 			if($req->hasFile('file')){
 				$path = 'uploadfile/orders/';
 				$file = $req->file('file');
 				$name = $file->getClientOriginalName();
 				do{
 					$filename = str_random(4)."_".$name;
 				}while(file_exists("uploadfile/orders".$filename));
 				$file->move($path,$filename);
 				$img->path = $filename;  
 			}
 			else {
 				$upload->path="";
 			}
 			$img->save();
 		}

 	}
 	public function deleteImage(Request $req)
 	{
 		$image=Uploadfile::where(['type'=>0,'orders_id'=>$req->id])->first();
 		unlink('uploadfile/orders/'.$image->path);
 		Uploadfile::find($image->id)->delete();
 		return true;
 	}
 	public function getOderAdmin()
 	{
 		if (Auth::user()->groupuser_id==1) {
 			$order=Orders::all();
 			$ProcessStatus=ProcessStatus::all();
 			return view('business.orders.index',compact('order','ProcessStatus'));
 		}
 		else{
 			return redirect('admin');
 		}
 	}
 	public function postAjaxNewUserOrder(Request $r){
 		// return \Response::json($r->name);
 		if(!empty($r->btn_register)){
 			$user = new User();
 			$userinfo = new UserInfo();
 			$user->username = convertname($r->name).rand(100,999);
 			$user->groupuser_id = 2;
 			$user->password= Hash::make("password");
 			$user->status = 4;
 			$user->syslock=1;
 			$user->organization_id = 25;
 			// $user->created_at = \Carbon::today();
 			// $userinfo->employee_id = rand(10000000,99999999);
 			$userinfo->fullname = $r->name;
 			$userinfo->address1 = $r->add_u;
 			$userinfo->address2 = $r->selected_city;
 			// $userinfo->dateissue = Carbon::createFromFormat('d/m/Y', $r->date_issue);
	 		$userinfo->salary = str_replace(['.',' đồng'],"",$r->salary);
	 		$userinfo->issuedby = $r->addr_issue;//noi cap
	 		$userinfo->identitycard = $r->number_i;
	 		$userinfo->phone1 = $r->phone;
	 		$userinfo->assess_id = 1;
 		// $userinfo->created_at=\Carbon::now();
	 		$user->save();
	 		$user->userinfo()->save($userinfo);
	 		$users=User::whereIn('groupuser_id',[3])->get();
	 		Notification::send($users, new UserNotification($userinfo->fullname.' đã yêu cầu đăng ký mới ',$userinfo));
	 		return Response::json(['user_id'=>$user->id,'fullname'=>$userinfo->fullname]);
 	}
 	else if(!empty($r->btn_order_new)){
 		$user = new User();
 		$userinfo = new UserInfo();
 		$user->username = convertname($r->name).rand(100,999);
 		$user->groupuser_id = 2;
 		$user->password= Hash::make("password");
 		$user->status = 5;
 		$user->syslock=1;
 		$user->organization_id = $r->company;
 		$user->created_at = \Carbon::today();
 		// $userinfo->employee_id = rand(10000000,99999999);
 		$userinfo->fullname = $r->name;
 		$userinfo->address1 = $r->add_u;
 		$userinfo->dateissue = Carbon::createFromFormat('d/m/Y', $r->date_issue);
 		$userinfo->salary = str_replace(['.',' đồng'],"",$r->salary);
 		$userinfo->issuedby = $r->addr_issue;//noi cap
 		$userinfo->identitycard = $r->number_i;
 		$userinfo->phone1 = $r->phone;
 		$userinfo->assess_id = 1;
 		// $userinfo->created_at=\Carbon::now();
 		$user->save();
 		$user->userinfo()->save($userinfo);
 		return Response::json(['user_id'=>$user->id,'fullname'=>$userinfo->fullname,'buy'=>$userinfo->salary*2.5]);
 	}
 	else if(!empty($r->btn_order_form)){
 		$city = "%".$r['select_city']."%";
 		$dis= "%".$r['select_dis']."%";
 		$market = "%".$r['select_market']."%";
 		$store = "%".$r['select_store']."%";	
 		$r_id = DB::table('retailsystem')->where('retailcity','like',$city)->where('retaildistrict','like',$dis)->where('nameretail','like',$market)->where('name_center','like',$store)->get();
 		$info = UserInfo::where('user_id','=',$r->user_id)->get();
 		$order=new Orders;
 		$order->name=$info[0]->fullname;
 		$order->buy_now=$info[0]->salary*2.5;
 		$order->product_reg=$r->name_product;
 		$order->product_code=$r['code_product'];
 		$order->color=$r['color'];
 		$order->price=str_replace(['.',' đồng'],"",$r->price);
 		$order->prepay=str_replace(['.',' đồng'],"",$r->pre_pay);
 		$order->select_rate=$r['select_rate'];
 		$order->lead_time=$r['lead_time'];
 		$order->supmarket=$r['select_market'];
 		$order->city=$r['select_city'];
 		$order->district=$r['select_dis'];
 		$order->store =$r['select_store'];
 		$order->salesman=$r['sales_man'];
 		$order->phonesale=$r['phone_sale'];
 		$order->user_id=$r->user_id;
 		$order->process_id='1';
 		$order->retailsystem_id=$r_id[0]->id;
 		$order->created_at=\Carbon::today();
 		$order->save();
 		$users=User::whereIn('groupuser_id',[1,3])->get();
 		// $users=User::whereIn('groupuser_id',[1,3])->get();
 		Notification::send($users, new CreateOrderNotification($r->name,$order));
 		return \Response::json(['success'=>'Success']);
 	}
 	else if(!empty($r->btn_upload)){
 		$user = new User();
 		$userinfo = new UserInfo();
 		$user->username = convertname($r->name_user).rand(100,999);
 		$user->groupuser_id = 2;
 		$user->password= Hash::make("password");
 		$user->status = 5;
 		$user->syslock=1;
 		$user->organization_id = $r->company;
 		$user->created_at = \Carbon::today();
 		// $userinfo->employee_id = rand(10000000,99999999);
 		$userinfo->fullname = $r->name_user;
 		$userinfo->address1 = $r->address_user;
 		$userinfo->dateissue = Carbon::createFromFormat('d/m/Y', $r->date_issue);
 		$userinfo->salary = str_replace(['.',' đồng'],"",$r->salary_user);
 		$userinfo->issuedby = $r->addr_issue;//noi cap
 		$userinfo->identitycard = $r->number_issue;
 		$userinfo->phone1 = $r->phone_user;
 		$userinfo->assess_id = 1;
 		// $userinfo->created_at=\Carbon::now();
 		$user->save();
 		$user->userinfo()->save($userinfo);
 		$user=User::where('id',$user->id)->first();
 		$city = RetailSystem::groupBy('retailcity')->pluck('retailcity');
 		$name = RetailSystem::groupBy('nameretail')->pluck('nameretail');
 		return view('business.orders.upload',compact('user','city','name'));	
 	}
 }
}
