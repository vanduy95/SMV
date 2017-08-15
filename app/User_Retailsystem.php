<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Retailsystem extends Model
{
    protected $table = "user_retailsystem";
    public function retailsystem(){
        return $this->belongsToMany('App\RetailSystem','user_retailsystem','user_id','retailsystem_id')->withPivot('phone','address');
    }
}
