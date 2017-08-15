<?php

namespace App\Http\Controllers;
use App\RetailSystem;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use DB;	
class StoreController extends Controller
{
	public function index(){
		$data = RetailSystem::get();
		return view('business.store.index',compact('data'));
	}
	public function indexExcelStore(){
		$company = DB::table('organization')->where('ma','<>','HT')->select('name','id')->get();
		return view('business.store.excel',compact('company'));
	}
	public function uploadExcelStore(Request $r){
		$today = Carbon::today();
		try{
			$c_user = DB::table('user')->select('id')->max('id');
			$datas=Excel::load(Input::file('upExcel'), function ($reader) {})->get();
			// dd(count($datas));
			// $i = $c_user+1;
			foreach ($datas->toArray() as $rows => $row) {
				foreach ($row as $key => $value) {
					$query[] = [
					'nameretail'=>$value['he_thong_ban_le'],
					'retailcity'=>$value['tinhthanh_pho'],
					'retaildistrict'=>$value['quanhuyen'],
					'name_center'=>$value['ten_trung_tam_cua_hang'],
					'storeaddress'=>$value['dia_chi_trung_tamcua_hang'],
					'phonecontact'=>$value['so_dien_thoai_lien_he'],
					'interest_rate'=>$value['lai_suat'],
					'created_at'=>$today
					];
				}
			}
			$insert = RetailSystem::insert($query);
			if($insert==true){
				\Session::flash('mess_excel','Thêm Mới Thành Công');
				return redirect('admin/store');		
			}
		}
		catch(\Exception $ex){
			echo $ex->getMessage()."</br>";
			echo "<a href='/admin/store' class='col-lg-12'>Quay Lại Trang Store</a>";
		}
	}

	public function getcreate(){
		return view('business.store.create');
	}
	public function postcreate(ProcessStatusRequest $request){
		RetailSystem::create($request->all());
		\Session::flash('notify','Thêm thành công');
		return redirect('processstatus');
	}
	public function show($id){
		$store = RetailSystem::find($id);
		return view('business.store.show',compact('store'));
	}
	public function update(UpdateProcessStatusRequest $request,RetailSystem $store){
		$store->fill($request->all());
		$store->save();
		\Session::flash('notify','Sửa thành công');
		return redirect('store');

	}

	public function ajaxDeleteStore(Request $req)
	{
		RetailSystem::find($req->store_id)->delete();
		return 'true';
	}

	public function getStoreInfor(Request $req)
	{

		$store=RetailSystem::find($req->retailsystem_id);
		return view('business.store.ajax.showstore',compact('store'));
	}
	public function destroy($id)
	{
		RetailSystem::destroy($id);
		\Session::flash('notify','Xóa thành công');
		return redirect()->route('indexStore');
	}
	public function interest()
	{
		try{
			$store = RetailSystem::groupBy('nameretail')->pluck('nameretail');
			foreach ($store as $key => $value) {
				$interest = RetailSystem::where('nameretail','=',$value)->pluck('interest_rate')->first();
				if($interest != null)
				{
					$interest_rate = $interest;
				}
				else
					$interest_rate = 0;
				$collection[] = (['nameretail'=>$value,'interest'=>$interest_rate]);
			}
			return view('business.store.interest',compact('collection'));
		}
		catch (Exception $e){
			return $e;
		}
		
	}

	public function showinterest($name)
	{
		try{
			$interest = RetailSystem::where('nameretail','=',$name)->pluck('interest_rate')->first();
			if($interest != null)
			{
				$interest_rate = $interest;
			}
			else
				$interest_rate = 0;
			$collection = collect(['nameretail'=>$name,'interest'=>$interest_rate]);
			return view('business.store.updateinerest',compact('collection'));
		}
		catch (Exception $e){
			return $e;
		}
	}
	public function udpateinterest(Request $request,$name)
	{
		try{
			$this->validate($request,[
					'newinterest'=>'numeric|required',
				],
				[
					'newinterest.numeric'=>'Trường này là số',
					'newinterest.required'=>'Trường này không được để trống'
				]);
			$stores = RetailSystem::where('nameretail','=',$name)->get();
			foreach ($stores as $key => $value) {
				$store = RetailSystem::find($value->id);
				$store->interest_rate = $request->newinterest/100;
				$store->save();
			}
			return $this->interest();
		}
		catch (Exception $e){
			return $e;
		}
	}
}
