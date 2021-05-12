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


class AdminRestaruantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    // index page of restaurants
    public function index(){

        $res = Restaruant::get();

        return view('admin.restaruants');
    }


    // Redirect for creating a new restaurant page
    public function append(){

        return view('admin.register_res');
    }


    // Ajax with datatable
    public function datatables()
    {
         $datas = Restaruant::orderBy('id','asc')->get();

         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
            ->editColumn('name', function(Restaruant $data) {
                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                return $name;
            })
            ->editColumn('address', function(Restaruant $data) {
                $address = mb_strlen(strip_tags($data->address1),'utf-8') > 50 ? mb_substr(strip_tags($data->address1),0,50,'utf-8').'...' : strip_tags($data->address1);
                return  $address;
            })
            ->editColumn('phone', function(Restaruant $data) {
                return  $data->phone;
            })
            ->addColumn('status', function(Restaruant $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-restaruant-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><<option data-val="0" value="'. route('admin-restaruant-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
            })
            ->addColumn('action', function(Restaruant $data) {
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-restaruant-editmenus',$data->id) . '"> <i class="fas fa-list"></i> Menus</a><a href="' . route('admin-restaruant-cagegory',$data->id) . '"> <i class="fas fa-list"></i> Categories</a><a href="' . route('admin-restaruant-edit',$data->id) . '"> <i class="fas fa-edit"></i> Edit</a><a href="' . route('admin-restaruant-clone',$data->id) . '"><i class="fas fa-exchange-alt"></i> Clone</a><a href="javascript:;" data-href="' . route('admin-restaruant-transferapp',$data->id) . '" data-toggle="modal" data-target="#confirm-transfer" class="transfer"><i class="fas fa-exchange-alt"></i> Transfer</a><a href="' . route('admin-restaruant-image',$data->id) . '"><i class="fas fa-image"></i> Change Image</a><a href="javascript:;" data-href="' . route('admin-restaruant-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    // Delete particular restaurant
    public function resdelete($id){

        $data = Restaruant::findOrFail($id);

        $menus = Menu::where('restaurant_id','=',$id)->get();
        foreach($menus as $menu){
            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                        $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                        foreach($options as $option){
                            $option->delete();
                        }
                        $optiongroup->delete();
                    }
                    $item->delete();
                }
                $section->delete();
            }
            $menu->delete();
        }

        $data->delete();
        $msg = 'Restaurant Deleted Successfully.';
        return response()->json($msg);
    }

    // Activate the particular restaurnt's state
    public function status($id1, $id2){
        $data = Restaruant::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    // Integrating with another api
    public function search(Request $request){
        //$url = 'https://api.documenu.com/v2/restaurants/search/fields?'.$request->type.'='.$request->search.'&exact=true&key=92c4029090fe31556e4f1250fdbce70a';
        $key = 'ffa420dc-2a6b-11eb-a5f6-525400552a35';
        $str = $request->search;
        $url = 'https://openmenu.com/api/v2/search.php?key='.$key.'&s='.$str.'&country=US&city=New%20York';

        $response = Http::get($url);
        $result = json_decode($response->body());
        // dd($result->response->result->errors[0]);
        $value = $result->response->result;
        if ($value->errors){
            if($value->errors[0] == "call resulted in an empty resultset"){
                $msg = 'Found Result: 0';
                return redirect()->back()->with('nothing', [$msg]);
            }
        }

        return redirect()->back()->with('success', [$value->data]);
        // $value = json_decode($response->body());
        // dd($value->data[3])
        // if ($value->numResults == 0){
        //     $msg = 'Found Result: 0';
        //     return redirect()->back()->with('nothing', [$msg]);
        // }

        // return redirect()->back()->with('success', [$value->data]);
    }

    // 
    public function show_register($param,$id){
        if($param == 'null'){
            return view('admin.register_res');
        }
        $url = 'https://api.documenu.com/v2/restaurants/search/fields?restaurant_name='.$param.'&exact=true&key=92c4029090fe31556e4f1250fdbce70a';
        $response = Http::get($url);
        $value = json_decode($response->body());
        $ret = $value->data;

        foreach($ret as $val){
            if($val->restaurant_id == $id){
                return view('admin.register_res',compact('val'));
            }
        }
        dd("server error");

    }

    // redirect to the show menu
    public function show_menu(){
        return view('admin.menu');
    }

    // create a new restaurant into the sql database and redirect for editing menus
    public function register(Request $request){
        // $restaurant = new Restaruant();
        // $restaurant['name'] = $request->title;
        // $restaurant['address'] = $request->address;
        // $restaurant['phone'] = $request->phone;
        // $restaurant['status'] = 1;
        // $restaurant['created_at'] = \Carbon\Carbon::now()->toDateString();
        // $restaurant['updated_at'] = \Carbon\Carbon::now()->toDateString();
        // $restaurant->save();

        // $database = app('firebase.firestore');
        // $vendors = $database->collection('vendors');

        dd("sdfsdf");
    }
    
    
    // Integrating with another api
    public function results($id)
    {
        
        if($id != 0)
            $datas = Find::where('zipcode','=',$id)->orderBy('id','desc')->get();
        else
            $datas = Find::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
            ->editColumn('name', function(Find $data) {
                $name = mb_strlen(strip_tags($data->name),'utf-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'utf-8').'...' : strip_tags($data->name);
                return $name;
            })
            ->editColumn('zipcode', function(Find $data) {
                return $data->zipcode;
            })
            ->editColumn('address1', function(Find $data) {
                $address = mb_strlen(strip_tags($data->address1),'utf-8') > 50 ? mb_substr(strip_tags($data->address1),0,50,'utf-8').'...' : strip_tags($data->address1);
                return  $address;
            })
            ->editColumn('address2', function(Find $data) {
                $address = mb_strlen(strip_tags($data->address2),'utf-8') > 50 ? mb_substr(strip_tags($data->address2),0,50,'utf-8').'...' : strip_tags($data->address2);
                return  $address;
            })
            ->addColumn('phone', function(Find $data) {
                if($data->phone != null){
                    return  $data->phone;
                }
                return ' ';
                
            })
            ->addColumn('images', function(Find $data) {
                if($data->images != null)
                    return $data->images;
                return ' ';
            })
            ->addColumn('status', function(Find $data) {
                if($data->status != 0)
                    return 'yes';
                return 'no';
            })
            ->addColumn('action', function(Find $data) {
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a onclick= "dosearch()" href="' . route('admin-resphone-get',['id'=>$data->restaurant_id,'code'=>$data->zipcode]) . '" > <i class="fas fa-list"></i> Get Phone</a>
                <a onclick="dosearch()" href= "'. route('admin-restaurant-importview',['id'=>$data->restaurant_id,'code'=>$data->zipcode]) .'"><i class="fas fa-exchange-alt"></i> Import Datas</a></div></div>';
            })
            ->rawColumns(['name', 'phone', 'images','action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function phoneget($id, $code){
        
        $find = Find::where('restaurant_id','=',$id)->first();
        $key = 'ffa420dc-2a6b-11eb-a5f6-525400552a35';
        //$temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&country=US&postal_code='.$code.'&id='.$id;
        $temp_url = 'https://openmenu.com/api/v2/search.php?key='.$key.'&country=US&postal_code='.$code.'&s='.$find['name'];
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());

        $temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&id='.$temp_result->response->result->restaurants[0]->id;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        $temp_value = $temp_result->response->result;
        
        $find['phone'] = $temp_value->restaurant_info->phone;
        if(count($temp_value->menus[0]->menu_groups[0]->menu_items[0]->menu_item_images) != 0){
            $find['images'] = 'yes';
        }
        else
            $find['images'] = 'no';
        $find->update();
        return redirect()->back();
    }
    
    public function searchlocation(Request $request){
       
  
        if(Find::where('zipcode','=',$request->search)->exists()){
            $msg = 'Found Already';
            return redirect()->back()->with('found', [$request->search]);
        }

        ini_set('max_execution_time', 500);
        $key = 'ffa420dc-2a6b-11eb-a5f6-525400552a35';
        $str = $request->search;

        $url = 'https://openmenu.com/api/v2/location.php?key='.$key.'&country=US&postal_code='.$str.'&offset=0';

        $response = Http::get($url);
        $result = json_decode($response->body());

        if(!isset($result->response->result->errors)){
            $values = $result->response->result->restaurants;
            foreach($values as $value){

                $find = new Find();
                $find['name'] = $value->restaurant_name;
                $find['address1'] = $value->address_1;
                $find['address2'] = $value->address_2;
                $find['zipcode'] = $str;
                $find['restaurant_id'] = $value->id;
                $find->save();
            }
        }
        else{
            $msg = 'Found Result: 0';
            return redirect()->back()->with('nothing', [$msg]);
        }

        $i = 1;
        while($i<11){
            $url = 'https://openmenu.com/api/v2/location.php?key='.$key.'&country=US&postal_code='.$str.'&offset='.$i;

            $response = Http::get($url);
            $result = json_decode($response->body());
           
            if(!isset($result->response->result->errors)){
                $values = $result->response->result->restaurants;
                foreach($values as $value){
                  
                    $find = new Find();
                    $find['name'] = $value->restaurant_name;
                    $find['address1'] = $value->address_1;
                    $find['address2'] = $value->address_2;
                    $find['zipcode'] = $str;
                    $find['restaurant_id'] = $value->id;
                
                    $find->save();
                }
            }
            else
                break;
            $i++;
        }

        return redirect()->route('admin.view_restaruant',$str);
       
    }
    
    public function viewResults($id){
        $code = $id;
        return view('admin.results',compact('code'));
    }

    public function find(){
        return view('admin.find_res');
    }
    
    public function registermenu(Request $request){
        $res = new Restaruant();
        $res['name'] = $request->name;
        $res['weburl'] = $request->weburl;
        $res['address1'] = $request->address1;
        $res['address2'] = $request->address2;
        $res['city'] = $request->city;
        $res['state'] = $request->state;
        $res['postalcode'] = $request->postalcode;
        $res['phone'] = $request->phone;
        $res['fax'] = $request->fax;
        $res['facebook'] = $request->facebook;
        $res['twitter'] = $request->twitter;
        $res['instagram'] = $request->instagram;
        $res['pinterest'] = $request->pinterest;
        $res['youtube'] = $request->youtube;
        $res['google'] = $request->google;
        $res['brief'] = $request->brief;
        $res['detail'] = $request->detail;
        $res['logo'] = $request->logo;
  
        $res['price'] = $request->price;
        $res['cuisine'] = $request->cuisine;
        $res['deliveryradius'] = $request->deliveryradius;
        $res['maxgroup'] = $request->maxgroup;
        $res['smoke'] = $request->smoke;
        $res['pets'] = $request->pets;
        $res['seat'] = $request->seat;
        $res['takeout'] = $request->takeout;
        $res['reservation'] = $request->reservation;
        $res['wheelchair'] = $request->wheelchair;
        $res['delivery'] = $request->delivery;
        $res['vegetarian'] = $request->vegetarian;

        // $res['burgurs'] = $request->burgurs;
        // $res['sushi'] = $request->sushi;
        // $res['ramen'] = $request->ramen;
        // $res['barfood'] = $request->barfood;
        // $res['breakfast'] = $request->breakfast;
        // $res['italian'] = $request->italian;
        // $res['japanese'] = $request->japanese;
        // $res['newmexican'] = $request->newmexican;
        // $res['sandwiches'] = $request->sandwiches;
        // $res['mediterranean'] = $request->mediterranean;

        $res['monday'] = $request->monday;
        $res['mon_open'] = $request->mon_open;
        $res['mon_close'] = $request->mon_close;
        $res['tuesday'] = $request->tuesday;
        $res['tue_open'] = $request->tue_open;
        $res['tue_close'] = $request->tue_close;
        $res['wednesday'] = $request->wednesday;
        $res['wed_open'] = $request->wed_open;
        $res['wed_close'] = $request->wed_close;
        $res['thursday'] = $request->thursday;
        $res['thu_open'] = $request->thu_open;
        $res['thu_close'] = $request->thu_close;
        $res['friday'] = $request->friday;
        $res['fri_open'] = $request->fri_open;
        $res['fri_close'] = $request->fri_close;
        $res['saturday'] = $request->saturday;
        $res['sat_open'] = $request->sat_open;
        $res['sat_close'] = $request->sat_close;
        $res['sunday'] = $request->sunday;
        $res['sun_open'] = $request->sun_open;
        $res['sun_close'] = $request->sun_close;
        
        // $res['relay_id'] = $request->relay_id;
        
        $res['relay_key'] = $request->relay_key;
        $res['relay_site'] = $request->relay_site;

        $res['toast_id'] = $request->toast_id;
        $res['toast_secret'] = $request->toast_secret;
        $res['toast_token'] = $request->toast_token;
        
        $res['prep_time'] = $request->preptime;

        
        $prefer_order = '';
        $prefer_contact = '';
        
        if(isset($request->orderTypes)) {
            foreach($request->orderContent as $index => $val) {
                $prefer_contact .= $val.',';
                $prefer_order.= $request->orderTypes[$index].', ';
            }
        }
        
        // $prefer_order = '';
        // $prefer_contact = '';
        
        // if(isset($request->prefer_order) && $request->prefer_order != null){
        //     foreach($request->prefer_order as $val){
        //         $prefer_order.=$val.',';
        //         if($val == "Fax" && $request->order_fax!='')
        //             $prefer_contact.=$request->order_fax.',';
        //         else if($val == "Email" && $request->order_email!='')
        //             $prefer_contact.=$request->order_email.',';
        //         else if($val == "Text" && $request->order_text!='')
        //             $prefer_contact.=$request->order_text.',';
        //     }
        // }

        $res['prefer_order'] = $prefer_order!=''?substr($prefer_order,0,-1):'';
        $res['order_info'] = $prefer_contact!=''?substr($prefer_contact,0,-1):'';
        $res['delivery_fee'] = $request->delivery_fee;

        $res['writer'] = Auth::guard('admin')->user()->name;
        $res['status'] = '1';
        
        $key = 'AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY';
        $temp_url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.$request->address1.' '.$request->city.' '.$request->postalcode;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        if($temp_result->status == "OK"){
            $temp_value = $temp_result->results;
            $res['latitude'] = $temp_value[0]->geometry->location->lat;
            $res['longitude'] = $temp_value[0]->geometry->location->lng;
        }
        
        $res->save();
        $id = $res['id'];
        return redirect()->route('admin.view_registermenu',$id);
    }


    public function viewregistermenu($id){
        $menu_datas = [];
        $menus = Menu::where('restaurant_id','=',$id)->get();
        $menu_count = 0;
        $section_count = 0;
        $item_count = 0;
        $option_count = 0;
        $suboption_count = 0;

        foreach($menus as $menu){
            $temp_menu = [
                'name' => $menu['name'],
                'description' => $menu['description'],
                'note' => $menu['note'],
                'duration' => $menu['duration'],
                'start' => $menu['start'],
                'end' => $menu['end'],
                'menu_group' => [],
                'id'=> $menu_count,
                'menu_id' => $menu['id'],
                'group_count' => 0,
            ];
            $menu_count++;
            $section_count = 0;
            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $temp_section = [
                    'name' => $section['name'],
                    'description' => $section['description'],
                    'orderNumber' => $section['orderNumber'],
                    'menu_items' => [],
                    'id' => $section_count,
                    'item_count' => 0,
                    'section_id' => $section->id,
                ];
                $section_count++;
                $item_count = 0;
                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $temp_item = [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                       
                        'vegetarian' => $item['vegetarian']=="true"?'true':'false',
                        'vegan' => $item['vegan']=="true"?'true':'false',
                        'kosher' => $item['kosher']=="true"?'true':'false',
                        'halal' => $item['halal']=="true"?'true':'false',
                        'gluten' => $item['gluten']=="true"?'true':'false',
                        'alcohol' => $item['alcohol']=="true"?'true':'false',
                        'menu_item_options' => [],
                        'id' => $item_count,
                        'option_count' => 0,
                        'item_id' => $item->id
                    ];
                    $item_count++;
                    $option_count = 0;
                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                        $temp_group = [
                            'name' => $optiongroup['name'],
                            'type' => $optiongroup['style'],
                            'menu_option_options' => [],
                            'suboption_count' => 0,
                            'id' => $option_count,
                            'optiongroup_id' => $optiongroup->id,
                        ];
                        $option_count++;
                        $suboption_count = 0;
                        $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                        foreach($options as $option){
                            $temp_option = [
                                'name' => $option['name'],
                                'value' => $option['value'],
                                'id' => $suboption_count,
                                'option_id' => $option->id,
                            ];
                            $suboption_count++;
                            array_push($temp_group['menu_option_options'], $temp_option);
                        }
                        $temp_group['suboption_count'] = $suboption_count;
                        array_push($temp_item['menu_item_options'], $temp_group);
                    }
                    $temp_item['option_count'] = $option_count;
                    array_push($temp_section['menu_items'], $temp_item);
                }
                $temp_section['item_count'] = $item_count;
                array_push($temp_menu['menu_group'], $temp_section);
            }
            $temp_menu['group_count'] = $section_count;
            array_push($menu_datas, $temp_menu);
        }
        return view('admin.register_menu',compact('menu_datas','id','menu_count'));
    }

    public function savemenu(Request $request){
        //dd("sdfsd");
        
        foreach($request->data as $menu_val){
            if($menu_val != null){
                $menu = new Menu();
                $menu['name'] = $menu_val['name'];
                $menu['restaurant_id'] = $request->id;
                $menu['description'] = $menu_val['description'];
                $menu['note'] = $menu_val['note'];
                $menu['duration'] = $menu_val['duration'];
                $menu['start'] = $menu_val['start'];
                $menu['end'] = $menu_val['end'];
                $menu->save();
                $menuid = $menu['id'];
                
                if(isset($menu_val['menu_group'])){
                    foreach($menu_val['menu_group'] as $section_val){
                        if($section_val != null){
                            $section = new Section();
                            $section['menu_id'] = $menuid;
                            $section['name'] = $section_val['name'];
                            $section['description'] = $section_val['description'];
                            $section['orderNumber'] = $section_val['orderNumber'];
                           
                            $section->save();
                            $sectionid = $section['id'];

                            if(isset($section_val['menu_items'])){
                                foreach($section_val['menu_items'] as $item_val){
                                    if($item_val != null){
                                        $item = new Menuitem();
                                        $item['section_id'] = $sectionid;
                                        $item['name'] = $item_val['name'];
                                        $item['description'] = $item_val['description'];
                                        $item['price'] = $item_val['price'];
                                       
                                        $item['vegetarian'] = $item_val['vegetarian'];
                                        $item['vegan'] = $item_val['vegan'];
                                        $item['kosher'] = $item_val['kosher'];
                                        $item['halal'] = $item_val['halal'];
                                        $item['gluten'] = $item_val['gluten'];
                                        $item['alcohol'] = $item_val['alcohol'];
                                       
                                        $item['image'] = $item_val['image'];
                                        $item->save();
                                        $itemid = $item['id'];

                                        if(isset($item_val['menu_item_options'])){
                                            foreach($item_val['menu_item_options'] as $option_val){
                                                if($option_val != null){
                                                    $option = new Itemoption();
                                                    $option['item_id'] = $itemid;
                                                    $option['name'] = $option_val['name'];
                                                    $option['style'] = $option_val['type'];
                                                    $option->save();
                                                    
                                                    $optionid = $option['id'];

                                                    if(isset($option_val['menu_option_options'])){
                                                        foreach($option_val['menu_option_options'] as $suboption_val){
                                                            if($suboption_val != null){
                                                                $suboption = new Suboption();
                                                                $suboption['option_id'] = $optionid;

                                                                $suboption['name'] = $suboption_val['name'];
                                                                $suboption['value'] = $suboption_val['value'];
                                                                $suboption->save();
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }            
        }
        
        //$val = $request->data[0];
        //return response()->json(['result'=>'aaa']);
        return redirect()->route('admin.restaruant');
    }
    
    public function edit($id){
        $data = Restaruant::findOrFail($id);
        $preferOrderType = array();
        
        $methods = explode(', ', $data->prefer_order);
        $infos = explode(',',$data->order_info);
        foreach ($methods as $key=>$each) {
            $temp_order = [
                'orderMethod' => $each,
                'orderInfo' => $infos[$key]
            ];
            array_push($preferOrderType, $temp_order);
        }
        
        // $fax = "";
        // $email = "";
        // $text = "";

        // if($data->prefer_order != null){
        //     $methods = explode(',',$data->prefer_order);
        //     $infos = explode(',',$data->order_info);

        //     $i = 0;
        //     foreach($methods as $method){
        //         if($method == 'Fax'){
        //             $fax = $infos[$i];
        //         }
        //         else if($method == 'Email'){
        //             $email = $infos[$i];
        //         }
        //         else if($method == 'Text'){
        //             $text = $infos[$i];
        //         }
        //         $i++;
        //     }
        // }
        return view('admin.edit_res',compact('preferOrderType','data'));
    }

    public function update(Request $request, $id){
        $res = Restaruant::where('id','=',$id)->first();
        $res['name'] = $request->name;
        $res['weburl'] = $request->weburl;
        $res['address1'] = $request->address1;
        $res['address2'] = $request->address2;
        $res['city'] = $request->city;
        $res['state'] = $request->state;
        $res['postalcode'] = $request->postalcode;
        $res['phone'] = $request->phone;
        $res['fax'] = $request->fax;
        $res['facebook'] = $request->facebook;
        $res['twitter'] = $request->twitter;
        $res['instagram'] = $request->instagram;
        $res['pinterest'] = $request->pinterest;
        $res['youtube'] = $request->youtube;
        $res['google'] = $request->google;
        $res['brief'] = $request->brief;
        $res['detail'] = $request->detail;
        $res['logo'] = $request->logo;
   
        $res['price'] = $request->price;
        $res['cuisine'] = $request->cuisine;
        $res['deliveryradius'] = $request->deliveryradius;
        $res['maxgroup'] = $request->maxgroup;
        $res['smoke'] = $request->smoke;
        $res['pets'] = $request->pets;
        $res['seat'] = $request->seat;
        $res['takeout'] = $request->takeout;
        $res['reservation'] = $request->reservation;
        $res['wheelchair'] = $request->wheelchair;
        $res['delivery'] = $request->delivery;
        $res['vegetarian'] = $request->vegetarian;

        // $res['bakery'] = $request->bakery;
        // $res['bbq'] = $request->bbq;
        // $res['coffee_tea'] = $request->coffee_tea;
        // $res['comfort_food'] = $request->comfort_food;
        // $res['icecream'] = $request->icecream;
        // $res['mexican'] = $request->mexican;
        // $res['pizza'] = $request->pizza;
        // $res['steakhouse'] = $request->steakhouse;

        $res['monday'] = $request->monday;
        $res['mon_open'] = $request->mon_open;
        $res['mon_close'] = $request->mon_close;
        $res['tuesday'] = $request->tuesday;
        $res['tue_open'] = $request->tue_open;
        $res['tue_close'] = $request->tue_close;
        $res['wednesday'] = $request->wednesday;
        $res['wed_open'] = $request->wed_open;
        $res['wed_close'] = $request->wed_close;
        $res['thursday'] = $request->thursday;
        $res['thu_open'] = $request->thu_open;
        $res['thu_close'] = $request->thu_close;
        $res['friday'] = $request->friday;
        $res['fri_open'] = $request->fri_open;
        $res['fri_close'] = $request->fri_close;
        $res['saturday'] = $request->saturday;
        $res['sat_open'] = $request->sat_open;
        $res['sat_close'] = $request->sat_close;
        $res['sunday'] = $request->sunday;
        $res['sun_open'] = $request->sun_open;
        $res['sun_close'] = $request->sun_close;
        
        //$res['relay_id'] = $request->relay_id;
        
        $res['relay_key'] = $request->relay_key;
        $res['relay_site'] = $request->relay_site;
        
        $res['toast_id'] = $request->toast_id;
        $res['toast_secret'] = $request->toast_secret;
        $res['toast_token'] = $request->toast_token;
        
        $res['prep_time'] = $request->preptime;
        
        
        $prefer_order = '';
        $prefer_contact = '';
        
        if(isset($request->orderTypes)) {
            foreach($request->orderContent as $index => $val) {
                $prefer_contact .= $val.',';
                $prefer_order.= $request->orderTypes[$index].', ';
            }
        }
        
        //dd($request->all());
        
        
        // $prefer_order = '';
        // $prefer_contact = '';
        // if(isset($request->prefer_order) && $request->prefer_order != null){
        //     foreach($request->prefer_order as $val){
        //         $prefer_order.=$val.',';
        //         if($val == "Fax" && $request->order_fax!='')
        //             $prefer_contact.=$request->order_fax.',';
        //         else if($val == "Email" && $request->order_email!='')
        //             $prefer_contact.=$request->order_email.',';
        //         else if($val == "Text" && $request->order_text!='')
        //             $prefer_contact.=$request->order_text.',';
        //     }
        // }

        $res['prefer_order'] = $prefer_order!=''?substr($prefer_order,0,-1):'';
        $res['order_info'] = $prefer_contact!=''?substr($prefer_contact,0,-1):'';
        $res['delivery_fee'] = $request->delivery_fee;

        
        $res['status'] = '1';
        
        $key = 'AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY';
        $temp_url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.$request->address1.' '.$request->city.' '.$request->postalcode;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        if($temp_result->status == "OK"){
            $temp_value = $temp_result->results;
            $res['latitude'] = $temp_value[0]->geometry->location->lat;
            $res['longitude'] = $temp_value[0]->geometry->location->lng;
        }
        
        
        $res->save();
        

        $msg = 'Restaurant Updated Successfully.<a href="'.route('admin.restaruant').'">View Restaurant Lists.</a>';
        return response()->json($msg);
    }
    
    public function editmenu($id){

        $menu_datas = [];
        $menus = Menu::where('restaurant_id','=',$id)->get();
        $menu_count = 0;
        $section_count = 0;
        $item_count = 0;
        $option_count = 0;
        $suboption_count = 0;

        foreach($menus as $menu){
            $temp_menu = [
                'name' => $menu['name'],
                'description' => $menu['description'],
                'note' => $menu['note'],
                'duration' => $menu['duration'],
                'start' => $menu['start'],
                'end' => $menu['end'],
                'menu_group' => [],
                'id'=> $menu_count,
                'menu_id' => $menu['id'],
                'group_count' => 0,
            ];
            $menu_count++;
            $section_count = 0;
            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $temp_section = [
                    'name' => $section['name'],
                    'description' => $section['description'],
                    'orderNumber' => $section['orderNumber'],
                    'menu_items' => [],
                    'id' => $section_count,
                    'item_count' => 0,
                    'section_id' => $section->id,
                ];
                $section_count++;
                $item_count = 0;
                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $temp_item = [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                       
                        'vegetarian' => $item['vegetarian']=="true"?'true':'false',
                        'vegan' => $item['vegan']=="true"?'true':'false',
                        'kosher' => $item['kosher']=="true"?'true':'false',
                        'halal' => $item['halal']=="true"?'true':'false',
                        'gluten' => $item['gluten']=="true"?'true':'false',
                        'alcohol' => $item['alcohol']=="true"?'true':'false',
                        'menu_item_options' => [],
                        'id' => $item_count,
                        'option_count' => 0,
                        'item_id' => $item->id
                    ];
                    $item_count++;
                    $option_count = 0;
                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                        $temp_group = [
                            'name' => $optiongroup['name'],
                            'type' => $optiongroup['style'],
                            'trigger' => $optiongroup['trigger'],
                            'menu_option_options' => [],
                            'suboption_count' => 0,
                            'id' => $option_count,
                            'optiongroup_id' => $optiongroup->id,
                        ];
                        $option_count++;
                        $suboption_count = 0;
                        $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                        foreach($options as $option){
                            $temp_option = [
                                'name' => $option['name'],
                                'value' => $option['value'],
                                'id' => $suboption_count,
                                'option_id' => $option->id,
                            ];
                            $suboption_count++;
                            array_push($temp_group['menu_option_options'], $temp_option);
                        }
                        $temp_group['suboption_count'] = $suboption_count;
                        array_push($temp_item['menu_item_options'], $temp_group);
                    }
                    $temp_item['option_count'] = $option_count;
                    array_push($temp_section['menu_items'], $temp_item);
                }
                $temp_section['item_count'] = $item_count;
                array_push($temp_menu['menu_group'], $temp_section);
            }
            $temp_menu['group_count'] = $section_count;
            array_push($menu_datas, $temp_menu);
        }
        return view('admin.edit_menu',compact('menu_datas','id','menu_count'));

    }
    
    public function updatemenu(Request $request){

        $menus = Menu::where('restaurant_id','=',$request->id)->get();
        foreach($menus as $menu){
            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                        $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                        foreach($options as $option){
                            $option->delete();
                        }
                        $optiongroup->delete();
                    }
                    $item->delete();
                }
                $section->delete();
            }
            $menu->delete();
        }


        foreach($request->data as $menu_val){
            if($menu_val != null){
                $menu = new Menu();
                $menu['name'] = $menu_val['name'];
                $menu['restaurant_id'] = $request->id;
                $menu['description'] = $menu_val['description'];
                $menu['note'] = $menu_val['note'];
                $menu['duration'] = $menu_val['duration'];
                $menu['start'] = $menu_val['start'];
                $menu['end'] = $menu_val['end'];
                $menu->save();
                $menuid = $menu['id'];

                if(isset($menu_val['menu_group'])){
                    foreach($menu_val['menu_group'] as $section_val){
                        if($section_val != null){
                            $section = new Section();
                            $section['menu_id'] = $menuid;
                            $section['name'] = $section_val['name'];
                            $section['description'] = $section_val['description'];
                            $section['orderNumber'] = $section_val['orderNumber'];
                            $section->save();
                            $sectionid = $section['id'];

                            if(isset($section_val['menu_items'])){
                                foreach($section_val['menu_items'] as $item_val){
                                    if($item_val != null){
                                        $item = new Menuitem();
                                        $item['section_id'] = $sectionid;
                                        $item['name'] = $item_val['name'];
                                        $item['description'] = $item_val['description'];
                                        $item['price'] = $item_val['price'];
                                      
                                        $item['vegetarian'] = $item_val['vegetarian'];
                                        $item['vegan'] = $item_val['vegan'];
                                        $item['kosher'] = $item_val['kosher'];
                                        $item['halal'] = $item_val['halal'];
                                        $item['gluten'] = $item_val['gluten'];
                                        $item['alcohol'] = $item_val['alcohol'];
                                       
                                        $item['image'] = $item_val['image'];
                                        $item->save();
                                        $itemid = $item['id'];

                                        if(isset($item_val['menu_item_options'])){
                                            foreach($item_val['menu_item_options'] as $option_val){
                                                if($option_val != null){
                                                    $option = new Itemoption();
                                                    $option['item_id'] = $itemid;
                                                    $option['name'] = $option_val['name'];
                                                    $option['style'] = $option_val['type'];
                                                    $option->save();

                                                    $optionid = $option['id'];

                                                    if(isset($option_val['menu_option_options'])){
                                                        foreach($option_val['menu_option_options'] as $suboption_val){
                                                            if($suboption_val != null){
                                                                $suboption = new Suboption();
                                                                $suboption['option_id'] = $optionid;

                                                                $suboption['name'] = $suboption_val['name'];
                                                                
                                                                $suboption['value'] = $suboption_val['value'];
                                                                $suboption->save();
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        //$val = $request->data[0];
        //return response()->json(['result'=>'aaa']);
        return redirect()->route('admin.restaruant');
    }
    
    public function importview($id, $code){
        //dd("sdfsdf");
        //return redirect()->route('admin.restaruant');
        $find = Find::where('restaurant_id','=',$id)->first();
        $key = 'ffa420dc-2a6b-11eb-a5f6-525400552a35';
        //$temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&country=US&postal_code='.$code.'&id='.$id;
        // $temp_url = 'https://openmenu.com/api/v2/search.php?key='.$key.'&country=US&postal_code='.$code.'&s='.$find['name'];
        // $temp_response = Http::get($temp_url);
        // $temp_result = json_decode($temp_response->body());

        $temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&id='.$id;//$temp_result->response->result->restaurants[0]->id;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        $res_info = $temp_result->response->result;


        return view('admin.importres', compact('res_info','id','code'));
    }
    
    public function importmenu(Request $request, $id, $code){
        $res = new Restaruant();
        $res['name'] = $request->name;
        $res['weburl'] = $request->weburl;
        $res['address1'] = $request->address1;
        $res['address2'] = $request->address2;
        $res['city'] = $request->city;
        $res['state'] = $request->state;
        $res['postalcode'] = $request->postalcode;
        $res['phone'] = $request->phone;
        $res['fax'] = $request->fax;
        $res['facebook'] = $request->facebook;
        $res['twitter'] = $request->twitter;
        $res['instagram'] = $request->instagram;
        $res['pinterest'] = $request->pinterest;
        $res['youtube'] = $request->youtube;
        $res['google'] = $request->google;
        $res['brief'] = $request->brief;
        $res['detail'] = $request->detail;
        $res['logo'] = $request->logo;
    
        $res['price'] = $request->price;
        $res['cuisine'] = $request->cuisine;
        $res['deliveryradius'] = $request->deliveryradius;
        $res['maxgroup'] = $request->maxgroup;
        $res['smoke'] = $request->smoke;
        $res['pets'] = $request->pets;
        $res['seat'] = $request->seat;
        $res['takeout'] = $request->takeout;
        $res['reservation'] = $request->reservation;
        $res['wheelchair'] = $request->wheelchair;
        $res['delivery'] = $request->delivery;
        $res['vegetarian'] = $request->vegetarian;

        // $res['burgurs'] = $request->burgurs;
        // $res['sushi'] = $request->sushi;
        // $res['ramen'] = $request->ramen;
        // $res['barfood'] = $request->barfood;
        // $res['breakfast'] = $request->breakfast;
        // $res['italian'] = $request->italian;
        // $res['japanese'] = $request->japanese;
        // $res['newmexican'] = $request->newmexican;
        // $res['sandwiches'] = $request->sandwiches;
        // $res['mediterranean'] = $request->mediterranean;

        $res['monday'] = $request->monday;
        $res['mon_open'] = $request->mon_open;
        $res['mon_close'] = $request->mon_close;
        $res['tuesday'] = $request->tuesday;
        $res['tue_open'] = $request->tue_open;
        $res['tue_close'] = $request->tue_close;
        $res['wednesday'] = $request->wednesday;
        $res['wed_open'] = $request->wed_open;
        $res['wed_close'] = $request->wed_close;
        $res['thursday'] = $request->thursday;
        $res['thu_open'] = $request->thu_open;
        $res['thu_close'] = $request->thu_close;
        $res['friday'] = $request->friday;
        $res['fri_open'] = $request->fri_open;
        $res['fri_close'] = $request->fri_close;
        $res['saturday'] = $request->saturday;
        $res['sat_open'] = $request->sat_open;
        $res['sat_close'] = $request->sat_close;
        $res['sunday'] = $request->sunday;
        $res['sun_open'] = $request->sun_open;
        $res['sun_close'] = $request->sun_close;
        
        $res['relay_id'] = $request->relay_id;
        $res['prep_time'] = $request->preptime;
        $prefer_order = '';
        $prefer_contact = '';
        if(isset($request->prefer_order) && $request->prefer_order != null){
            foreach($request->prefer_order as $val){
                $prefer_order.=$val.',';
                if($val == "Fax" && $request->order_fax!='')
                    $prefer_contact.=$request->order_fax.',';
                else if($val == "Email" && $request->order_email!='')
                    $prefer_contact.=$request->order_email.',';
                else if($val == "Text" && $request->order_text!='')
                    $prefer_contact.=$request->order_text.',';
            }
        }

        $res['prefer_order'] = $prefer_order!=''?substr($prefer_order,0,-1):'';
        $res['order_info'] = $prefer_contact!=''?substr($prefer_contact,0,-1):'';
        $res['delivery_fee'] = $request->delivery_fee;

        $res['writer'] = Auth::guard('admin')->user()->name;
        $res['status'] = '1';
        
        $key = 'AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY';
        $temp_url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.$request->address1.' '.$request->city.' '.$request->postalcode;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        if($temp_result->status == "OK"){
            $temp_value = $temp_result->results;
            $res['latitude'] = $temp_value[0]->geometry->location->lat;
            $res['longitude'] = $temp_value[0]->geometry->location->lng;
        }
        
        $res->save();
        $res_id = $res['id'];
        return redirect()->route('admin.view_importmenu',['resid'=>$res_id, 'id'=>$id, 'code'=>$code]);
    }
    
    public function viewimportmenu($resid, $id, $code){
        $find = Find::where('restaurant_id','=',$id)->first();
        $find['status'] = 1;
        $find->save();

        $key = 'ffa420dc-2a6b-11eb-a5f6-525400552a35';
        //$temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&country=US&postal_code='.$code.'&id='.$id;
        // $temp_url = 'https://openmenu.com/api/v2/search.php?key='.$key.'&country=US&postal_code='.$code.'&s='.$find['name'];
        // $temp_response = Http::get($temp_url);
        // $temp_result = json_decode($temp_response->body());

        $temp_url = 'https://openmenu.com/api/v2/restaurant.php?key='.$key.'&id='.$id;//.$temp_result->response->result->restaurants[0]->id;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        $menu_info = $temp_result->response->result->menus;

        $menu_datas = array();

        $menu_count = 0;
        $section_count = 0;
        $item_count = 0;

        foreach($menu_info as $menu){
            $temp_menu = [
                'name' => $menu->menu_name,
                'description' => $menu->menu_description,
                'note' => $menu->menu_note,
                'duration' => $menu->menu_duration_name,
                'start' => $menu->menu_duration_time_start,
                'end' => $menu->menu_duration_time_end,
                'menu_group' => [],
                'id'=> $menu_count,
                'group_count' => 0,
            ];
            $menu_count++;
            $section_count = 0;
            foreach($menu->menu_groups as $section){
                $temp_section = [
                    'name' => $section->group_name,
                    'description' => $section->group_description,
                    'menu_items' => [],
                    'id' => $section_count,
                    'item_count' => 0,
                ];
                $section_count++;
                $item_count = 0;
                foreach($section->menu_items as $item){
                    $temp_item = [
                        'name' => $item->menu_item_name,
                        'description' => $item->menu_item_description,
                        'price' => $item->menu_item_price,
                        'image' => ' ',
                        'vegetarian' => $item->vegetarian==null?'false':'true',
                        'vegan' => $item->vegan==null?'false':'true',
                        'kosher' => $item->kosher==null?'false':'true',
                        'halal' => $item->halal==null?'false':'true',
                        'gluten' => $item->gluten_free==null?'false':'true',
                        'alcohol' => $item->alcohol==null?'false':'true',
                        'menu_item_options' => [],
                        'id' => $item_count,
                        'option_count' => 0,
                    ];
                    $item_count++;
                    array_push($temp_section['menu_items'], $temp_item);
                }
                $temp_section['item_count'] = $item_count;
                array_push($temp_menu['menu_group'], $temp_section);
            }
            $temp_menu['group_count'] = $section_count;
            array_push($menu_datas, $temp_menu);
        }

        return view('admin.import_menu',compact('resid','menu_datas','menu_count'));
    }


    // this is the function of clone restaurant
    public function clonemenu(Request $request, $id){
        $res = new Restaruant();
        $res['name'] = $request->name;
        $res['weburl'] = $request->weburl;
        $res['address1'] = $request->address1;
        $res['address2'] = $request->address2;
        $res['city'] = $request->city;
        $res['state'] = $request->state;
        $res['postalcode'] = $request->postalcode;
        $res['phone'] = $request->phone;
        $res['fax'] = $request->fax;
        $res['facebook'] = $request->facebook;
        $res['twitter'] = $request->twitter;
        $res['instagram'] = $request->instagram;
        $res['pinterest'] = $request->pinterest;
        $res['youtube'] = $request->youtube;
        $res['google'] = $request->google;
        $res['brief'] = $request->brief;
        $res['detail'] = $request->detail;
        $res['logo'] = $request->logo;
      
        $res['price'] = $request->price;
        $res['cuisine'] = $request->cuisine;
        $res['deliveryradius'] = $request->deliveryradius;
        $res['maxgroup'] = $request->maxgroup;
        $res['smoke'] = $request->smoke;
        $res['pets'] = $request->pets;
        $res['seat'] = $request->seat;
        $res['takeout'] = $request->takeout;
        $res['reservation'] = $request->reservation;
        $res['wheelchair'] = $request->wheelchair;
        $res['delivery'] = $request->delivery;
        $res['vegetarian'] = $request->vegetarian;

        // $res['burgurs'] = $request->burgurs;
        // $res['sushi'] = $request->sushi;
        // $res['ramen'] = $request->ramen;
        // $res['barfood'] = $request->barfood;
        // $res['breakfast'] = $request->breakfast;
        // $res['italian'] = $request->italian;
        // $res['japanese'] = $request->japanese;
        // $res['newmexican'] = $request->newmexican;
        // $res['sandwiches'] = $request->sandwiches;
        // $res['mediterranean'] = $request->mediterranean;

        $res['monday'] = $request->monday;
        $res['mon_open'] = $request->mon_open;
        $res['mon_close'] = $request->mon_close;
        $res['tuesday'] = $request->tuesday;
        $res['tue_open'] = $request->tue_open;
        $res['tue_close'] = $request->tue_close;
        $res['wednesday'] = $request->wednesday;
        $res['wed_open'] = $request->wed_open;
        $res['wed_close'] = $request->wed_close;
        $res['thursday'] = $request->thursday;
        $res['thu_open'] = $request->thu_open;
        $res['thu_close'] = $request->thu_close;
        $res['friday'] = $request->friday;
        $res['fri_open'] = $request->fri_open;
        $res['fri_close'] = $request->fri_close;
        $res['saturday'] = $request->saturday;
        $res['sat_open'] = $request->sat_open;
        $res['sat_close'] = $request->sat_close;
        $res['sunday'] = $request->sunday;
        $res['sun_open'] = $request->sun_open;
        $res['sun_close'] = $request->sun_close;
        
        
        //$res['relay_id'] = $request->relay_id;
        
        $res['relay_key'] = $request->relay_key;
        $res['relay_site'] = $request->relay_site;
        
        $res['prep_time'] = $request->preptime;
        
        $prefer_order = '';
        $prefer_contact = '';
        
        if(isset($request->orderTypes)) {
            foreach($request->orderContent as $index => $val) {
                $prefer_contact .= $val.', ';
                $prefer_order.= $request->orderTypes[$index].', ';
            }
        }
        
        $res['prefer_order'] = $prefer_order!=''?substr($prefer_order,0,-1):'';
        $res['order_info'] = $prefer_contact!=''?substr($prefer_contact,0,-1):'';
        $res['delivery_fee'] = $request->delivery_fee;

        $res['writer'] = Auth::guard('admin')->user()->name;
        $res['status'] = '1';
        
        $key = 'AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY';
        $temp_url = 'https://maps.googleapis.com/maps/api/geocode/json?key='.$key.'&address='.$request->address1.' '.$request->city.' '.$request->postalcode;
        $temp_response = Http::get($temp_url);
        $temp_result = json_decode($temp_response->body());
        if($temp_result->status == "OK"){
            $temp_value = $temp_result->results;
            $res['latitude'] = $temp_value[0]->geometry->location->lat;
            $res['longitude'] = $temp_value[0]->geometry->location->lng;
        }
        
        $res->save();
         
        $res_id = $res['id'];
       
        return redirect()->route('admin.view_clonemenu',['id'=>$id, 'res_id'=>$res_id]);
    }

    public function viewclonemenu($id,$res_id){
        $menu_datas = [];
        
        $menus = Menu::where('restaurant_id','=',$id)->get();
        
        $menu_count = 0;
        $section_count = 0;
        $item_count = 0;
        $option_count = 0;
        $suboption_count = 0;

        foreach($menus as $menu){
            $temp_menu = [
                'name' => $menu['name'],
                'description' => $menu['description'],
                'note' => $menu['note'],
                'duration' => $menu['duration'],
                'start' => $menu['start'],
                'end' => $menu['end'],
                'menu_group' => [],
                'id'=> $menu_count,
                'group_count' => 0,
            ];
            $menu_count++;
            $section_count = 0;
            $sections = Section::where('menu_id','=',$menu['id'])->get();
            foreach($sections as $section){
                $temp_section = [
                    'name' => $section['name'],
                    'description' => $section['description'],
                    'orderNumber' => $section['orderNumber'],
                    'menu_items' => [],
                    'id' => $section_count,
                    'item_count' => 0,
                ];
                $section_count++;
                $item_count = 0;
                $items = Menuitem::where('section_id','=',$section['id'])->get();
                foreach($items as $item){
                    $temp_item = [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                        'vegetarian' => $item['vegetarian']=="true"?'true':'false',
                        'vegan' => $item['vegan']=="true"?'true':'false',
                        'kosher' => $item['kosher']=="true"?'true':'false',
                        'halal' => $item['halal']=="true"?'true':'false',
                        'gluten' => $item['gluten']=="true"?'true':'false',
                        'alcohol' => $item['alcohol']=="true"?'true':'false',
                        'menu_item_options' => [],
                        'id' => $item_count,
                        'option_count' => 0,
                    ];
                    $item_count++;
                    $option_count = 0;
                    $optiongroups = Itemoption::where('item_id','=',$item['id'])->get();
                    foreach($optiongroups as $optiongroup){
                        $temp_group = [
                            'name' => $optiongroup['name'],
                            'type' => $optiongroup['style'],
                            'trigger' => $optiongroup['trigger'],
                            'menu_option_options' => [],
                            'suboption_count' => 0,
                            'id' => $option_count,
                        ];
                        $option_count++;
                        $suboption_count = 0;
                        $options = Suboption::where('option_id','=',$optiongroup['id'])->get();
                        foreach($options as $option){
                            $temp_option = [
                                'name' => $option['name'],
                                'value' => $option['value'],
                                'id' => $suboption_count,
                            ];
                            $suboption_count++;
                            array_push($temp_group['menu_option_options'], $temp_option);
                        }
                        $temp_group['suboption_count'] = $suboption_count;
                        array_push($temp_item['menu_item_options'], $temp_group);
                    }
                    $temp_item['option_count'] = $option_count;
                    array_push($temp_section['menu_items'], $temp_item);
                }
                $temp_section['item_count'] = $item_count;
                array_push($temp_menu['menu_group'], $temp_section);
            }
            $temp_menu['group_count'] = $section_count;
            array_push($menu_datas, $temp_menu);
        }
        return view('admin.clone_menu',compact('menu_datas','res_id','menu_count'));

    }


    public function clonemenusave(Request $request){

        foreach($request->data as $menu_val){
            if($menu_val != null){
                $menu = new Menu();
                $menu['name'] = $menu_val['name'];
                $menu['restaurant_id'] = $request->id;
                $menu['description'] = $menu_val['description'];
                $menu['note'] = $menu_val['note'];
                $menu['duration'] = $menu_val['duration'];
                $menu['start'] = $menu_val['start'];
                $menu['end'] = $menu_val['end'];
                $menu->save();
                $menuid = $menu['id'];

                if(isset($menu_val['menu_group'])){
                    foreach($menu_val['menu_group'] as $section_val){
                        if($section_val != null){
                            $section = new Section();
                            $section['menu_id'] = $menuid;
                            $section['name'] = $section_val['name'];
                            $section['description'] = $section_val['description'];
                            $section['orderNumber'] = $section_val['orderNumber'];
                            $section->save();
                            $sectionid = $section['id'];

                            if(isset($section_val['menu_items'])){
                                foreach($section_val['menu_items'] as $item_val){
                                    if($item_val != null){
                                        $item = new Menuitem();
                                        $item['section_id'] = $sectionid;
                                        $item['name'] = $item_val['name'];
                                        $item['description'] = $item_val['description'];
                                        $item['price'] = $item_val['price'];

                                        $item['vegetarian'] = $item_val['vegetarian'];
                                        $item['vegan'] = $item_val['vegan'];
                                        $item['kosher'] = $item_val['kosher'];
                                        $item['halal'] = $item_val['halal'];
                                        $item['gluten'] = $item_val['gluten'];
                                        $item['alcohol'] = $item_val['alcohol'];

                                        $item['image'] = $item_val['image'];
                                        $item->save();
                                        $itemid = $item['id'];

                                        if(isset($item_val['menu_item_options'])){
                                            foreach($item_val['menu_item_options'] as $option_val){
                                                if($option_val != null){
                                                    $option = new Itemoption();
                                                    $option['item_id'] = $itemid;
                                                    $option['name'] = $option_val['name'];
                                                    $option['style'] = $option_val['type'];
                                                    if($option_val['trigger'] == "")
                                                        $optoin['trigger'] = 0;
                                                    else
                                                        $option['trigger'] = intval($option_val['trigger']);
                                                    $option->save();

                                                    $optionid = $option['id'];

                                                    if(isset($option_val['menu_option_options'])){
                                                        foreach($option_val['menu_option_options'] as $suboption_val){
                                                            if($suboption_val != null){
                                                                $suboption = new Suboption();
                                                                $suboption['option_id'] = $optionid;
                                                                $suboption['name'] = $suboption_val['name'];
                                                                $suboption['value'] = $suboption_val['value'];
                                                                $suboption->save();
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        //$val = $request->data[0];
        //return response()->json(['result'=>'aaa']);
        return redirect()->route('admin.restaruant');
    }

    public function clone($id){
        
        $data = Restaruant::findOrFail($id);
        $preferOrderType = array();
        
        $methods = explode(', ', $data->prefer_order);
        $infos = explode(',',$data->order_info);
        foreach ($methods as $key=>$each) {
            $temp_order = [
                'orderMethod' => $each,
                'orderInfo' => $infos[$key]
            ];
            array_push($preferOrderType, $temp_order);
        }
        return view('admin.clone_res',compact('preferOrderType','data'));
    }



    public function findstr(){
        
        $firestore = app('firebase.firestore');
        $refs = $firestore->database()->collection('restaurants');
        
        $documents = $refs->documents();
        foreach ($documents as $document) {
            if ($document->exists()) {
                $frankRef = $refs->document($document->id());
                $snapshot = $frankRef->snapshot();
                if(Restaruant::where('name','=',$snapshot->data()['name'])->where('address1','=',$snapshot->data()['address'])->exists()){
                    $restaurant = Restaruant::where('name','=',$snapshot->data()['name'])->where('address1','=',$snapshot->data()['address'])->first();
                
                $restaurant['app_id'] = $document->id();
                $restaurant->save();    
                }
                
            }
        }
        dd("success");
        // $rangeQuery = $refs->where('price', 'in', ['2:00']);
        // foreach ($rangeQuery->documents() as $document) {
        // dd($document->id());
        // }
    }
    
    public function showimage($id){
        $restaurant = Restaruant::findOrFail($id);

        return view('admin.showimage',compact('restaurant'));
    }

    public function changeimage(Request $request, $id){
        
        
        $restaurant = Restaruant::findOrFail($id);
        $firestore = app('firebase.firestore');
        
        if($restaurant['app_id'] == null){
            $msg = 'This restaurant is not registered in firestore.';
            return response()->json($msg);
        }

        $image = $request->newimage;
        
        if($image != null){
        
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            $name = str_replace(' ', '', $restaurant->name);
            $image_name = $name.time().Str::random(8).'.png';
            $path = '../public/img/restaurants/Clients/logo/'.$image_name;
            file_put_contents($path, $image);
            $urls = 'http://orderchekout.com/public/img/restaurants/Clients/logo/'.$image_name;
            $restaurant['logo'] = $urls;
            
            $refs = $firestore->database()->collection('restaurants');
            $res = $refs->document($restaurant['app_id']);
            $snapshot = $res->snapshot();
            $res->update([
                ['path' => 'photo', 'value' => $urls],
            ]);
        
        }
        
        $image = $request->bannerimage;
        
        if($image != null){
            list($type, $image) = explode(';', $image);
            list(, $image)      = explode(',', $image);
            $image = base64_decode($image);
            
            $path = '../public/img/restaurants/Clients/banner/'.$image_name;
            file_put_contents($path, $image);
        }
        
        
        $restaurant->save();
        return redirect()->route('admin.restaruant');
    }
    
    public function firedelete($id){
    
    	if(!Auth::guard('admin')->user()->IsSuper()){
    		$msg = "failed";
        	return response()->json($msg);
    	}
    
    	$restaurant = Restaruant::where('id','=',$id)->first();
        $firestore = app('firebase.firestore');
        
        $refs = $firestore->database()->collection('Restaurants');
        $menu_ref = $firestore->database()->collection('Restaurants_menus');
        $section_ref = $firestore->database()->collection('Restaurants_sections');
        $item_ref = $firestore->database()->collection('Restaurants_items');
        $group_ref = $firestore->database()->collection('Restaurants_optiongroups');
        $option_ref = $firestore->database()->collection('Restaurants_options');
        
        if($restaurant['firestore_id'] != null){
	
		$res = $refs->document($restaurant['firestore_id']);
		
		$menu_queries = $menu_ref->where('restaurant_id','==',$restaurant['firestore_id']);
		foreach($menu_queries->documents() as $menu_doc){
			$menu_id = $menu_doc->id();
			$section_queries = $section_ref->where('menu_id','==',$menu_id);
			foreach($section_queries->documents() as $section_doc){
				$section_id = $section_doc->id();    		
				$item_queries = $item_ref->where('section_id','==',$section_id);
				foreach($item_queries->documents() as $item_doc){
					$item_id = $item_doc->id();
					$group_queries = $group_ref->where('item_id','==',$item_id);
					foreach($group_queries->documents() as $group_doc){
						$group_id = $group_doc->id();
						$option_queries = $option_ref->where('group_id','==',$group_id);
						foreach($option_queries->documents() as $option_doc){
							$option_id = $option_doc->id();
							$option_ref->document($option_id)->delete();
						}
						$group_ref->document($group_id)->delete();
					}
					$item_ref->document($item_id)->delete();
				}
				$section_ref->document($section_id)->delete();
			}
			$menu_ref->document($menu_id)->delete();
		}
		$res->delete();
        }
        $restaurant['firestore_id'] = null;
        $restaurant->save();
            $msg = "success";
            return response()->json($msg);
    }
    
    
    public function recoverOneRestaurant() {
        $firestore = app('firebase.firestore');
        $res = $firestore->database()->collection('restaurants')->document("c4833c99d111418bbb5c");
        
        $menus = $res->collection('restaurant_menu')->documents();
        
        foreach ($menus as $menu) {
            $menudb = new Menu();

            $menudb['name']           = $menu->data()['name'];
            $menudb['description']    = $menu->data()['description'];
            $menudb['note']           = $menu->data()['notes'];
            $menudb['duration']       = $menu->data()['duration'];
            $menudb['start']          = $menu->data()['start_time'];
            $menudb['end']            = $menu->data()['end_time'];
            $menudb['restaurant_id']  = 22;
            $menudb->save();
            
            $sections = $firestore->database()->collection('restaurants')->document("c4833c99d111418bbb5c")->collection('restaurant_menu')->document($menu->id())->collection('menu_section')->documents();
            foreach ($sections as $section) {
                $sectiondb = new Section();
                $sectiondb['menu_id']         = $menudb->id;
                $sectiondb['name']            = $section->data()['name'];
                $sectiondb['description']     = $section->data()['description'];
                // $sectiondb['orderNumber']     = $section->data()['orderNumber'];
                $sectiondb->save();
                
                $items = $firestore->database()->collection('restaurants')->document("c4833c99d111418bbb5c")->collection('restaurant_menu')->document($menu->id())->collection('menu_section')->document($section->id())->collection('menu_item')->documents();
                foreach ($items as $item) {
                    $itemdb = new Menuitem();
                    $itemdb['section_id']         = $sectiondb->id;
                    $itemdb['name']               = $item->data()['name'];
                    $itemdb['description']        = $item->data()['description'];
                    $itemdb['price']              = $item->data()['price'];
                    $itemdb['vegetarian']         = $item->data()['vegetarian'] ? 'true' : 'false';
                    $itemdb['vegan']              = $item->data()['vegan'] ? 'true' : 'false';
                    $itemdb['kosher']             = $item->data()['kosher'] ? 'true' : 'false';
                    $itemdb['halal']              = $item->data()['halal'] ? 'true' : 'false';
                    $itemdb['gluten']             = $item->data()['gluten'] ? 'true' : 'false';
                    // $itemdb['alcohol']            = $item->data()['alcohol'];
                    $itemdb['image']              = $item->data()['photo'];
                    $itemdb->save();
                }
            }
        }
    }
    
    public function sendToApp($id){
        if(!Auth::guard('admin')->user()->IsSuper()){
    		$msg = "failed";
        	return response()->json($msg);
    	}
        $restaurant = Restaruant::where('id','=',$id)->first();
        $firestore = app('firebase.firestore');
        
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

            // 'cuisine_type' => [
            //     'Bakery' => $restaurant['bakery']=="on"?true:false,
            //     'BBQ' => $restaurant['bbq']=="on"?true:false,
            //     'Coffee & Tea' => $restaurant['coffee_tea']=="on"?true:false,
            //     'Comfort Food' => $restaurant['comfort_food']=="on"?true:false,
            //     'Ice Cream' => $restaurant['icecream']=="on"?true:false,
            //     'Mexican' => $restaurant['mexican']=="on"?true:false,
            //     'Pizza' => $restaurant['pizza']=="on"?true:false,
            //     'Steakhouse' => $restaurant['steakhouse']=="on"?true:false,
            // ],
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

        $menus = Menu::where('restaurant_id','=',$id)->get();
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
                        'photo' => $item['image'],
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

        $msg = "success";
        return response()->json($msg);
    }
    public function saveItems(){
        $menuItem = Menuitem::all();
        $firestore = app('firebase.firestore');
        
        
        foreach($menuItem as $item){
            $section = Section::where('id', $item->section_id)->first();
            if($section)
            {
                $menu = Menu::where('id', $section->menu_id)->first();
                if($menu)
                {
                    $restaurant = Restaruant::where('id', $menu->restaurant_id)->first();
                    if($restaurant){
                        $restaurant_id = $restaurant->app_id; 
                        $ref = $firestore->database()->collection('restaurants');
                        $res = $ref->document($restaurant_id);
                        $ref = $res->collection('restaurant_menu');
                        
                    }
                }
            }
            
        }
        
        $ref = $firestore->database()->collection('items');
        $refs = $ref->newDocument();

        
        $data = [
            'item_id' => 'asdf',
            'menu_id' => 'asdf',
            'name' => 'teste item',
            'restaurant_id' => '11111111',
            'section_id' => '2222222222',
        ];
        
        $data['id'] = $refs->id();
        // $restaurant['app_id'] = $refs->id();
        $refs->set($data);
        
        $msg = "success";
        return response()->json($msg);
    }
}
