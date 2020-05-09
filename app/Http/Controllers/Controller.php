<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function explode;
use function trim;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function coreMiddleware($controller, $guard, $route, $actions)
    {
        foreach ($actions as $action) {
            $this->middleware(['permission:'.$guard.'.' . $route . '.' . $action ])->only($action);
        }
    }

    public function filter_like($query, $column_name , $inputs)
    {
        $inputs = explode(',', $inputs);
        $query = $query->where(function($query) use($column_name, $inputs){
            $index=1;
            foreach($inputs as $input){
                $input= trim($input);
                if( $input!= "" and $index==1) {
                    $query = $query->where($column_name, 'LIKE', '%' . $input . '%');
                }elseif($input!= "" ){
                    $query->orwhere(function($q) use($column_name, $input) {
                        $q->where($column_name, 'LIKE', '%' . $input .'%');
                    });
                }
                $index++;
            }
            return $query;
        });

        return $query;
    }

    public function filter_checkbox($query, $column_name , $checkboxes)
    {
        $query = $query->where(function($query) use($column_name, $checkboxes){
            $index=1;
            if($checkboxes!=""){
                foreach($checkboxes as $checkbox_value){
                    if($index==1) {
                        $query = $query->where($column_name, $checkbox_value);
                    }else{
                        $query->orwhere(function($q) use($column_name, $checkbox_value) {
                            $q->where($column_name, $checkbox_value);
                        });
                    }
                    $index++;
                }
                return $query;
            }

        });
        return $query;
    }

}
