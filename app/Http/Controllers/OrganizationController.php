<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Organization;
use Carbon\Carbon;
use App\Http\Requests\postOrganRequestCom;
use App\Http\Requests\postOrganRequestComEdit;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

use DateTime;
class OrganizationController extends Controller
{
	public function create_company(){
		return view('business.organization.create_company');
	}
	public function InsertCom(postOrganRequestCom $rq){
		$today = Carbon::today();
		if((strlen($rq['phone'])<12 && strlen($rq['phone']) > 9)|| (strlen($rq['phone'])==0)) {
			$space = strpos(($rq['phone']),' ')==''?0:1;
			if($space==0){
				$query = Organization::insert([
					'ma'=>$rq['ma'],
					'name'=>$rq['name'],
					'city'=>$rq['city'],
					'address'=>$rq['addr'],
					'phone'=>$rq['phone'],
					'bank'=>$rq['bank'],
					'system'=>0,
					'created_at'=>$today	
					]);
				if($query==1){
					return redirect('admin/organization/list/company');
				}
			}
			else{
				\Session::flash('mess_phone','Định dạng số đện thoại không đúng, số điện thoại không được có khoảng trắng!!!');
				return redirect('admin/organization/create/company');
			}
		}
		else{
			$space = strpos(($rq['phone']),' ')==''?0:1;
			if(strlen($rq['phone']) <=9){
				\Session::flash('mess_phone','Định dạng số đện thoại không đúng, số điện thoại quá ngắn!!!');
				return redirect('admin/organization/create/company');
			}
			else{
				if($space==0){
					\Session::flash('mess_phone','Định dạng số đện thoại không đúng, số điện thoại quá dài!!!');
					return redirect('admin/organization/create/company');
				}
				else{
					\Session::flash('mess_phone','Định dạng số đện thoại không đúng, số điện thoại không được có khoảng trắng!!!');
					return redirect('admin/organization/create/company');
				}
			}
		}
	}
	public function list_company(){
		$today = Carbon::today()->format('d-m-Y');
		$company= Organization::all()->where('system','=',0);
		return view('business.organization.list.company',compact('today','company'));
	}
	public function del_company($id){
		try{
			$del=Organization::find($id);
			$query=$del->delete();
			if($query==1){
				\Session::flash('mess_del','Đã xóa thành công');
				return redirect('admin/organization/list/company');
			}
		}
		catch(\Exception $ex){
			echo $ex->getMessage()."</br>";
			echo "<a href='/organization/list/company' class='col-lg-12'>Quay lại danh sách hệ thống</a>";
		}
	}
	
	public function get_company($id){
		$organ = Organization::where('system','=',0)->find($id);
		$today = Carbon::today();
		if($organ==""){
			return redirect('404.php');
		}
		return view('business.organization.show.company',compact('organ','today'));
	}
	public function edit_company($id,postOrganRequestComEdit $rq){
		$today = Carbon::today();
		$query=Organization::where('id','=',$id)
		->update(array(
			'name'=>$rq['name'],
			'city'=>$rq['city'],
			'address'=>$rq['addr'],
			'phone'=>$rq['phone'],
			'bank'=>$rq['bank'],
			'updated_at'=>$today	
			));
		if($query==1){
			return redirect('admin/organization/list/company');	
		}
	}
	public function insert_company_excel(Request $r ){
		try{
			set_time_limit(1800);
			$today = Carbon::today();
			$datas=Excel::load(Input::file('upExcel'), function ($reader) {
			})->get();
			// dd($datas);
			foreach ($datas as $rows => $value) {
				// foreach ($row as $key => $value) {
					// dd($value);
					// if($value['ma_cong_ty']==null){
				$random=mt_rand(100000,999999);
					// }
					// dd($value);
				if($value['ten_cong_ty']!=''){
					$query[] = [
					'ma'=>$value['ma_cong_ty']==''?$value['ma_cong_ty']:$random,
					'name'=>$value['ten_cong_ty'],
					'city'=>$value['thanh_pho'],
					'address'=>$value['dia_chi']!==''?$value['dia_chi']:'',
					'phone'=>$value['so_dien_thoai']!==''?$value['so_dien_thoai']:'',
					'bank'=>$value['ngan_hang'],
					'worker'=>$value['cong_nhan']!==''?$value['cong_nhan']:0,
					'system'=>0,
					'created_at'=>$today,
					];
				}
				// }
			}
			//ket thuc
			$insert = Organization::insert($query);
			if($insert==true){
				\Session::flash('message','Thêm danh sách công ty thành công');
				return redirect('admin/organization/list/company');		
			}
		}
		catch(\Exception $ex){
			echo $ex->getMessage()."</br>";
			echo "<a href='admin/organization/list/company' class='col-lg-12'>Thêm không thành công, quay lại trang tải lên tệp tin</a>";
		}
	}
	public function create_company_excel($type){
		// $data = Organization::get()->where('system','=','1')->toArray();
		$data = Organization::select('ma','name','city','address','phone','bank','worker','created_at')->where('system','=','0')->get();
		Excel::create('Danh sách công ty', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
			{
				$sheet->fromArray($data,null,'A1',false,false);
				$headings=array('Mã công ty','Tên công ty','Thành phố','Địa chỉ','Số điện thoại','Ngân hàng','Công nhân','Ngày tạo');
				$sheet->prependRow(1, $headings);
			});
		})->download($type);
	}
	public function demoExcel(){
			$type='xls';
			Excel::create('Danh sách mẫu', function($excel)  {
				$excel->sheet('Sheet1', function($sheet)
				{
					$sheet->fromArray('',null,'A1',false,false);
					$headings=array('Mã công ty','Tên công ty','Thành phố','Địa chỉ','Số điện thoại','Ngân hàng','Công nhân','Ngày tạo');
					$sheet->prependRow(1, $headings);
				});
			})->download($type);
		}
}
