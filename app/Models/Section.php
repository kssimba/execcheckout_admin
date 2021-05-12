<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Section extends Model
{

    protected $fillable = ['name','menu_id','description','note','options','orderNumber'];

}
