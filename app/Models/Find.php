<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Find extends Model
{

    protected $fillable = ['name','address1','address2','phone','images','zipcode'];

}
