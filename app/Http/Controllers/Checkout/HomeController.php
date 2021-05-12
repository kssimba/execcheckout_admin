<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Providers\RouteServiceProvider;

use Auth;
use App\Models\User;

class HomeController extends Controller
{

   protected $auth;
   protected $redirectTo = RouteServiceProvider::HOME;

    public function index(){

        // $database = app('firebase.database');

        // $reference = $database->getReference('vendor_categories/vendor_categories');
        // $value = $reference->getValue();
        $categories = array();
      

        // $reference = $database->getReference('vendors');
        // $value = $reference->getValue();
        $restaraunts = array();
    

        return view('Checkout.index',compact('categories','restaraunts'));
    }

    public function welcome(){

        $database = app('firebase.database');

        $reference = $database->getReference('vendor_categories/vendor_categories');
        $value = $reference->getValue();
        $categories = array();
        foreach($value as $val){
            array_push($categories, $val);
        }

        $reference = $database->getReference('vendors');
        $value = $reference->getValue();
        $restaraunts = array();
        foreach($value as $val){
            array_push($restaraunts, $val);
        }

        return view('Checkout.index',compact('categories','restaraunts'));
    }

    public function showlogin(){
        return view('Checkout.login');
    }

    public function showregister(){
        return view('Checkout.register');
    }

    public function register(Request $request){
        $auth = app('firebase.auth');

        $userProperties = [
            'email' => $request->email,
            'emailVerified' => true,
            'password' => $request->password,
            'displayName' => $request->firstname,
            'disabled' => false,
        ];

        $createdUser = $auth->createUser($userProperties);

        return redirect()->route('showlogin');
    }

    protected function signin(Request $request) {
        $this->auth = app('firebase.auth');
        try {
           $signInResult = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
           $user = new User($signInResult->data());
           $result = Auth::login($user);
           return redirect('/checkout');
        } catch (FirebaseException $e) {
           throw ValidationException::withMessages(['hello' => [trans('auth.failed')],]);
        }
     }

     public function signout(){
        Auth::logout();

        return redirect()->back();
    }

}
