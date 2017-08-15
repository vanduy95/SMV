<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Menu_Group;
use App\Menu;

class ListMenuComposer
{
    public function compose(View $view){
        $em = 2;
        $user = Auth::user();
        $group = $user->groupuser_id;
        $groupmenu = Menu_Group::all();
        $menu_id = array();
        foreach ($groupmenu as $key => $value) {
            if($value->groupuser_id==$group && $value->value==1){
                $menu_id[] = $value->menu_id;
            }
        }
        $menu = array();
        foreach ($menu_id as $key => $value) {
            $menu[] = Menu::find($value);
        }
        echo '<table id="" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">';
        echo '<thead>';
        echo '<tr role="row">';
        echo '<th>Name</th>';
        echo '<th>Route</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $menusort = $this->sortmenu($menu);
        foreach ($menusort as $key => $value) {
            if($value->parent_id == 0){
                echo '<tr>';
                echo '<td><span class="white-text" style="margin-left: '.$em.'em;"><strong>'.$value->name.'</strong></span></td>';
                echo '<td>'.$value->nameroute.'</td>';
                echo '<td>';
                echo '<div class="btn-group">';
                echo '<a href="menu/show/'.$value->id.'"><i class="fa fa-fw fa-cog"></i></a>';
                echo '<a href="menu/'.$value->id.'"><i class="fa fa-fw fa-remove"></i></a>';
                echo '</div>';
                echo '</td>';
                $this->showsubmenu($menu,$parent_id=$value->id,$em);
                echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
    }
    public function sortmenu($menu)
    {
        $collection = collect($menu);
        $sorted = $collection->sortBy(function ($menu, $key) {
            return $menu['order'];
        });

        return $sorted->values()->all();
    }
    function showsubmenu($menu, $parent_id,$em)
    {
       $em =$em+3;
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
            foreach ($cate_data as $key => $item)
            {
                echo '<tr>';
                echo '<td><span class="white-text" style="margin-left: '.$em.'em;">'.$item->name.'</span></td>';
                echo '<td>'.$item->nameroute.'</td>';
                echo '<td>';
                echo '<div class="btn-group">';
                echo '<a href="menu/show/'.$item->id.'"><i class="fa fa-fw fa-cog"></i></a>';
                echo '<a href="menu/'.$item->id.'"><i class="fa fa-fw fa-remove"></i></a>';
                echo '</div>';
                echo '</td>';
                $this->showsubmenu($menu, $item['id'],$em);
                echo '</tr>';
            }
        }

    }
}