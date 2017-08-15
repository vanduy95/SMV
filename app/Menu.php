<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    protected $fillable = ['parent_id','name','nameroute','order'];
    public function groupUser(){
    	return $this->belongsToMany('App\GroupUser','menu_group','menu_id','groupuser_id')->withpivot('value','id');
    }
}
