<?php

namespace App\Handlers;

use Carbon\Carbon;

class BarcodeHandler
{

    public function barcode_generation($prefix, $last_insert_id){
        $code_date = Carbon::now()->isoFormat('YYMMDD');
        $code_order = str_pad($last_insert_id,3,"0",STR_PAD_LEFT);
        return $prefix.$code_date.$code_order;
    }
}