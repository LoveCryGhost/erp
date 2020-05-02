<?php

namespace App\Services;




use function explode;
use function trim;

class Service
{
    public function filter_like($query, $column_name , $inputs)
    {
        // ct_name
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
}
