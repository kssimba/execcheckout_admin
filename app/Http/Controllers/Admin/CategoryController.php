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
use App\Models\Category;
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

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function append(){

        return view('admin.add_category');
    }
    
    public function categories_show(){
        return view('admin.category_list');
    }
    
    public function assign_categories_show(){
        $firestore = app('firebase.firestore');
        $collection = $firestore->database()->collection('vendor_categories');
        $snapshot = $collection->documents();
        $vendors_category = [];
        $vendors_restaurant = [];
        
        foreach ($snapshot as $item) {
            $itemWithId = $item->data();
            $itemUpdate['vendor_id'] = $item->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            array_push($vendors_category, $itemUpdate);
        }
        
        $collection = $firestore->database()->collection('restaurants');
        $snapshot = $collection->documents();
        foreach ($snapshot as $item) {
            $itemWithId = $item->data();
            $itemUpdate['vendor_id'] = $item->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            array_push($vendors_restaurant, $itemUpdate);
        }
        
        for($i = 0; $i < count($vendors_restaurant); $i ++){
            $custom_restaurant = Restaruant::where('app_id', $vendors_restaurant[$i]['vendor_id'])->first();
            if(isset($custom_restaurant))
                $vendors_restaurant[$i]['restaurant_id'] = $custom_restaurant->id;
        }
        return view('admin.assign_category',compact('vendors_category', 'vendors_restaurant'));
    }
    
    
    public function assign_categories_show_res($id){
        $firestore = app('firebase.firestore');
        $collection = $firestore->database()->collection('vendor_categories');
        $snapshot = $collection->documents();
        $vendors_category = [];
        $vendors_restaurant = [];
        
        foreach ($snapshot as $item) {
            $itemWithId = $item->data();
            $itemUpdate['vendor_id'] = $item->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            array_push($vendors_category, $itemUpdate);
        }
        
        $custom_restaurant = Restaruant::where('id', $id)->first();
        $collection = $firestore->database()->collection('restaurants')->document($custom_restaurant->app_id);
        $snapshot = $collection->snapshot();
        
        if ($snapshot->exists()) {
            $itemWithId = $snapshot->data();
            $itemUpdate['vendor_id'] = $snapshot->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            $itemUpdate['restaurant_id'] = $id;
            array_push($vendors_restaurant, $itemUpdate);
        }
        
        return view('admin.assign_category',compact('vendors_category', 'vendors_restaurant'));
    }
    
    public function change_category_status(Request $request){
        $restaurant = Restaruant::where('id', $request->restaurant_id)->first();
        if(empty($restaurant)) {
            return response()->json(['status'=>400, 'msg'=>'The Restaurant is not exist in firebase']);
        }
        $old_app_id = $request->restaurant_vendorId;
        $firestore = app('firebase.firestore');
        $collection = $firestore->database()->collection('restaurants');
        $snapshot = $collection->documents();
        $vendors_restaurant = [];
        foreach ($snapshot as $item) {
            $itemWithId = $item->data();
            $itemUpdate['vendor_id'] = $item->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            array_push($vendors_restaurant, $itemUpdate);
        }
        $cuisine_type = [];
        for($i = 0; $i < count($vendors_restaurant); $i ++)
        {
            if($vendors_restaurant[$i]['id'] == $request->restaurant_vendorId)
            {
                for($j = 0; $j < count($request->category_status); $j ++)
                {
                    if($request->category_status[$j]['status'] == "true")
                        $cuisine_type[$request->category_status[$j]['category_title']] = true;
                    else
                        $cuisine_type[$request->category_status[$j]['category_title']] = false;
                    // array_push($cuisine_type, $temp_category);
                }
                break;
            }
        }
        
        // if($request->status == "true")
        //     $cuisine_type[$request->category_title] = true;
        // else
        //     $cuisine_type[$request->category_title] = false;
            
        if($restaurant['app_id'] != null){
            $ref = $firestore->database()->collection('restaurants');
            $res = $ref->document($restaurant['app_id']);
            $res->delete();
        }
        
        $prefer_orders = [];
        $prefer_infos = [];

        if($restaurant['prefer_order'] != null){
            $prefer_orders = explode(', ',$restaurant['prefer_order']);
            $prefer_infos = explode(',',$restaurant['order_info']);
        }

        if($restaurant['relay_key']) {
            $delivery_radius = '2';
        }
        else{
            if($restaurant['deliveryradius'] > 5){
                $delivery_radius = '5';
            }
            else if($restaurant['deliveryradius'] < 0) {
                $delivery_radius = '0';
            }
            else
            {
                $delivery_radius = $restaurant['deliveryradius'];
            }
        }
        if($restaurant['delivery'] == "false"){
            $delivery = 0;
        }
        else{
            $delivery = 2.5;
        }
        $data = [
            'name' => $restaurant['name'],
            'title' => $restaurant['name'],
            'webUrl' => $restaurant['weburl'],
            'pricing' => $restaurant['price'],
            'description' => $restaurant['brief'],
            'detail_description' => $restaurant['detail'],
            'photo' => $restaurant['logo'],
            'email'=>'',
            'pref_contact_methods' => $prefer_orders,
            'pref_contact_info' => $prefer_infos,
            'relay_key' => $restaurant['relay_key'],
            'relay_site' => $restaurant['relay_site'],
            'fax' => $restaurant['fax'],
            'phone' => $restaurant['phone'],
            'address' => $restaurant['address1'],
            'city' => $restaurant['city'],
            'createdAt' => $restaurant['created_at'],
            'delivery' => $delivery,
            'deliveryRadius' => $delivery_radius,
            'google' => $restaurant['google'],
            'twitter' => $restaurant['twitter'],
            'facebook' => $restaurant['facebook'],
            'instagram' => $restaurant['instagram'],
            'pinterest' => $restaurant['pinterest'],
            'youtube' => $restaurant['youtube'],
            'latitude' => $restaurant['latitude'],
            'longitude' => $restaurant['longitude'],
            'postalCode' => $restaurant['postalcode'],
            'prep_min' => $restaurant['prep_time'],
            'restaurantOwnerName' => '',
            'reviewsCount' => '0',
            'reviewsSum' => '0',
            'state' => $restaurant['state'],
            'filters' => [
                'Cuisine' => 'All',
                'Free Wi-Fi'=> 'Yes',
                'Good for Breakfast' => 'All',
                'Good for Dinner' => 'Yes',
                'Good for Lunch' => 'Yes',
                'Live Music' => 'All',
                'Outdoor Seating' => 'Yes',
                'Price' => $restaurant['price'],
                'Take Reservations' => 'All',
                'Vegetarian Friendly' => 'All',
            ],

            'cuisine_type' => $cuisine_type,
            'environment' => [
                'seat' => $restaurant['seat'],
                'max_group' => $restaurant['max_group'],
                'smoke' => $restaurant['smoke']=="on"?true:false,
                'catering' => $restaurant['catering']=="on"?true:false,
                'delivery_fee' =>$restaurant['delivery_fee'],
                'relay_id' => $restaurant['relay_key'],

                'pets' => $restaurant['pets']=="on"?true:false,
                'reservations' => $restaurant['reservation']=="on"?true:false,
                'delivery' => $restaurant['delivery']=="on"?true:false,
                'takeout' => $restaurant['takeout']=="on"?true:false,
                'vegetarian' => $restaurant['vegetarian']=="on"?true:false,
                'wheelchair' => $restaurant['wheelchair']=="on"?true:false,
            ],
            'location' => [
                'address2' => $restaurant['address2'],
                'latitude' => $restaurant['latitude'],
                'longitude' => $restaurant['longitude'],
            ],
            'operation_info' => [
                'monday' => [$restaurant['monday']=="on"?true:false,$restaurant['mon_open'],$restaurant['mon_close']],
                'tuesday' => [$restaurant['tuesday']=="on"?true:false,$restaurant['tue_open'],$restaurant['tue_close']],
                'wednesday' => [$restaurant['wednesday']=="on"?true:false,$restaurant['wed_open'],$restaurant['wed_close']],
                'thursday' => [$restaurant['thursday']=="on"?true:false,$restaurant['thu_open'],$restaurant['thu_close']],
                'friday' => [$restaurant['friday']=="on"?true:false,$restaurant['fri_open'],$restaurant['fri_close']],
                'saturday' => [$restaurant['saturday']=="on"?true:false,$restaurant['sat_open'],$restaurant['sat_close']],
                'sunday' => [$restaurant['sunday']=="on"?true:false,$restaurant['sun_open'],$restaurant['sun_close']],
            ],
            'status' => '1',
            'status' => $restaurant['status'],
            'id' => '',
        ];
        $ref = $firestore->database()->collection('restaurants');
        $refs = $ref->newDocument();

        $data['id'] = $refs->id();
        $restaurant['app_id'] = $refs->id();
        $refs->set($data);

        $menus = Menu::where('restaurant_id','=',$restaurant['id'])->get();
        foreach($menus as $menu){
            $menu_ref = $ref->document($refs->id())->collection('restaurant_menu');
            $temp_menu = [
                'name' => $menu['name'],
                'description' => $menu['description'],
                'notes' => $menu['note'],
                'duration' => $menu['duration'],
                'start_time' => $menu['start'],
                'end_time' => $menu['end'],
                'createdAt' => $menu['created_at'],
                'restaurant_id' => $refs->id(),
                'id' => '',
            ];

            $newmenu = $menu_ref->newDocument();
            $temp_menu['id'] = $newmenu->id();
            $newmenu->set($temp_menu);

            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $section_ref = $menu_ref->document($newmenu->id())->collection('menu_section');
                $temp_section = [
                    'name' => $section['name'],
                    'description' => $section['description'],
                    'orderNumber' => $section['orderNumber'],
                    'createdAt' => $section['created_at'],
                    'id'=>'',
                    'menu_id' =>'',
                ];

                $newsection = $section_ref->newDocument();
                $temp_section['id'] = $newsection->id();
                $temp_section['menu_id'] = $newmenu->id();
                $newsection->set($temp_section);

                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $item_ref = $section_ref->document($newsection->id())->collection('menu_item');
                    
                    $temp_item = [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'photo' => $item['photo'],
                        'vegetarian' => $item['vegetarian']=="true"?true:false,
                        'vegan' => $item['vegan']=="true"?true:false,
                        'kosher' => $item['kosher']=="true"?true:false,
                        'halal' => $item['halal']=="true"?true:false,
                        'gluten' => $item['gluten']=="true"?true:false,
                        'alcohol' => $item['alcohol']=="true"?true:false,
                        'id' => '',
                        'section_id' =>'',
                        'menu_id' => $newmenu->id(),
                        'restaurant_id' => $refs->id(),
                        'createdAt' => $item['created_at'],
                        'sizeRequired' => '',
                        'sizeWithPrice' => [],
                        'extraOption' => [],
                    ];

                    $newitem = $item_ref->newDocument();
                    $temp_item['id'] = $newitem->id();
                    $temp_item['section_id'] = $newsection->id();


                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                            
                        if($optiongroup['name'] == 'Size' || $optiongroup['name'] == 'size'){
                            $temp_item['sizeRequired'] = true;

                            $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                            foreach($options as $option){
                                $temp_option = [
                                    'size' => $option['name'],
                                    'price' => $option['value'],
                                ];
                                array_push($temp_item['sizeWithPrice'], $temp_option);
                            }
                        }
                        else{
                            $temp_val = 0;
                            if($optiongroup['style'] == 0)
                                $temp_val = 'checkbox';
                            else if($optiongroup['style'] == 1)
                                $temp_val = 'quantity';
                            else if($optiongroup['style'] == 2)
                                $temp_val = 'radio';
                            $temp_group = [
                                'title' => $optiongroup['name'],
                                'description' => '',
                                'required' => false,
                                'type' => $temp_val,
                                'trigger' => $optiongroup['trigger'],
                                'data' => [],
                            ];

                            $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                            foreach($options as $option){
                                $temp_option = [
                                    'tag' => $option['name'],
                                    'price' => $option['value'],
                                ];
                                array_push($temp_group['data'], $temp_option);
                            }
                            array_push($temp_item['extraOption'], $temp_group);

                        }

                    }
                    if($temp_item['sizeWithPrice'] == null)
                        $temp_item['sizeRequired'] = false;
                    $newitem->set($temp_item);
                }
            }
        }
        $restaurant->save();
        $new_id = $restaurant['app_id'];
        return response()->json(['status'=>200, 'result'=>$new_id]);
    }
    
    public function bulk_change_category_status(Request $request){
        $data = $request->data;
        $result = array();
        foreach($data as $row) {
            if(!isset($row['restaurant_id'])) {
                return response()->json([
                    'status'=>400,
                    'msg'=>'The Restaurant is not exist in firebase'
                    ]);
                return;
            }
            $restaurant = Restaruant::where('id', $row['restaurant_id'])->first();
            if(empty($restaurant)) {
                return response()->json([
                    'status'=>400,
                    'msg'=>'The Restaurant is not exist in firebase'
                    ]);
            }
            $old_app_id = $row['restaurant_vendorId'];
            $firestore = app('firebase.firestore');
            $collection = $firestore->database()->collection('restaurants');
            $snapshot = $collection->documents();
            $vendors_restaurant = [];
            foreach ($snapshot as $item) {
                $itemWithId = $item->data();
                $itemUpdate['vendor_id'] = $item->id();
                foreach ($itemWithId as $key => $value) {
                    $itemUpdate[$key] = $value;
                }
                array_push($vendors_restaurant, $itemUpdate);
            }
            $cuisine_type = [];
            for($i = 0; $i < count($vendors_restaurant); $i ++)
            {
                if($vendors_restaurant[$i]['id'] == $row['restaurant_vendorId'])
                {
                    for($j = 0; $j < count($row['category_status']); $j ++)
                    {
                        if($row['category_status'][$j]['status'] == "true")
                            $cuisine_type[$row['category_status'][$j]['category_title']] = true;
                        else
                            $cuisine_type[$row['category_status'][$j]['category_title']] = false;
                    }
                    break;
                }
            }
            
            if($restaurant['app_id'] != null){
                $ref = $firestore->database()->collection('restaurants');
                $res = $ref->document($restaurant['app_id']);
                $res->delete();
            }
            
            $prefer_orders = [];
            $prefer_infos = [];
    
            if($restaurant['prefer_order'] != null){
                $prefer_orders = explode(', ',$restaurant['prefer_order']);
                $prefer_infos = explode(',',$restaurant['order_info']);
            }
    
            if($restaurant['relay_key']) {
                $delivery_radius = '2';
            }
            else{
                if($restaurant['deliveryradius'] > 5){
                    $delivery_radius = '5';
                }
                else if($restaurant['deliveryradius'] < 0) {
                    $delivery_radius = '0';
                }
                else
                {
                    $delivery_radius = $restaurant['deliveryradius'];
                }
            }
            if($restaurant['delivery'] == "false"){
                $delivery = 0;
            }
            else{
                $delivery = 2.5;
            }
            $data = [
                'name' => $restaurant['name'],
                'title' => $restaurant['name'],
                'webUrl' => $restaurant['weburl'],
                'pricing' => $restaurant['price'],
                'description' => $restaurant['brief'],
                'detail_description' => $restaurant['detail'],
                'photo' => $restaurant['logo'],
                'email'=>'',
                'pref_contact_methods' => $prefer_orders,
                'pref_contact_info' => $prefer_infos,
                'relay_key' => $restaurant['relay_key'],
                'relay_site' => $restaurant['relay_site'],
                'fax' => $restaurant['fax'],
                'phone' => $restaurant['phone'],
                'address' => $restaurant['address1'],
                'city' => $restaurant['city'],
                'createdAt' => $restaurant['created_at'],
                'delivery' => $delivery,
                'deliveryRadius' => $delivery_radius,
                'google' => $restaurant['google'],
                'twitter' => $restaurant['twitter'],
                'facebook' => $restaurant['facebook'],
                'instagram' => $restaurant['instagram'],
                'pinterest' => $restaurant['pinterest'],
                'youtube' => $restaurant['youtube'],
                'latitude' => $restaurant['latitude'],
                'longitude' => $restaurant['longitude'],
                'postalCode' => $restaurant['postalcode'],
                'prep_min' => $restaurant['prep_time'],
                'restaurantOwnerName' => '',
                'reviewsCount' => '0',
                'reviewsSum' => '0',
                'state' => $restaurant['state'],
                'filters' => [
                    'Cuisine' => 'All',
                    'Free Wi-Fi'=> 'Yes',
                    'Good for Breakfast' => 'All',
                    'Good for Dinner' => 'Yes',
                    'Good for Lunch' => 'Yes',
                    'Live Music' => 'All',
                    'Outdoor Seating' => 'Yes',
                    'Price' => $restaurant['price'],
                    'Take Reservations' => 'All',
                    'Vegetarian Friendly' => 'All',
                ],
    
                'cuisine_type' => $cuisine_type,
                'environment' => [
                    'seat' => $restaurant['seat'],
                    'max_group' => $restaurant['max_group'],
                    'smoke' => $restaurant['smoke']=="on"?true:false,
                    'catering' => $restaurant['catering']=="on"?true:false,
                    'delivery_fee' =>$restaurant['delivery_fee'],
                    'relay_id' => $restaurant['relay_key'],
    
                    'pets' => $restaurant['pets']=="on"?true:false,
                    'reservations' => $restaurant['reservation']=="on"?true:false,
                    'delivery' => $restaurant['delivery']=="on"?true:false,
                    'takeout' => $restaurant['takeout']=="on"?true:false,
                    'vegetarian' => $restaurant['vegetarian']=="on"?true:false,
                    'wheelchair' => $restaurant['wheelchair']=="on"?true:false,
                ],
                'location' => [
                    'address2' => $restaurant['address2'],
                    'latitude' => $restaurant['latitude'],
                    'longitude' => $restaurant['longitude'],
                ],
                'operation_info' => [
                    'monday' => [$restaurant['monday']=="on"?true:false,$restaurant['mon_open'],$restaurant['mon_close']],
                    'tuesday' => [$restaurant['tuesday']=="on"?true:false,$restaurant['tue_open'],$restaurant['tue_close']],
                    'wednesday' => [$restaurant['wednesday']=="on"?true:false,$restaurant['wed_open'],$restaurant['wed_close']],
                    'thursday' => [$restaurant['thursday']=="on"?true:false,$restaurant['thu_open'],$restaurant['thu_close']],
                    'friday' => [$restaurant['friday']=="on"?true:false,$restaurant['fri_open'],$restaurant['fri_close']],
                    'saturday' => [$restaurant['saturday']=="on"?true:false,$restaurant['sat_open'],$restaurant['sat_close']],
                    'sunday' => [$restaurant['sunday']=="on"?true:false,$restaurant['sun_open'],$restaurant['sun_close']],
                ],
                'status' => '1',
                'status' => $restaurant['status'],
                'id' => '',
            ];
            $ref = $firestore->database()->collection('restaurants');
            $refs = $ref->newDocument();
    
            $data['id'] = $refs->id();
            $restaurant['app_id'] = $refs->id();
            $refs->set($data);
    
            $menus = Menu::where('restaurant_id','=',$restaurant['id'])->get();
            foreach($menus as $menu){
                $menu_ref = $ref->document($refs->id())->collection('restaurant_menu');
                $temp_menu = [
                    'name' => $menu['name'],
                    'description' => $menu['description'],
                    'notes' => $menu['note'],
                    'duration' => $menu['duration'],
                    'start_time' => $menu['start'],
                    'end_time' => $menu['end'],
                    'createdAt' => $menu['created_at'],
                    'restaurant_id' => $refs->id(),
                    'id' => '',
                ];
    
                $newmenu = $menu_ref->newDocument();
                $temp_menu['id'] = $newmenu->id();
                $newmenu->set($temp_menu);
    
                $sections = Section::where('menu_id','=',$menu['id'])->get();
                foreach($sections as $section){
                    $section_ref = $menu_ref->document($newmenu->id())->collection('menu_section');
                    $temp_section = [
                        'name' => $section['name'],
                        'description' => $section['description'],
                        'orderNumber' => $section['orderNumber'],
                        'createdAt' => $section['created_at'],
                        'id'=>'',
                        'menu_id' =>'',
                    ];
    
                    $newsection = $section_ref->newDocument();
                    $temp_section['id'] = $newsection->id();
                    $temp_section['menu_id'] = $newmenu->id();
                    $newsection->set($temp_section);
    
                    $items = Menuitem::where('section_id','=',$section['id'])->get();
                    foreach($items as $item){
                        $item_ref = $section_ref->document($newsection->id())->collection('menu_item');
                        
                        $temp_item = [
                            'name' => $item['name'],
                            'description' => $item['description'],
                            'price' => $item['price'],
                            'photo' => $item['photo'],
                            'vegetarian' => $item['vegetarian']=="true"?true:false,
                            'vegan' => $item['vegan']=="true"?true:false,
                            'kosher' => $item['kosher']=="true"?true:false,
                            'halal' => $item['halal']=="true"?true:false,
                            'gluten' => $item['gluten']=="true"?true:false,
                            'alcohol' => $item['alcohol']=="true"?true:false,
                            'id' => '',
                            'section_id' =>'',
                            'menu_id' => $newmenu->id(),
                            'restaurant_id' => $refs->id(),
                            'createdAt' => $item['created_at'],
                            'sizeRequired' => '',
                            'sizeWithPrice' => [],
                            'extraOption' => [],
                        ];
    
                        $newitem = $item_ref->newDocument();
                        $temp_item['id'] = $newitem->id();
                        $temp_item['section_id'] = $newsection->id();
    
    
                        $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                        foreach($optiongroups as $optiongroup){
                                
                            if($optiongroup['name'] == 'Size' || $optiongroup['name'] == 'size'){
                                $temp_item['sizeRequired'] = true;
    
                                $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                                foreach($options as $option){
                                    $temp_option = [
                                        'size' => $option['name'],
                                        'price' => $option['value'],
                                    ];
                                    array_push($temp_item['sizeWithPrice'], $temp_option);
                                }
                            }
                            else{
                                $temp_val = 0;
                                if($optiongroup['style'] == 0)
                                    $temp_val = 'checkbox';
                                else if($optiongroup['style'] == 1)
                                    $temp_val = 'quantity';
                                else if($optiongroup['style'] == 2)
                                    $temp_val = 'radio';
                                $temp_group = [
                                    'title' => $optiongroup['name'],
                                    'description' => '',
                                    'required' => false,
                                    'type' => $temp_val,
                                    'trigger' => $optiongroup['trigger'],
                                    'data' => [],
                                ];
    
                                $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                                foreach($options as $option){
                                    $temp_option = [
                                        'tag' => $option['name'],
                                        'price' => $option['value'],
                                    ];
                                    array_push($temp_group['data'], $temp_option);
                                }
                                array_push($temp_item['extraOption'], $temp_group);
    
                            }
    
                        }
                        if($temp_item['sizeWithPrice'] == null)
                            $temp_item['sizeRequired'] = false;
                        $newitem->set($temp_item);
                    }
                }
            }
            $restaurant->save();
            $new_id = $restaurant['app_id'];
            $result[] = $new_id;
        }
        return response()->json(['status'=> 200, 'result'=>$result]);
    }

    public function datatables() {
        // $datas = Category::orderBy('id','asc')->get();
        $firestore = app('firebase.firestore');
        $collection = $firestore->database()->collection('vendor_categories');
        $snapshot = $collection->documents();
        $vendors_category = [];
        $vendors_restaurant = [];
        
        foreach ($snapshot as $item) {
            $itemWithId = $item->data();
            $itemUpdate['vendor_id'] = $item->id();
            foreach ($itemWithId as $key => $value) {
                $itemUpdate[$key] = $value;
            }
            array_push($vendors_category, $itemUpdate);
        }
        
        //--- Integrating This Collection Into Datatables
        return Datatables::of($vendors_category)
           ->editColumn('title', function($data) {
               $title = mb_strlen(strip_tags($data['title']),'utf-8') > 50 ? mb_substr(strip_tags($data['title']),0,50,'utf-8').'...' : strip_tags($data['title']);
               return $title;
           })
           ->editColumn('photo', function($data) {
               $photo = mb_strlen(strip_tags($data['photo']),'utf-8') > 50 ? mb_substr(strip_tags($data['photo']),0,50,'utf-8').'...' : strip_tags($data['photo']);
               return  $photo;
           })
           ->editColumn('order', function($data) {
               return  $data['order'];
           })
           ->addColumn('action', function($data) {
               return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-category-edit',$data['id']) . '"> <i class="fas fa-edit"></i> Edit</a><a href="javascript:;" data-href="' . route('admin-category-delete',$data['id']) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
           })
           ->rawColumns(['title', 'status', 'action'])
           ->toJson(); //--- Returning Json Data To Client Side
    }

    public function edit($id){
        $firestore = app('firebase.firestore');
        $ref = $firestore->database()->collection('vendor_categories')->document($id);
        $snapshot = $frankRef->snapshot();   
        $data = $snapshot->data();
     
        return view('admin.edit_cat',compact('data'));
    }

    public function create(Request $request) {
        $res['title'] = $request['title'];
        $res['photo'] = $request['photo'];
        $res['order'] = $request['order'];

        $firestore = app('firebase.firestore');
        $ref = $firestore->database()->collection('vendor_categories');
        $new = $ref->newDocument();
        $res['id'] = $new->id();
        $new->set($res);

        $msg = 'Category Created Successfully.<a href="'.route('admin-categories').'">View Category Lists.</a>';
        return response()->json($msg);
    }

    public function update(Request $request, $id){
        $firestore = app('firebase.firestore');
        $ref = $firestore->database()->collection('vendor_categories')->document($id);
        
        $data['id'] = $id;

        $data['title'] = $request['title'];
        $data['photo'] = $request['photo'];
        $data['order'] = $request['order'];

        $refs->set($data);
        $msg = 'Category Updated Successfully.<a href="'.route('admin-categories').'">View Category Lists.</a>';
        return response()->json($msg);
    }

    public function resdelete($id){
        $firestore = app('firebase.firestore');
        $ref = $firestore->database()->collection('vendor_categories')->document($id);
        $ref->delete();
        $msg = 'Category Deleted Successfully.';
        return response()->json($msg);
    }
}