<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'groupuser_id','username','email','password','status','syslock',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];
    
    protected $table = "user";
    // protected $fillable = ['groupuser_id','username','email','password','status','syslock'];
    public function loan(){
    	return $this->belongsToMany('App\Loan','user_loan','user_id','loan_id')->withpivot('incentivevalue','id')->withTimestamps();
    }

    public function groupuser(){
    	return $this->belongsTo('App\GroupUser','groupuser_id','id');
    }

    public function userinfo(){
        return $this->hasOne('App\UserInfo','user_id','id');
    }

    public function organization(){
        return $this->belongsTo('App\Organization','organization_id','id');
    }

    public function orders(){
        return $this->hasMany('App\Orders','user_id','id');
    }

    public function uploadfile(){
        return $this->hasMany('App\Uploadfile','user_id','id');
    }
     public function retailsystem(){
        return $this->belongsToMany('App\RetailSystem','user_retailsystem','user_id','retailsystem_id')->withPivot('phone','address');
    }
}
