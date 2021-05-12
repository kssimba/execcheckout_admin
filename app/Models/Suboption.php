<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Suboption extends Model
{

    protected $fillable = ['name','option_id','value'];

}
