<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function coreMiddleware($controller, $guard, $route, $actions)
    {
        foreach ($actions as $action) {
            $this->middleware(['permission:'.$guard.'.' . $route . '.' . $action ])->only($action);
        }
    }
}
