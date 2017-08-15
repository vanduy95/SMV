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
		$query = Organization::insert([
			'ma'=>$rq['ma'],
			'name'=>$rq['name'],
			'city'=>$rq['city'],
			'address'=>$rq['addr'],
			'phone'=>$rq['phone'],
			'bank'=>$rq['bank'],
			'system'=>1,
			'created_at'=>$today	
			]);
		if($query==1){
			return redirect('organization/list/company');
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
			echo "<a href='/organization/list/company' class='col-lg-12'>Return List System</a>";
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
			$datas=Excel::load(Input::file('upExcel'), function ($reader) {
			})->get();
			foreach ($datas->toArray() as $rows => $row) {
				foreach ($row as $key => $value) {
					if($value['id']==null){
						$random=mt_rand(100000,999999);
					}
					else{
						$random=$value['id'];
					}
					$query[] = [
					'ma'=>$random,
					'name'=>$value['name'],
					'city'=>$value['city'],
					'address'=>$value['address'],
					'phone'=>$value['phone'],
					'bank'=>$value['bank'],
					'worker'=>$value['worker'],
					'system'=>0
					];
				}
			}
			$insert = Organization::insert($query);
			if($insert==true){
				\Session::flash('message','Thêm danh sách công ty thành công');
				return redirect('admin/organization/list/company');		
			}
		}
		catch(\Exception $ex){
			echo $ex->getMessage()."</br>";
			echo "<a href='admin/organization/list/company' class='col-lg-12'>Return Import File Excel</a>";
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
}
