<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Models\CrawlerItem;
use App\Models\Product;
use App\Models\SKU;
use App\Models\SKUAttribute;
use App\Models\SKUAttributeTranslation;
use App\Models\SkuTranslation;
use App\Repositories\Member\MemberCoreRepository;
use App\Services\Member\AttributeService;
use App\Services\Member\SKUService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function app;
use function compact;
use function config;
use function dd;
use function is_array;
use function redirect;
use function request;
use function view;


class ProductPlusSKUController extends MemberCoreController
{

    public function __construct(SKUService $skuService)
    {
        $actions = [
            '*',
            'index',
            'show', 'edit','update',
            'create', 'store',
            'destroy',
            'show'];
        $this->coreMiddleware('ProductPlusSKUController',$guard='member', $route="productPlusSKU", $actions);
        $this->skuService = $skuService;
    }

    public function index()
    {
        $products = Product::with(['member'])
            ->where('member_id', Auth::guard('member')->user()->id)->paginate(20);
        return view(config('theme.member.view').'productPlusSKU.index', compact('products'));
    }

    public function edit(Product $productPlusSKU)
    {
        $product = $productPlusSKU;
        $product = Product::with(['type', 'type.attributes', 'all_skus'])
            ->without(['all_skus.skuAttributes','all_skus.skuSuppliers'])
            ->where('member_id', Auth::guard('member')->user()->id)
            ->find($product->p_id);
        return view(config('theme.member.view').'productPlusSKU.edit', compact('product'));
    }

    public function update(Product $productPlusSKU)
    {
        $product = $productPlusSKU;
        $data = request()->all();

        $sort_order=0;

        foreach ($data['sku_id'] as $key => $sku_id){
            if($key==0){
                continue;
            }

            $sku = $this->skuService->skuRepo->builder();
            $sku = $sku->updateOrCreate([
                    'sku_id' => $sku_id,
                ],[
                    'sort_order' => $sort_order,
                    'is_active' => isset($data['is_active'][$key])? "1":"" ,
                    'length_pcs' => $data['length_pcs'][$key],
                    'width_pcs' => $data['width_pcs'][$key],
                    'heigth_pcs' => $data['heigth_pcs'][$key],
                    'weight_pcs' => $data['weight_pcs'][$key],
                    'length_box' => $data['length_box'][$key],
                    'width_box' => $data['width_box'][$key],
                    'heigth_box' => $data['heigth_box'][$key],
                    'weight_box' => $data['weight_box'][$key],
                    'pcs_per_box' => $data['pcs_per_box'][$key],
                    'p_id' => $product->p_id,
                    'member_id' => Auth::guard('member')->user()->id,
                ]);

            $row_item_translations[] = [
                's_k_u_sku_id' => $sku->sku_id,
                'sku_name' => $data['sku_name'][$key],
                'price' => $data['price'][$key],
                'locale' => app()->getLocale(),
            ];
            $attributes_count = $product->type->attributes->count();
            $start= $key * $attributes_count;
            for($i=$start; $i<=($key+1)*$attributes_count-1; $i++){
                $ii[]=[$i];
                $SKUAttribute = SKUAttribute::updateOrCreate([
                    'sku_id' => $sku->sku_id,
                    'a_id' => $data['sku_attributes_a_id'][$i],
                ],[
                    'a_value' => $data['sku_attributes'][$i],
                ]);

                SKUAttributeTranslation::updateOrCreate([
                    's_k_u_attribute_sa_id' => $SKUAttribute->sa_id
                ],[
                    'a_value' => $data['sku_attributes'][$i],
                ]);
            }
            $sort_order++;
        }

        if(isset($data['is_active'])){
            foreach ($data['is_active'] as $key => $sku_id){
                $row_is_active[] = [
                    'sku_id' => $sku_id,
                    'is_active' => 1
                ];
            }

            $skuModel = new SKU();
            $TF = (new MemberCoreRepository())->massUpdate($skuModel, $row_is_active);
        }


        //批量儲存SKU
        $skuTranslationModel = new SkuTranslation();
        $TF = (new MemberCoreRepository())->massUpdate($skuTranslationModel, $row_item_translations);



        if(request()->submit=="index"){
            return redirect()->route('member.productPlusSKU.index')->with('toast',  parent::$toast_update);
        }else{
            return redirect()->route('member.productPlusSKU.edit', ['productPlusSKU'=>$product->p_id,'collapse'=>1])->with('toast',  parent::$toast_update);
        }
    }
}
