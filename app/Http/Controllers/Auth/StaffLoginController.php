<?php

namespace App\Http\Controllers\Auth;

use App\Events\StaffLoginSuccessfulEvent;
use App\Http\Controllers\Staff\StaffCoreController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class StaffLoginController extends StaffCoreController
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:staff', ['except' => array('logout')]);
    }


    // Staff/login to show the login form
    public function showLoginForm()
    {
        return view('auth.staff-login');
    }


    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request,[
            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        //attempt to log the Staff in
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        $Staff = $request->staff;
        if(Auth::guard('staff')->attempt($credentials, $Staff)){
            //觸發事件
            $ip = Request::createFromGlobals()->getClientIp();
            if($ip=="::1"){
                $ip= '127.0.0.1';
            }else{
                $ip= Request::createFromGlobals()->getClientIp();
            }
            event(new StaffLoginSuccessfulEvent(Auth::guard('staff')->user(), new Agent(), $ip, time()));

            //if successful , the redirect to their intended location
            return redirect()->intended(route('staff.staff.index'));
        }

        //if unsuccessful, then redirect back to login with the form data
        return redirect()->back()->withInput($request->only('email', 'Staff'));
    }

    public function logout(){
        Auth::guard('staff')->logout();
        return redirect('/');
    }
}
