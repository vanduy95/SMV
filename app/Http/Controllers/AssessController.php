<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assess;
use Auth;
use App\Menu_Group;
use App\Menu;

class AssessController extends Controller
{
	public function index2(){
		$assess = Assess::get();
		return view('business.assess.index',compact('assess'));
	}
	public function getRegister(){
		return view('business.assess.register');
	}
	public function editAssess($id){
		$edassess = Assess::find($id);
		return view('business.assess.show',compact('edassess'));
	}
	public function saveAssess($id, Request $request){
		Assess::where('id','=',$id)
		->update(array(
			'point'=>$request['point'],
			'reted'=>$request['reted'],
			'review'=>$request['review']
			));
		return redirect()->route('indexassess');
	}
	public function DelAssess($id){
		$delAss=Assess::find($id);
		$delAss->delete();
		return redirect()->route('indexassess');
	}
	public function InsertAss(Request $r){
		Assess::insert([
			'point'=>$r->point,
			'reted'=>$r->reted,
			'review'=>$r->review,
			'created_at'=>$r->create_at
			]);
		return redirect()->route('indexassess');
	}

	public function ajaxDeleteAssess(Request $req)
	{
		
	}
	public function sortmenu($menu)
	{
		$collection = collect($menu);
		$sorted = $collection->sortBy(function ($menu, $key) {
			return $menu['order'];
		});

		return $sorted->values()->all();
	}
	public function demo()
	{
		$user = Auth::user();
		$group = $user->groupuser_id;
		$groupmenu = Menu_Group::all();
		$menu_id = array();
		foreach ($groupmenu as $key => $value) {
			if($value->groupuser_id==$group && $value->value==1 && $value->display ==1){
				$menu_id[] = $value->menu_id;
			}
		}
		$menu = array();
		foreach ($menu_id as $key => $value) {
			$menu[] = Menu::find($value);
		}
		$menusort = $this->sortmenu($menu);
		foreach ($menusort as $key => $value) {
			if($value->parent_id == 0 && $value->nameroute == "#"){
				echo '<li class="treeview active">';
				echo '<a href="'.url($value->nameroute).'">';
				echo '<i class="fa fa-th"></i><span>'.$value->name.'--'.$value->order.'</span>';
				echo '</a>';
				$this->showsubmenu($menu,$parent_id=$value->id);
				echo '</li>';
			}
			else 
				if($value->parent_id == 0 && $value->nameroute != "#"){
					echo '<li class="treeview active">';
					echo '<a href="'.route($value->nameroute).'">';
					echo '<i class="fa fa-th"></i><span>'.$value->name.'--'.$value->order.'</span>';
					echo '</a>';
				$this->showsubmenu($menu,$parent_id=$value->id);
					echo '</li>';
				}
			}
			
		}
		function showsubmenu($menu, $parent_id)
		{
			$cate_data = array();
			foreach ($menu as $key => $item)
			{
				if ($item['parent_id'] == $parent_id)
				{
					$cate_data[] = $item;
				unset($menu[$key]); //hủy 1 biến giá trị
			}
		}
		$cate_data_sort = $this->sortmenu($cate_data);
		if ($cate_data_sort)
		{
			echo '<ul class="treeview-menu">';
			foreach ($cate_data_sort as $key => $item)
			{
				if($item->nameroute=="#"){
					echo '<li class="treeview"><a href="'.url($item->nameroute).'"><i class="fa fa-circle-o"></i>'.$item->name.'--'.$item->order.'</a>';
					$this->showsubmenu($menu, $item['id']);
					echo '</li>';
				}
				else{
					echo '<li class="treeview"><a href="'.route($item->nameroute).'"><i class="fa fa-circle-o"></i>'.$item->name.'--'.$item->order.'</a>';
					$this->showsubmenu($menu, $item['id']);
					echo '</li>';
				}
			}
			echo '</ul>';
		}

	}

}
