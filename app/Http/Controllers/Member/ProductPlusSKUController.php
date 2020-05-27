<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Models\CrawlerItem;
use App\Models\Product;
use App\Models\SKU;
use App\Models\SkuTranslation;
use App\Repositories\Member\MemberCoreRepository;
use App\Services\Member\AttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function app;
use function compact;
use function config;
use function dd;
use function redirect;
use function view;


class ProductPlusSKUController extends MemberCoreController
{


    public function __construct()
    {
    }

    public function index()
    {
        $products = Product::with(['member'])->where('member_id', Auth::guard('member')->user()->id)->paginate(10);
        return view(config('theme.member.view').'productPlusSKU.index', compact('products'));
    }

    public function edit(Product $productPlusSKU)
    {
        $product = $productPlusSKU;

        $product = Product::with(['all_skus'])->find($product->p_id);
        return view(config('theme.member.view').'productPlusSKU.edit', compact('product'));
    }

    public function update(Product $productPlusSKU)
    {
        $product = $productPlusSKU;
        $data = request()->all();

        $sort_order=0;
        foreach ($data['sku_name'] as $sku_id => $row){
            $row_items[] = [
                'sku_id' => $sku_id,
                'sort_order' => $sort_order,
                'is_active' => isset($data['is_active'][$sku_id])? "1":"" ,

                'length_pcs' => $data['length_pcs'][$sku_id],
                'width_pcs' => $data['width_pcs'][$sku_id],
                'heigth_pcs' => $data['heigth_pcs'][$sku_id],
                'weight_pcs' => $data['weight_pcs'][$sku_id],
                'length_box' => $data['length_box'][$sku_id],
                'width_box' => $data['width_box'][$sku_id],
                'heigth_box' => $data['heigth_box'][$sku_id],
                'weight_box' => $data['weight_box'][$sku_id],
                'pcs_per_box' => $data['pcs_per_box'][$sku_id],
                'p_id' => $product->p_id,
                'member_id' => Auth::guard('member')->user()->id,
            ];

            $row_item_translations[] = [
                's_k_u_sku_id' => $sku_id,
                'sku_name' => $data['sku_name'][$sku_id],
                'price' => $data['price'][$sku_id],
                'locale' => app()->getLocale(),
            ];

            $sort_order++;
        }


        //批量儲存SKU
        $skuModel = new SKU();
        $TF = (new MemberCoreRepository())->massUpdate($skuModel, $row_items);

        $skuTranslationModel = new SkuTranslation();
        $TF = (new MemberCoreRepository())->massUpdate($skuTranslationModel, $row_item_translations);

        return redirect()->route('member.productPlusSKU.index')->with('toast',  parent::$toast_update);
    }
}
