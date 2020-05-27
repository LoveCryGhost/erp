@extends(config('theme.member.member-app'))

@section('title',__('member/product.title'))

@section('content-header','')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h3>
            {{__('member/product.index.title')}}
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
                                            <h5>{{__('member/product.search.productName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="p_name" placeholder="{{__('member/product.search.productName')}}" value="{{request()->p_name}}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-3 form-group">
                                            <h5>{{__('member/product.search.SKUName')}}</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="sku_name" placeholder="{{__('member/product.search.SKUName')}}" value="{{request()->sku_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{route('member.product.index')}}" class="form-control btn btn-sm btn-primary">{{__('member/supplierGroup.index.search.reset')}}</a>
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
{{--                            @include(config('theme.member.btn.index.crud'))--}}
                        </div>
                        <div class="table-responsive">
                            <table class="itable table">
                                <thead>
                                    <tr>
                                        <th>{{__('default.index.table.no')}}</th>
                                        <th>{{__('member/product.index.table.productName')}}</th>
                                        <th>{{__('default.index.table.photo')}}</th>
                                        <th>{{__('default.index.table.is_active')}}</th>
                                        <th>{{__('default.index.table.createdBy')}}</th>
                                        <th>{{__('default.index.table.crud')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{$product->p_name}}<br>
                                            <small>{{$product->id_code}}</small>
                                        </td>
                                        <td>照片</td>
                                        <td>
                                            <input type="checkbox" class="permission_check" name="is_active" id="is_active"
                                                   {{$product->is_active===1? "checked": ""}} disabled>
                                            <label for="is_active" class="p-0 m-0"></label>
                                        </td>
                                        <td>{{$product->member->name}}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{route('member.productPlusSKU.edit',['productPlusSKU'=> $product->p_id, 'collapse'=>1])}}" ><i class="fa fa-plus"></i> Add SKU</a>
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
        function show_product_thumbnails(_this, php_inject) {
            product_thumbnail = php_inject.product_thumbnail;
            thumbnails = $('img.product-thumbnail[data-img-group='+product_thumbnail.p_id+']');
            modal_body =  $('#modal-md .modal-body').html('');
            thumbnails.each(function () {
                src = $(this).attr('src');
                img_html = "<img src="+src+">";
                $('#modal-md .modal-body').append(img_html)
            })
        }
        float_image(className="product-thumbnail", x=60, y=0)

    </script>

@endsection



