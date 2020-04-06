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
{{--                                    <div class="col-1">--}}
{{--                                        <img class="product-sku-thumbnail" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" />--}}
{{--                                    </div>--}}
                                    <div class="col-1">
                                        <img class="product-sku-thumbnail" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" />
                                    </div>
                                    <div class="col-2">

                                        <span>
                                            {{$product->p_name}}<br>
                                            <span class="font-size-12">{{$product->id_code}}</span><br>
                                        </span>
                                        <span class="text-blue">
                                            {{$sku->sku_name}}<br>
                                            <span class="font-size-12">{{$sku->id_code}}</span>
                                        </span>
                                    </div>
                                    <div class="col-1">
                                        {{$sku->price}}
                                    </div>

                                    <div class="col-1">
                                        @php
                                            $daySales7_total = 0;
                                            $daySales30_total = 0;
                                            $nDays_total = 0;
                                            foreach($sku->crawlerTaskItemSKU as $crawlerTaskItemSKU){
                                                if($crawlerTaskItemSKU->crawlerItemSKUDetails->count()>0){
                                                    $daySales7 = $crawlerTaskItemSKU->nDaysSales(7);
                                                    //$daySales30 = $crawlerTaskItemSKU->nDaysSales(30);
                                                    $nDays_total+=$crawlerTaskItemSKU->crawlerItemSKUDetails->last()->sold;
                                                    $daySales7_total+= $daySales7;
                                                    $daySales30_total+= $daySales30;
                                                }
                                            }
                                        @endphp
                                        週銷量:
                                        {{$daySales7_total}}<br>
                                        月銷量:
                                        {{$daySales30_total}}<br>
                                        總銷量:
                                        {{$nDays_total}}<br>
                                        賣家數量:
                                        {{$sku->crawlerTaskItemSKU->count()}}

                                    </div>
                                    <div>
                                        <input type="text" name="amount" id="amount">
                                        <span class="btn btn-primary btn-lg" onclick="purchase_order_cart_item_add(this, php_inject={{json_encode(['sku_id' => $sku->sku_id])}});"><i class="fa fa-plus"></i></span>
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

@section('js')
<script>
    function purchase_order_cart_item_add(_this, php_inject){
        $.ajaxSetup(active_ajax_header());
        var formData = new FormData();
        formData.append('sku_id', php_inject.sku_id);
        formData.append('amount', $(_this).siblings('#amount').val());
        $.ajax({
            type: 'post',
            url: '{{route('member.purchaseOrderCartItem.add')}}',
            data: formData,
            crossDomain: true,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('加入成功');
            },
            error: function(error) {
                // if (error.response.status === 401) {
                //
                //     // http 状态码为 401 代表用户未登陆
                //     swal('请先登录', '', 'error');
                //
                // } else if (error.response.status === 422) {
                //
                //     // http 状态码为 422 代表用户输入校验失败
                //     var html = '<div>';
                //     _.each(error.response.data.errors, function (errors) {
                //         _.each(errors, function (error) {
                //             html += error+'<br>';
                //         })
                //     });
                //     html += '</div>';
                //     swal({content: $(html)[0], icon: 'error'})
                // } else {
                //     // 其他情况应该是系统挂了
                //     swal('系统错误', '', 'error');
                // }
            }
        });
    }
</script>
@endsection
