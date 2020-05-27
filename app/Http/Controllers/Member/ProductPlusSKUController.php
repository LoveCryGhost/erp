<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\AttributeRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Services\Member\AttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function compact;
use function config;
use function dd;
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
}
