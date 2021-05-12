<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Restaruant;
use Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        return view('admin.user');
    }

    public function datatables() {
        $datas = User::orderBy('id','asc')->get();
        return Datatables::of($datas)
        ->editColumn('password', function(User $data) {
            return '';
        })
        ->addColumn('action', function(User $data) {
            return '<div class="action-list"><a href="javascript:;" data-href="' . route('admin.users.edit', $data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i></a><a href="javascript:;" data-href="' . route('admin.users.delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
        })
        ->rawColumns(['name', 'email', 'action'])
        ->toJson(); //--- Returning Json Data To Client Side
    }

    public function create() {
        return view('admin.user_detail');
    }

    public function saveUser(Request $request) {
        $data = new User();

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['remember_token'] = ' ';
        $data['password'] = bcrypt($request['password']);
        $data->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        return response()->json($msg);
    }

    public function edit($id) {
        $data = User::findOrFail($id);
        return view('admin.user_detail',compact('data'));
    }

    public function updateUser(Request $request,$id) {
        $data = User::findOrFail($id);
        if($request->password == ''){
            $data['password'] = $data->password;
        }
        else{
            $input['password'] = bcrypt($request['password']);
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['remember_token'] = ' ';
        $data->save();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }

    public function delete($id) {
        $data = User::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }
}
