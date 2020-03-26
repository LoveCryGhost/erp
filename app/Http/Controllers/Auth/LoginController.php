<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoginSuccessfulEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
        if(Auth::guard('web')->attempt($credentials, $remember)){

            //觸發事件
            $ip = Request::createFromGlobals()->getClientIp();
            if($ip=="::1"){
                $ip= '127.0.0.1';
            }else{
                $ip= Request::createFromGlobals()->getClientIp();
            }
            event(new UserLoginSuccessfulEvent($this->guard()->user(), new Agent(), $ip, time()));

            //if successful , the redirect to their intended location
            return redirect('/');
        }

        //if unsuccessful, then redirect back to login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
