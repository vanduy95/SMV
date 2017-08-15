<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailSystem extends Model
{
    protected $table = "retailsystem";
    public function user(){
        return $this->belongsToMany('App\User','user_retailsystem','retailsystem_id','user_id')->withPivot('phone','address');
    }
}
