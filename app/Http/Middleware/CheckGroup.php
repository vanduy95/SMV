<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Menu_Group;
use App\Menu;
use Illuminate\Support\Facades\Route;


class CheckGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $group_menu = Menu_Group::all();
        $groupuser_id = Auth::user()->groupuser_id;
        $groupmenu =array();
        $menus=Menu::all();
        foreach ($group_menu as $key => $gr) {
            foreach ($menus as $key => $menu) {
                if($gr->menu_id==$menu->id){
                    $groupmenu[]=[$menu->nameroute,$gr->groupuser_id,$gr->value];
                }
            }
        }
        $currentPath= Route::currentRouteName();
        // dd($currentPath);
        //get name route
        foreach ($groupmenu as $key => $value) {
            if(in_array([$currentPath,$groupuser_id,1],$groupmenu)){
                return $next($request);
            }
            else{
                return redirect()->route('permissiondenied');
            }
        }
    }
}
