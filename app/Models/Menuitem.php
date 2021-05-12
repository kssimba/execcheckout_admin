<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Menuitem extends Model
{

    protected $fillable = ['name','section_id','description','price','calories','heat','allergy','allergens','special','vegetarian','vegan','kosher','halal','glugen','alcohol','taxid','taxname','taxrate','defaults','image'];

}
