@extends(config('theme.member.member-app'))

@section('title','代理商後台')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                Blank pagexx
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Sample Page</li>
                <li class="breadcrumb-item active">Blank page</li>
            </ol>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Title</h4>
                        </div>
                        <div class="box-body">
                            @php $index=1;@endphp
                            @foreach($products as $product)
                                @foreach($product->all_skus as $sku)
                                <div class="row pull-up border mb-5 p-5">
                                    <div class="col-1">{{$index++}}</div>
                                    <div class="col-1">
                                        <img class="product-sku-thumbnail" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" />
                                    </div>
                                    <div class="col-2">
                                        {{$product->p_name}}<br>
                                        <span class="font-size-12">{{$product->id_code}}</span>
                                    </div>
                                    <div class="col-1">
                                        <img class="product-sku-thumbnail" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" />
                                    </div>
                                    <div class="col-4">
                                        {{$sku->sku_name}}<br>
                                        <span class="font-size-12">{{$sku->id_code}}</span>
                                    </div>
                                    <div class="col-1">
                                        {{$sku->price}}
                                    </div>
                                    <div class="col-3">
                                        {{dd($sku->crawlerTaskItemSKU)}}
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>
@stop
