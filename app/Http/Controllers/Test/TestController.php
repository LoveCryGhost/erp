<?php

namespace App\Http\Controllers\Test;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class TestController
{
    public function excel_like()
    {
        return view('test/excel_like',[]);
    }
}
