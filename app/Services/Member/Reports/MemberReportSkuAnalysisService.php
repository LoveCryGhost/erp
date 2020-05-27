<?php

namespace App\Services\Member\Reports;


use App\Services\Member\MemberCoreService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function app;

class MemberReportSkuAnalysisService extends MemberCoreService
{

    public function __construct()
    {

    }

    public function skuAnalysis()
    {
        $query = DB::table('skus')
                    ->select('skus.sku_id as sku_id', 'skus.id_code as sku_code', 'skus.p_id')
                    ->addSelect('skus.length_pcs', 'skus.width_pcs', 'skus.heigth_pcs')
                    ->addSelect(DB::raw(" (skus.length_pcs * skus.width_pcs * skus.heigth_pcs) as volume_pcs"), 'skus.weight_pcs')
                    ->addSelect('skus.length_box', 'skus.width_box', 'skus.heigth_box')
                    ->addSelect(DB::raw(" (skus.length_box * skus.width_box * skus.heigth_box) as volume_box"), 'skus.weight_box')
                    ->addSelect('skus.pcs_per_box')

                    ->leftJoin('sku_translations', function($join)
                    {
                        $join->on('sku_translations.s_k_u_sku_id', '=', 'skus.sku_id' )
                            ->where('sku_translations.locale',app()->getLocale());
                    })
                    ->addSelect('sku_translations.price as sell_price', 'sku_translations.sku_name as sku_name')

                    //產品 products
                    ->join('products', 'products.p_id', '=', 'skus.p_id')
                    ->where('products.member_id', Auth::guard('member')->user()->id)
                    ->addSelect('products.id_code as p_code', 'products.m_price', 'products.t_price')

                    ->join('product_translations', 'products.p_id', '=', 'product_translations.product_p_id')
                    ->addSelect('product_translations.p_name' ,'product_translations.tax_percentage', 'product_translations.custom_code')

                    //產品照片
                    ->rightJoin('product_thumbnails', function($join)
                    {
                        $join->on('product_thumbnails.p_id', '=', 'products.p_id' );
                    })
                    ->addSelect('product_thumbnails.path as p_img_path')

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
                    ->addSelect(DB::raw("(sku_translations.price - sku_supplier_translations.price - 11) > 10 as profit "))

                    //群組
                    ->groupBy(['skus.sku_id', 'skus.id_code','products.p_id','sku_translations.price', 'sku_translations.sku_name',
                        'products.id_code','products.m_price','products.t_price','skus_suppliers.url',
                        'sku_supplier_translations.price','sku_supplier_translations.locale','suppliers.s_name'])

                    ->addSelect(DB::raw("SUM(citem_skus.sold) as total_monthly_sold"))
                    ->addSelect(DB::raw("SUM(crawler_items.historical_sold) as total_historical_sold"))
                    ->addSelect(DB::raw("count(citem_skus.sold) as total_seller"));
        return $query ;
    }


}
