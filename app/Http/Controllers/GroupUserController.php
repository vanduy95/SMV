<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateGroupUserRequest;
use App\Http\Requests\GroupUserRequest;
use App\GroupUser;
use App\Menu;
use App\Menu_Group;
use DB;

class GroupUserController extends Controller
{
    public function index()
    {
    	$groupuser = GroupUser::where('name','<>','Admin')->get();
    	return view('groupuser.index',compact('groupuser'));
    }

    public function update(UpdateGroupUserRequest $request, GroupUser $groupuser)
    {
        $groupuser->fill($request->all());
        $groupuser->save();
        \Session::flash('notify','Sửa thành công');
        return redirect()->route('indexgroupuser');
    }
    public function show($id)
    {
    	$groupuser=GroupUser::find($id);
    	return view('groupuser.show',compact('groupuser'));
    }
    public function getcreate(){
        return view('groupuser.create');
    }
    public function postcreate(GroupUserRequest $request,GroupUser $groupuser)
    {
        $menus = Menu::all();
        $groupuser = new GroupUser();
        $menugroup = Menu_Group::all();
        $groupuser->name = $request->name;
        $groupuser->note = $request->note;
        $groupuser->save();
        $countmenugroup = $this->checkgroupmenu();
        foreach ($menus as $key => $menu) {
            $id=$countmenugroup+$menu->id;
            $groupuser->menu()->attach($menu->id,['value'=>'0','id'=>$id]);
        }
        \Session::flash('notify','Thêm thành công');
        return redirect()->route('indexgroupuser');
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
    public function destroy($id)
    {
        GroupUser::destroy($id);
        \Session::flash('notify','Xóa thành công');
        return redirect()->route('indexgroupuser');
    }

    public function ajaxDeleteGroupUser(Request $req)
    {
        GroupUser::destroy($req->groupuser_id);
        return 'true';
    }
}
