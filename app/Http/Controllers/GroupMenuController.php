<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\GroupUser;
use App\Menu_Group;
use Illuminate\Support\Facades\DB;

class GroupMenuController extends Controller
{
	public function index(){
		$menus = Menu::all();
		$count =$menus->count();
		$groupuser = GroupUser::all();
		$menugroup = DB::table('menu_group')->get();
		$result = array();
		$a=1;
		foreach ($menugroup as $key => $menu) {
			$result[] = [$menu->menu_id,$menu->groupuser_id,$menu->value];
		}
		// return $result;
		return view('business.groupmenu.index',compact('menus','groupuser','count','menugroup','result','a'));

	}
	public function update(Request $request){
		$groupmenu = Menu_Group::all();
		$menu= Menu::all();
		$groupuser = GroupUser::all();
		$a=1;
		foreach ($menu as $key => $m){
			foreach ($groupuser as $key => $group) {
				foreach ($groupmenu as $key => $gm) {
					if($group->id==$gm->groupuser_id && $m->id==$gm->menu_id){
						$menu_group = Menu_Group::find($gm->id);
						if((string)$request->get($a) == "")
							$menu_group->value = "0";
						else 
							$menu_group->value = "1";
						$menu_group->save();
						break;
					}
				}
				$a++;
			}
		}
		return redirect()->route('menugroup');
	}
}
