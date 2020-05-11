<?php

namespace App\Http\Controllers\Member\Tools;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function config;
use function view;

class ToolsController
{
    public function excel_like()
    {
        return view(config('theme.member.view').'tools/excel_like',[]);
    }

    public function compound_interest()
    {
        $capital = 10000;
        return view(config('theme.member.view').'tools/compound_interest',[
            'capital' => $capital
        ]);
    }
}
