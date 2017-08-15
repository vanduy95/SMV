<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assess extends Model
{
    protected $table = "assess";
    protected $fillable = ['point','reted','review'];

    public function userinfo(){
    	return $this->hasMany('App\Userinfo','userinfo_id','id');
    }
}
