<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table="organization";
    protected $fillable= ['ma','name','city','address','noted','phone','parent_id','phone','bank','bankbranch'];
    public function user(){
    	$this->hasMany('App\User','organization_id','id');
    }
    public function product(){
    	return $this->hasMany('App\Product','organization_id','id');
    }
}
