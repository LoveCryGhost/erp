<?php

use App\Models\Shoes\ShoesCustomer;
use App\Models\Shoes\ShoesEE;
use App\Models\Shoes\ShoesMaterial;
use App\Models\Shoes\ShoesModel;
use App\Models\Shoes\ShoesOrder;
use App\Models\Shoes\ShoesSupplier;
use App\Models\SKU;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::prefix('test') ->middleware('auth:admin')->group(function(){
    Route::get('mysql',function () {
//        $skus = SKU::where('products.member_id', Auth::guard('member')->user()->id)
//                ->join('products', 'products.p_id', '=', 'skus.p_id')
//                ->join('skus_suppliers', 'skus_suppliers.sku_id', '=', 'skus.sku_id')
//                ->join('suppliers', 'suppliers.s_id', '=', 'skus_suppliers.s_id')
//                ->join('supplier_groups', 'supplier_groups.sg_id', '=', 'suppliers.sg_id')
//                ->first();

        //用DB::table('skus') 與 SKU 是有差別的
        $skus = DB::table('skus')
                        ->select('skus.sku_id', 'skus.id_code as sku_code', 'skus.p_id')
                        ->where('skus.sku_id',1)
                        ->leftJoin('sku_translations', function($join)
                        {
                            $join->on('sku_translations.s_k_u_sku_id', '=', 'skus.sku_id' )
                                ->where('sku_translations.locale',app()->getLocale());
                        })
                        ->addSelect('sku_translations.price as sell_price')

                    ->join('products', 'products.p_id', '=', 'skus.p_id')
                        ->where('products.member_id', Auth::guard('member')->user()->id)
                        ->addSelect('products.id_code as p_code', 'products.m_price', 'products.t_price')

                    ->leftJoin('skus_suppliers', function($join)
                    {
                        $join->on('skus.sku_id', '=', 'skus_suppliers.sku_id' )
                            ->where('skus_suppliers.is_active','=',1);
                    })
                        ->addSelect('skus_suppliers.url as sku_supplier_url')

                    ->leftJoin('sku_supplier_translations', function($join){
                        $join   ->on('sku_supplier_translations.sku_id', '=', 'skus_suppliers.ss_id' )
                                ->where('sku_supplier_translations.locale',app()->getLocale());
                    })
                        ->addSelect('sku_supplier_translations.price as sku_supplier_purchase_price',
                                        'sku_supplier_translations.locale as sku_supplier_locale',)

                    ->join('suppliers', 'suppliers.s_id', '=', 'skus_suppliers.s_id')
                        ->addSelect('suppliers.s_name')

                    ->join('supplier_groups', 'supplier_groups.sg_id', '=', 'suppliers.sg_id')
                        ->addSelect('supplier_groups.sg_name')
                    ->get();
        dd($skus);
    });
});


