<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Restaruant;
use Datatables;
use Illuminate\Http\Request;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        return view('admin.staff');
    }

    public function datatables(){
        $datas = Admin::where('id','!=',1)->where('id','!=',Auth::guard('admin')->user()->id)->orderBy('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('role', function(Admin $data) {
                                $role = $data->role_id == 0 ? 'No Role' : "sales person";
                                return $role;
                            })
                            ->addColumn('action', function(Admin $data) {
                                $delete ='<a href="javascript:;" data-href="' . route('admin-staff-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                return '<div class="action-list"><a data-href="' . route('admin-staff-show',$data->id) . '" class="view details-width" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i>Details</a><a data-href="' . route('admin-staff-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>'.$delete.'</div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function addstaff(){

        return view('admin.addstaff');
    }

    public function storestaff(Request $request){
        $data = new Admin();

        if ($file = $request->file('photo'))
         {
            $name = time().$file->getClientOriginalName();
            $file->move('../assets/img/',$name);
            $data['photo'] = $name;
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['role_id'] = 1;
        $data['status'] = 1;
        $data['remember_token'] = ' ';
        $data['password'] = bcrypt($request['password']);
        $data->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
    }

    public function deletestaff($id)
    {
    	if($id == 1)
    	{
        return "You don't have access to remove this admin";
    	}
        $data = Admin::findOrFail($id);
        //If Photo Doesn't Exist

        //If Photo Exist

        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function showstaff($id)
    {
        $data = Admin::findOrFail($id);
        return view('admin.showstaff',compact('data'));
    }

    public function editstaff($id)
    {
        $data = Admin::findOrFail($id);
        return view('admin.staffedit',compact('data'));
    }

    public function updatestaff(Request $request,$id)
    {
        //--- Validation Section
        if($id != Auth::guard('admin')->user()->id)
        {

            $data = Admin::findOrFail($id);
            if($request->password == ''){
                $data['password'] = $data->password;
            }
            else{
                $input['password'] = bcrypt($request['password']);
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['role_id'] = 1;
            $data['status'] = 1;
            $data['remember_token'] = ' ';
            $data->save();
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
        }
        else{
            $msg = 'You can not change your role.';
            return response()->json($msg);
        }

    }
    
    public function showhistory(){
        return view('admin.staffhistory');
    }

    public function historydatatables(){
        $datas = Restaruant::get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('name', function(Restaruant $data) {
                                return $data->name;
                            })
                            ->addColumn('person', function(Restaruant $data) {
                                return $data->writer;
                            })
                            ->addColumn('date', function(Restaruant $data) {
                                return $data->created_at;
                            })
                            ->rawColumns(['name'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

}
