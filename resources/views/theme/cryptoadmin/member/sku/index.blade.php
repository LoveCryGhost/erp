@extends(config('theme.member.member-app'))

@section('title',__('member/sku.title'))

@section('content-header','')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h3>
            {{__('member/sku.index.title')}}
        </h3>
       
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col">
                                <form class="form-control m-b-0  bg-color-lightblue">
                                    <div class="row">
                                        <div class="col-sm-3 form-group">
                                            <h5>{{__('default.index.table.barcode')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="id_code" placeholder="Barcode" value="{{request()->id_code}}">
                                            </div>
                                        </div>
                    
                                        <div class="col-sm-3 form-group">
                                            <h5>{{__('member/sku.search.productName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="p_name" placeholder="{{__('member/sku.search.productName')}}" value="{{request()->p_name}}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-3 form-group">
                                            <h5>{{__('member/sku.search.SKUName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="sku_name" placeholder="{{__('member/sku.search.SKUName')}}" value="{{request()->sku_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{route('member.sku.index')}}" class="form-control btn btn-sm btn-primary">{{__('member/supplierGroup.index.search.reset')}}</a>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">{{__('member/supplierGroup.index.search.submit')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xl-12 col-lg-12 text-right mb-5">
                        </div>
                        <div class="table-responsive">
                            <table class="itable table">
                                <thead>
                                    <tr>
                                        <th>{{__('default.index.table.no')}}</th>
                                        <th>{{__('default.index.table.is_active')}}</th>
                                        <th>{{__('default.index.table.barcode')}}</th>
                                        <th>{{__('member/sku.index.table.productName')}}</th>
                                        <th>{{__('member/sku.index.table.price')}}</th>
                                        <th>{{__('member/sku.index.table.skuInfo')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="w-20 text-center">{{$loop->iteration}}</td>
                                        <td>
                                            <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                   {{$product->is_active===1? "checked": ""}} disabled>
                                            <label for="is_active" class="p-0 m-0"></label>
                                        </td>
                                        <td>
                                            {{$product->type->t_name}}<br>
                                            {{$product->id_code}}</td>
                                        <td class="w-200">
                                            <a href="#">{{$product->p_name}}</a><br>
                                            @foreach($product->productThumbnails as $productThumbnail)
                                                <img class="product-thumbnail" data-img-group="{{$product->p_id}}"  src="{{asset($productThumbnail->path)}}"
                                                     data-toggle="modal" data-target="#modal-md" onclick="show_product_thumbnails(this,php_inject={{json_encode(['product_thumbnail' => $productThumbnail])}})" />
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($product->m_price!==NULL and $product->t_price!==NULL)
                                                {{$product->m_price}}  ~ {{$product->t_price}}
                                            @elseif($product->m_price!==NULL)
                                                {{$product->m_price}}
                                            @elseif($product->t_price!==NULL)
                                                {{$product->m_price}}
                                            @endif
                                        </td>
                                       
                                        <td class="text-left">
                                            @foreach($product->all_skus as $sku)
                                                {{$sku->sku_name}} <i class="fa fa-arrow-right"></i> {{$sku->price}}<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=""> {{$products->links("pagination::bootstrap-4")}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        float_image(className="product-thumbnail", x=40, y=0)
    </script>
@endsection



