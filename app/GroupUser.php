<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GroupUser;

class GroupUser extends Model
{
    protected $table = "groupuser";
    protected $fillable = ['name','note'];

    public function user(){
    	return $this->hasMany('App\User','groupuser_id','id');
    }

    public function incentive(){
    	return $this->hasMany('App\Incentive','groupuser_id','id');
    }

    public function menu(){
        return $this->belongsToMany('App\Menu','menu_group','groupuser_id','menu_id')->withpivot('value','id');
    }

    public function path(){
        return '/group/'.$this->id;
    }
}
