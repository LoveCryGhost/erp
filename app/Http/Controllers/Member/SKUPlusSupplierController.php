<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Models\CrawlerItem;
use App\Models\Product;
use App\Models\SKU;
use App\Models\SKUAttribute;
use App\Models\SKUAttributeTranslation;
use App\Models\SKUSupplier;
use App\Models\SKUSupplierTranslation;
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
use function random_int;
use function redirect;
use function request;
use function view;


class SKUPlusSupplierController extends MemberCoreController
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
        $this->coreMiddleware('SKUPlusSupplierController',$guard='member', $route="skuPlusSupplier", $actions);
        $this->skuService = $skuService;
    }

    public function index()
    {
        $skus = $this->skuService->skuRepo->builder()
                    ->with(['product','member'])
                    ->where('member_id', Auth::guard('member')->user()->id)
                    ->paginate(20);
        return view(config('theme.member.view').'skuPlusSupplier.index', compact('skus'));
    }

    public function edit(SKU $skuPlusSupplier)
    {
        $sku = $skuPlusSupplier;
        $product = Product::where('member_id', Auth::guard('member')->user()->id)
            ->with(['all_skus'])
            ->find($sku->product->p_id);
        return view(config('theme.member.view').'skuPlusSupplier.edit', [
            'product' => $product,
            'sku_editable' => $sku
        ]);
    }

    public function update(SKU $skuPlusSupplier)
    {
        $sku = $skuPlusSupplier;
        $data = request()->all();

        $sort_order=0;
        foreach ($data['ss_id'] as $key => $ss_id){
            if($key==0){
                continue;
            }

            //儲存 sku-supplier
            $sync_ids[$ss_id]= [

            ];
            //$sku->skuSuppliers()->syncWithoutDetaching($sync_ids);

            $SKUSupplier = SKUSupplier::updateOrCreate([
                'ss_id' => $ss_id,
            ],[
                's_id' => $data['s_id'][$key],
                'sku_id' => $sku->sku_id,
                'sort_order' => $sort_order,
                'url' => $data['url'][$key],
                'random' => random_int(1,999999999),
            ]);

            SKUSupplierTranslation::updateOrCreate([
                'sku_id' => $SKUSupplier->ss_id
            ],[
                'price'=> $data['price'][$key],
                'locale' => app()->getLocale()
            ]);

            $sort_order++;
        }

        if(isset($data['is_active'])) {
            foreach ($data['is_active'] as $key => $sku_id) {
                $SKUSupplier = SKUSupplier::find($sku_id);
                $SKUSupplier->is_active = 1;
                $SKUSupplier->save();
            }
        }

        if(request()->submit=="index"){
            return redirect()->route('member.skuPlusSupplier.index')->with('toast',  parent::$toast_update);
        }else{
            return redirect()->route('member.skuPlusSupplier.edit', ['skuPlusSupplier' => $sku->sku_id,'collapse'=>1])->with('toast',  parent::$toast_update);
        }
    }
}
