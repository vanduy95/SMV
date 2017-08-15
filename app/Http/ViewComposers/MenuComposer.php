<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Menu_Group;
use App\Menu;

class MenuComposer
{
	public function compose(View $view){
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
				echo '<i class="fa fa-th"></i><span>'.$value->name.'</span>';
				echo '</a>';
				$this->showsubmenu($menu,$parent_id=$value->id);
				echo '</li>';
			}
			else 
				if($value->parent_id == 0 && $value->nameroute != "#"){
					echo '<li class="treeview active">';
					echo '<a href="'.route($value->nameroute).'">';
					echo '<i class="fa fa-th"></i><span>'.$value->name.'</span>';
					echo '</a>';
					$this->showsubmenu($menu,$parent_id=$value->id);
					echo '</li>';
				}
			}
		}
		public function sortmenu($menu)
		{
			$collection = collect($menu);
			$sorted = $collection->sortBy(function ($menu, $key) {
				return $menu['order'];
			});

			return $sorted->values()->all();
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
			foreach ($cate_data as $key => $item)
			{
				if($item->nameroute=="#"){
					echo '<li class="treeview"><a href="'.url($item->nameroute).'"><i class="fa fa-circle-o"></i>'.$item->name.'</a>';
					$this->showsubmenu($menu, $item['id']);
					echo '</li>';
				}
				else{
					echo '<li class="treeview"><a href="'.route($item->nameroute).'"><i class="fa fa-circle-o"></i>'.$item->name.'</a>';
					$this->showsubmenu($menu, $item['id']);
					echo '</li>';
				}
			}
			echo '</ul>';
		}

	}

}