<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_Group extends Model
{
    protected $table = "menu_group";
    protected $fillable = ['menu_id','groupuser_id','value'];
}
