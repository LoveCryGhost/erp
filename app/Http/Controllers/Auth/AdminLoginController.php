<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => array('logout')]);
    }


    // admin/login to show the login form
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }


    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request,[
            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        //attempt to log the admin in
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        $remember = $request->remember;
        if(Auth::guard('admin')->attempt($credentials, $remember)){

            //if successful , the redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }

        //if unsuccessful, then redirect back to login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
