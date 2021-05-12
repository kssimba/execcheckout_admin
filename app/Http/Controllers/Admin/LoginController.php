<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Models\User;

use Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    public function showlogin(){

        return view('admin.login');
    }

    public function login(Request $request){


        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
            return response()->json(route('admin.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
            return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
    }
    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
