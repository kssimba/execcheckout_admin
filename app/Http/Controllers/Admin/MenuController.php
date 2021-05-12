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


class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    


    // create menu and store the db
    public function createMenu(Request $request) {
        $menu = new Menu();
        $menu['name']           = $request['data']['name'];
        $menu['description']    = $request['data']['description'];
        $menu['note']           = $request['data']['note'];
        $menu['duration']       = $request['data']['duration'];
        $menu['start']          = $request['data']['start'];
        $menu['end']            = $request['data']['end'];
        $menu['restaurant_id']  = $request['id'];
        $menu->save();
        // return json('success', [$menu->id]);
        return response()->json(['id'=> $menu->id ]);
    }

    // update menu and update the db
    public function updateMenu(Request $request) {
        $menu = Menu::find($request->id);
        
        $menu['name']           = $request['data']['name'];
        $menu['description']    = $request['data']['description'];
        $menu['note']           = $request['data']['note'];
        $menu['duration']       = $request['data']['duration'];
        $menu['start']          = $request['data']['start'];
        $menu['end']            = $request['data']['end'];
        $menu->save();
        // return json('success', [$menu->id]);
        return response()->json(['id'=> $menu->id ]);
    }
    // delete particular menu and also in the db
    public function deleteMenu(Request $request) {
        $menu = Menu::find($request->id);
        if ($menu) {
            $menu->delete();
            return response()->json(['success']);
        }
        return response()->json(['failure']);
    }
    






    // create section table
    public function createSection(Request $request) {
        $section = new Section();
        $section['menu_id']         = $request['id'];
        $section['name']            = $request['data']['name'];
        $section['description']     = $request['data']['description'];
        $section['orderNumber']     = $request['data']['orderNumber'];
        $section->save();
        // return json('success', [$menu->id]);
        return response()->json(['id'=> $section->id ]);
    }
    // update the section function
    public function updateSection(Request $request) {
        $section = Section::find($request->id);
        $section['name']            = $request['data']['name'];
        $section['description']     = $request['data']['description'];
        $section['orderNumber']     = $request['data']['orderNumber'];
        $section->save();
        // return json('success', [$menu->id]);
        return response()->json(['id'=> $section->id ]);
    }
    // delete the section function
    public function deleteSection(Request $request) {
        $menu = Section::find($request->id);
        if ($menu) {
            $menu->delete();
            return response()->json(['success']);
        }
        return response()->json(['failure']);
    }











    //  create menu_item function
    public function createMenuItem(Request $request) {
        $item = new Menuitem();
        $item['section_id']         = $request->id;
        $item['name']               = $request['data']['name'];
        $item['description']        = $request['data']['description'];
        $item['price']              = $request['data']['price'];
        $item['vegetarian']         = $request['data']['vegetarian'];
        $item['vegan']              = $request['data']['vegan'];
        $item['kosher']             = $request['data']['kosher'];
        $item['halal']              = $request['data']['halal'];
        $item['gluten']             = $request['data']['gluten'];
        $item['alcohol']            = $request['data']['alcohol'];
        $item['image']              = $request['data']['image'];

        $item->save();
        return response()->json(['id'=> $item->id ]);
    }
    //  update menu_item function
    public function updateMenuItem(Request $request) {
        $item = Menuitem::find($request->id);
        $item['name']               = $request['data']['name'];
        $item['description']        = $request['data']['description'];
        $item['price']              = $request['data']['price'];
      
        $item['vegetarian']         = $request['data']['vegetarian'];
        $item['vegan']              = $request['data']['vegan'];
        $item['kosher']             = $request['data']['kosher'];
        $item['halal']              = $request['data']['halal'];
        $item['gluten']             = $request['data']['gluten'];
        $item['alcohol']            = $request['data']['alcohol'];
        $item['image']              = $request['data']['image'];

        $item->save();
        return response()->json(['id'=> $item->id ]);
    }
    // delete the menuitem function
    public function deleteMenuItem(Request $request) {
        $item = Menuitem::find($request->id);
        if ($item) {
            $item->delete();
            return response()->json(['success']);
        }
        return response()->json(['failure']);
    }











    // create Item option function
    public function createItemOption(Request $request) {
        $option = new Itemoption();
        $option['item_id']      = $request->id;
        $option['name']         = $request['data']['name'];
        $option['style']        = $request['data']['type'];
        $option['trigger']      = $request['data']['trigger'];
        $option->save();
        return response()->json(['id'=> $option->id ]);
    }
    // Update Item Option function
    public function updateItemOption(Request $request) {
        $option = Itemoption::find($request->id);
        $option['name']         = $request['data']['name'];
        $option['style']        = $request['data']['type'];
        $option['trigger']        = $request['data']['trigger'];
        $option->save();
        return response()->json(['id'=> $option->id ]);
    }
    // Delete the Item option function 
    public function deleteItemOption(Request $request) {
        $option = Itemoption::find($request->id);
        if ($option){
            $option->delete();
            return response()->json(['success']);
        }
        return response()->json(['failure']);
    }











    // create suboption function
    public function createSuboption(Request $request) {
        $suboption = new Suboption();
        $suboption['option_id']     = $request['id'];
        $suboption['name']          = $request['data']['name'];
        $suboption['value']         = $request['data']['value'];
        $suboption->save();
        return response()->json(['id'=> $suboption->id]);
    }
    // update suboption function
    public function updateSuboption(Request $request) {
        $suboption = Suboption::find($request->id);
        $suboption['name']          = $request['data']['name'];
        $suboption['value']         = $request['data']['value'];
        $suboption->save();
        return response()->json(['id'=> $suboption->id]);
    }
    // delete suboption function
    public function deleteSuboption(Request $request) {
        $suboption = Suboption::find($request->id);
        if ($suboption){
            $suboption->delete();
            return response()->json(['success']);
        }
        return response()->json(['failure']);
    }





    // create Item option function
    public function createItemOptionGroup(Request $request) {
        $option = new Itemoption();
        $option['item_id']      = $request->id;
        $option['name']         = $request['data']['name'];
        $option['style']        = $request['data']['type'];
        $option->save();

        foreach ($request->group as $item) {
            $suboption = new Suboption();
            $suboption['option_id']     = $option['id'];
            $suboption['name']          = $item['name'];
            $suboption['value']         = $item['value'];
            $suboption->save();
        }

        return response()->json(['id'=> $option->id ]);
    }
    // Update Item Option function
    public function updateItemOptionGroup(Request $request) {
        $option = Itemoption::find($request->id);
        $option['name']         = $request['data']['name'];
        $option['style']        = $request['data']['type'];
        $option->save();
        return response()->json(['id'=> $option->id ]);
    }

}