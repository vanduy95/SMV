<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = "userinfo";
    protected $fillable = ['user_id','firstname','lastname','address','namecompany','addresscompany','salary','phone','maritalstatus','birthday','sex','identitycard'];
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function assess(){
    	return $this->belongsTo('App\Assess','assess_id','id');
    }
    // public function organization(){
    // 	return $this->belongsTo('App\Organization','');
    // }
}
