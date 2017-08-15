<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "orders";
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function processstatus(){
    	return $this->belongsTo('App\ProcessStatus','process_id','id');
    }
     public function retailSystem(){
    	return $this->belongsTo('App\RetailSystem','retailsystem_id','id');
    }
    public function uploadfile()
    {
        return $this->hasMany('App\Uploadfile','orders_id','id');
    }
}
