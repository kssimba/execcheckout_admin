<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Providers\RouteServiceProvider;
use Kreait\Firebase\Firestore;
use Datatables;
use App\Models\Restaruant;
use App\Models\Menu;
use App\Models\Menuitem;
use App\Models\Section;
use App\Models\Itemoption;
use App\Models\Suboption;
use App\Models\Find;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Auth;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function showSalesReport(){
        $firestore = app('firebase.firestore');
        return view('admin.sales_report');
    }
}