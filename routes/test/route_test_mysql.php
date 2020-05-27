<?php

use App\Models\Shoes\ShoesCustomer;
use App\Models\Shoes\ShoesEE;
use App\Models\Shoes\ShoesMaterial;
use App\Models\Shoes\ShoesModel;
use App\Models\Shoes\ShoesOrder;
use App\Models\Shoes\ShoesSupplier;
use App\Models\SKU;
use Carbon\Carbon;
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
                        ->select('skus.sku_id as sku_id', 'skus.id_code as sku_code', 'skus.p_id')
                        ->addSelect('skus.length_pcs', 'skus.width_pcs', 'skus.heigth_pcs')
                        ->addSelect(DB::raw(" (skus.length_pcs * skus.width_pcs * skus.heigth_pcs) as volume_pcs"), 'skus.weight_pcs')
                        ->addSelect('skus.length_box', 'skus.width_box', 'skus.heigth_box')
                        ->addSelect(DB::raw(" (skus.length_box * skus.width_box * skus.heigth_box) as volume_box"), 'skus.weight_box')
                        ->addSelect('skus.pcs_per_box')

//                        ->where('skus.sku_id',1)
                    ->leftJoin('sku_translations', function($join)
                        {
                            $join->on('sku_translations.s_k_u_sku_id', '=', 'skus.sku_id' )
                                ->where('sku_translations.locale',app()->getLocale());
                        })
                        ->addSelect('sku_translations.price as sell_price')

                    ->join('products', 'products.p_id', '=', 'skus.p_id')
                        ->where('products.member_id', Auth::guard('member')->user()->id)
                        ->addSelect('products.id_code as p_code', 'products.m_price', 'products.t_price')

                    ->join('product_translations', 'products.p_id', '=', 'product_translations.product_p_id')
                        ->addSelect('product_translations.p_name' ,'product_translations.tax_percentage', 'product_translations.custom_code')


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

                    ->leftJoin('supplier_groups', 'supplier_groups.sg_id', '=', 'suppliers.sg_id')
                    ->leftJoin('supplier_group_translations', function($join){
                        $join->on('supplier_group_translations.supplier_group_sg_id', '=', 'supplier_groups.sg_id' )
                            ->where('sku_supplier_translations.locale', app()->getLocale());
                    })
                        ->addSelect('supplier_group_translations.sg_name' , 'supplier_group_translations.cbm_price' , 'supplier_group_translations.kg_price')

                    //綁定sku crawlerItems
                    ->leftJoin('psku_cskus', function($join){
                        $join->on('psku_cskus.sku_id', '=', 'skus.sku_id');
                    })

                    //找crawlerItem - SKU
                    ->leftJoin('citem_skus', function($join){
                        $join->on('psku_cskus.itemid', '=', 'citem_skus.itemid')
                            ->on('psku_cskus.shopid', '=', 'citem_skus.shopid')
                            ->on('psku_cskus.modelid', '=', 'citem_skus.modelid');
                    })
                        ->addSelect('citem_skus.sold as monthly_sold') //個別

                    ->leftJoin('crawler_items', function($join){
                        $join->on('crawler_items.ci_id', '=', 'citem_skus.ci_id');
                    })
                        ->addSelect('crawler_items.historical_sold')//個別


                    //每 pcs CBM x CMB單價
                    ->addSelect(DB::raw(" (skus.length_pcs * skus.width_pcs * skus.heigth_pcs) * supplier_group_translations.cbm_price  as shipping_cost "))

                    //每 pcs Kg x Kg單價
                    ->addSelect(DB::raw(" (skus.weight_pcs) * supplier_group_translations.kg_price as freight_cost "))

                    // 利潤 = 售價 - 採購價 - 運費
                    ->addSelect(DB::raw("(sku_translations.price - sku_supplier_translations.price - 11) as profit "))

                    //群組
                    ->groupBy(['sku_id', 'sku_code','p_id','sell_price',
                                'p_code','m_price','t_price','sku_supplier_url',
                                'sku_supplier_purchase_price','sku_supplier_locale','s_name'])

                    ->addSelect(DB::raw("SUM(citem_skus.sold) as total_monthly_sold"))
                    ->addSelect(DB::raw("SUM(crawler_items.historical_sold) as total_historical_sold"))
                    ->addSelect(DB::raw("count(citem_skus.sold) as total_seller"))

                    ->get();

        dd($skus);
    });
});


