<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;

class RestaurantController extends Controller
{

    public function showDetail(){

        return view('Restaurant.resdetail');
    }

}
