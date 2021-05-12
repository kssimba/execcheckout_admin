<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Restaruant extends Model
{

        protected $fillable = ['name','weburl','city','state','postalcode','fax'
            ,'facebook','twitter','instagram','pinterest','youtube','google'
            ,'brief','detail','logo','banner','price','cuisine','seat','maxgroup'
            ,'deliveryradius','smoke','takeout','pets','delivery'
            ,'reservation','wheelchair','catering','vegetarian','open'
            ,'close','address2','address1','phone','status','created_at','updated_at','mon_open',
            'bakery','bbq','coffee_tea','comfort_food','icecream','mexican','pizza','steakhouse',
            'monday','tuesday','wednesday','thursday','friday','saturday','sunday','relay_id','prep_time','order_info','prefer_order','delivery_fee'];

}
