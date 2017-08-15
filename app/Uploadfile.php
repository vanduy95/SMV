<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    protected $table = "uploadfile";
    protected $fillable = ['user_id','uploadfile'];

    public function orders(){
    	return $this->belongsTo('App\Orders','orders_id','id');
    }
}
