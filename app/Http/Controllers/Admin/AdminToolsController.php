<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminToolsController extends AdminCoreController
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function guard_switcher_user(Request $request)
    {
        $id= $request->input('id');
        $guard= $request->input('guard');
        $url= $request->input('url');
        Auth::guard($guard)->loginUsingId($id, true);
        return redirect($url);
    }


}
