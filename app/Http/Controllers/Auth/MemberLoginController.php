<?php

namespace App\Http\Controllers\Auth;

use App\Events\MemberLoginSuccessfulEvent;
use App\Http\Controllers\Member\MemberCoreController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class MemberLoginController extends MemberCoreController
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:member', ['except' => array('logout')]);
    }


    // member/login to show the login form
    public function showLoginForm()
    {
        return view('auth.member-login');
    }


    public function login(Request $request)
    {
        //validate the form data
        $this->validate($request,[
            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        //attempt to log the member in
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        $remember = $request->remember;
        if(Auth::guard('member')->attempt($credentials, $remember)){
            //觸發事件
            $ip = Request::createFromGlobals()->getClientIp();
            if($ip=="::1"){
                $ip= '127.0.0.1';
            }else{
                $ip= Request::createFromGlobals()->getClientIp();
            }
            event(new MemberLoginSuccessfulEvent(Auth::guard('member')->user(), new Agent(), $ip, time()));

            //if successful , the redirect to their intended location
            return redirect()->intended(route('member.index'));
        }

        //if unsuccessful, then redirect back to login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('member')->logout();
        return redirect('/');
    }
}
