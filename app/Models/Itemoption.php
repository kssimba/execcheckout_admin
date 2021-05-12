<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Itemoption extends Model
{

    protected $fillable = ['name','item_id','style', 'trigger'];

}
