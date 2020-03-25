<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class MemberResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected $redirectTo = "/member";

    public function __construct()
    {
        $this->middleware('guest:member');
    }


    protected function guard()
    {
        return Auth::guard('member');
    }

    protected function broker()
    {
        return Password::broker('members');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.member-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
