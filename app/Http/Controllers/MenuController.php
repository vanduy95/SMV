<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\GroupUser;
use App\Menu_Group;


class MenuController extends Controller
{
    public function index(){
    	$menu = Menu::all();
    	return view('business.menu.index',compact('menu'));
    }

    public function getcreate(){
        $menu = Menu::all();
        return view('business.menu.create',compact('menu'));
    }
    public function postcreate(MenuRequest $request,Menu $menu){
        // dd($request->display);
        $groupuser = GroupUser::all();
    	$menu = Menu::create($request->all());
        $menugroup = Menu_Group::all();
        $countmenugroup = $this->checkgroupmenu();
        $display=0;
        if($request->display != null){$display=1;}
        foreach ($groupuser as $key => $group){
            $id=$countmenugroup+$group->id;
            $menu->groupuser()->attach($group->id,['value'=>'0','id'=>$id,'display'=>$display]);
        }
    	\Session::flash('notify','Thêm thành công');
    	return redirect()->route('menucreate');
    }
    public function show($id){
    	$menu = Menu::find($id);
        $menugroup = Menu_Group::find($id);
        $allmenu = Menu::all();
    	return view('business.menu.show',compact('menu','allmenu','menugroup'));
    }
    public function update(UpdateMenuRequest $request,Menu $menu){
    	$menu->fill($request->all());
    	$menu->save();
    	\Session::flash('notify','Sửa thành công');
        return redirect()->route('indexmenu');
        // return $request->all(); 
    }
    public function destroy($id){
    	$menu = Menu::find($id);
    	$menu->delete();
    	\Session::flash('notify','Xóa thành công');
        return redirect()->route('indexmenu');
    }
    public function checkgroupmenu(){
        $menugroup = Menu_Group::all();
        if($menugroup->count()==0){
            return $menugroup->count();
        }
        else{
            return $menugroup->last()->id;
        }
    }
}
