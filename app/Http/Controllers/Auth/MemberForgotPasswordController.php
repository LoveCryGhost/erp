<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class MemberForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    protected $redirectTo = '/member';

    public function __construct()
    {
        $this->middleware('guest:member');
    }

    protected function broker()
    {
        return Password::broker('members');
    }

    public function showRequestForm()
    {
        return view('auth.passwords.member-email');
    }
}
