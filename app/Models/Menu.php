<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Menu extends Model
{

    protected $fillable = ['name','restaurant_id','description','note','duration','start','end'];

}
