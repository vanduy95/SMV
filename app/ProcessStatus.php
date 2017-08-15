<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessStatus extends Model
{
    protected $table = "processstatus";
    protected $fillable = ['name','value'];
    public function orders(){
    	return $this->hasMany('App\Orders','process_id','id');
    }
}
