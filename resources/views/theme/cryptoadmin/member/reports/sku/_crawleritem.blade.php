@extends(config('theme.member.member-app'))

@section('title', __('member/reports/skuCrawleritem.title'))

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/reports/skuCrawleritem.title')}}
            </h3>
            
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            <div class="infinite-scroll">
                                <table class="itable table">
                                    <thead>
                                        <tr>
                                            <th>{{__('default.index.table.no')}}</th>
                                            <th>{{__('default.index.table.image')}}</th>
                                            <th>{{__('default.index.table.name')}}</th>
                                            <th>{{__('default.index.table.price')}}</th>
                                            <th>{{__('default.create.info')}}</th>
                                            <th>{{__('default.index.table.crud')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index=1;@endphp
                                        @foreach($products as $product)
                                            @foreach($product->all_skus as $sku)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td><img class="item-image img-60 rounded" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" /></td>
                                                <td>
                                                    <span>
                                                        {{$product->p_name}}<br>
                                                    <span class="font-size-12">{{$product->id_code}}</span><br>
                                                    </span>
                                                    <span class="text-blue">
                                                        {{$sku->sku_name}}<br>
                                                    <span class="font-size-12">{{$sku->id_code}}</span>
                                                </span>
                                                </td>
                                                <td>{{$sku->price}}</td>
                                                <td>
                                                    @php
                                                        $daySales7_total = 0;
                                                        $daySales30_total = 0;
                                                        $nDays_total = 0;
                                                        foreach($sku->crawlerTaskItemSKU as $crawlerTaskItemSKU){
                                                            if($crawlerTaskItemSKU->crawlerItemSKUDetails(1)->count()>0){
                                                                $daySales7 = $crawlerTaskItemSKU->nDaysSales(7);
                                                                $daySales7_total+= $daySales7;
                                                                
                                                                $daySales30 = $crawlerTaskItemSKU->nDaysSales(30);
                                                                $nDays_total+=$crawlerTaskItemSKU->crawlerItemSKUDetails(1)->first()->sold;
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
                                                </td>
                                                <td>
                                                    <input type="text" name="amount" id="amount">
                                                    <span class="btn btn-primary btn-lg" onclick="purchase_order_cart_item_add(this, php_inject={{json_encode(['sku_id' => $sku->sku_id])}});"><i class="fa fa-plus"></i></span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                {{--点击加载下一页的按钮--}}
                                <div class="text-center">
                                    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                    @if( $products->currentPage() == $products->lastPage())
                                        <span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
                                    @else
                                        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $products->appends($filters)->nextPageUrl() }}">
                                            {{__('default.index.lazzyload_more_records')}}
                                        </a>
                                    @endif
                                </div>
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
    <script src="{{asset('js/jscroll.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $('.infinite-scroll').jscroll({
                // 当滚动到底部时,自动加载下一页
                autoTrigger: true,
                // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
                autoTriggerUntil: 10,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 10,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: '.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });
    </script>
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
