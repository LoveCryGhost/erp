<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use function end;

class AdminCoreController extends Controller
{
    public function coreMiddleware($controller, $guard, $route, $actions)
    {


//        foreach (Route::getRoutes()->getRoutes() as $route)
//        {
//            $action = $route->getAction();
//
//            if (array_key_exists('controller', $action))
//            {
//
//                $_action = explode('@',$action['controller']);
//                $_namespaces_chunks = explode('\\',$_action[0]);
//
//                if( end($_namespaces_chunks)==$controller){
//                    $controllers['controller'] = $controller;
//                    $controllers['actions'][] = end($_action);
//                }
//            }
//        }
//
//        foreach( $controllers['actions'] as $action) {
//            $this->middleware(['permission:'.$guard.'.' . $route . '.*|permission:'.$guard.'.' . $route . '.' . $action . ''])->only($action);
//        }

        foreach ($actions as $action) {
            $this->middleware(['permission:'.$guard.'.' . $route . '.*|permission:'.$guard.'.' . $route . '.' . $action . ''])->only($action);
        }
    }
}
