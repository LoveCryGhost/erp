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
                        <div class="box-body div_overflow-x">
                            <div class="infinite-scroll">
                                <table class="itable table">
                                    <thead>
                                    <tr>
                                        <th>{{__('default.index.table.no')}}</th>
                                        <th>{{__('default.index.table.name')}}</th>
                                        <th>{{__('member/reports/skuCrawleritem.index.table.skuName')}}</th>
                                        <th>
                                            <span class="pull-left">{{__('default.index.table.price')}}</span>
                                            <span class="pull-right">{!! __('member/product.productSupplier.index.profitPercentage')!!}</span>
                                        </th>
                                        <th>{{__('member/reports/skuCrawleritem.profitAnalysis')}}</th>
                                        <th>{{__('default.index.table.crud')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $index=1;@endphp
                                    @foreach($skus as $sku)
                                        <tr>
                                            @php
                                                //運費
													$cbm_price = $sku->skuSuppliers()->wherePivot('is_active',1)->first()->supplierGroup->cbm_price;
													$volume_pcs = $sku->length_pcs * $sku->width_pcs * $sku->heigth_pcs ;
													$shippingCost_byPcs=($volume_pcs/1000000)*$cbm_price;
													
													$volume_box = $sku->length_box * $sku->width_box * $sku->heigth_box ;
													$shippingCost_byBox = ($volume_box/1000000/$sku->pcs_per_box)*$cbm_price;
													
                                                //採購單價
                                                    $sku_pivot_supplier = $sku->skuSuppliers()->wherePivot('is_active',1)->first();
                                                    
                                                //成本 = 採購 + 運費
                                                    $cost_pcs  = $sku_pivot_supplier->pivot->price + $shippingCost_byPcs;
                                                    $cost_box = $sku_pivot_supplier->pivot->price + $shippingCost_byBox;
                                                //利潤
                                                    $profit_per_unit_pcs = $sku->price - $cost_pcs ;
                                                    
                                                    $profit_per_unit_box = $sku->price - $cost_box ;
                                                    
                                                    $daySales7_total = 0;
													$daySales30_total = 0;
													$nDays_total = 0;
												//
												$proffit_per_unit_class="";
                                            @endphp
                                            <td>{{$index++}}</td>
                                            <td class="text-left" style="vertical-align: text-top">
                                                    
                                                    {{$sku->product->p_name}}<br>
                                                    <span class="font-size-12">{{$sku->product->id_code}}</span><br>
                                                    <img class="item-image img-30 rounded" src="{{$sku->thumbnail!==null? asset($sku->thumbnail):asset('images/default/products/product.jpg')}}" /><br>
                                            </td>
                                            <td class="text-left" style="vertical-align: text-top">
                                                    {{$sku->sku_name}}<br>
                                                    <span class="font-size-12">{{$sku->id_code}}</span><br>
                                                    {{$sku->length_pcs}}x{{$sku->width_pcs}}x{{$sku->heigth_pcs}}
                                                
                                                     = ({{number_format($volume_pcs,0,"",",")}})<br>
                                                    ({{number_format($cbm_price,0,"",",")}}/CBM)
                                            </td>
                                            
                                            
                                            <td class="text-right">
                                                <div class="pull-left">
                                                {{--售價--}}
                                                {{number_format($sku->price,0,"",",")}}<br>
                                                
                                                
                                                @if($sku_pivot_supplier)
                                                    - {{number_format($sku_pivot_supplier->pivot->price,0,"",",")}}<br>
                                                @endif
                                                    - {{number_format($shippingCost_byPcs,0,"",",")}}<br>
                                                -------------<br>
                                                {{number_format($profit_per_unit_pcs,0,"",",")}}<br>
                                                @if($cost_pcs>0)
                                                    <span class="{{$profit_per_unit_pcs>0? $proffit_per_unit_class="text-green":$proffit_per_unit_class="text-red"}}">
                                                    {{number_format($profit_per_unit_pcs/$cost*100, 1, ".", ",")}} %
                                                    </span>
                                                @endif
                                                </div>
    
                                                {{--利潤 %--}}
                                                <div class="pull-right">
                                                    {{--售價--}}
                                                    {{number_format($sku->price,0,"",",")}}<br>
    
    
                                                    @if($sku_pivot_supplier)
                                                        - {{number_format($sku_pivot_supplier->pivot->price,0,"",",")}}<br>
                                                    @endif
                                                    - {{number_format($shippingCost_byBox,0,"",",")}}<br>
                                                    -------------<br>
                                                    {{number_format($profit_per_unit_box,0,"",",")}}<br>
                                                    @if($cost_box>0)
                                                        <span class="{{$profit_per_unit_box>0? $proffit_per_unit_class="text-green":$proffit_per_unit_class="text-red"}}">
                                                    {{number_format($profit_per_unit_box/$cost*100, 1, ".", ",")}} %
                                                    </span>
                                                    @endif
                                                
                                                </div>
                                            </td>
                                            
                                            {{--訊息--}}
                                            <td class="text-left" style="vertical-align: text-top">
                                                @php
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
                                                {{__('member/reports/skuCrawleritem.index.table.sellerQty')}}: {{$sku->crawlerTaskItemSKU->count()}}<br>
                                                {{__('member/reports/skuCrawleritem.index.table.weeklySellQty')}}:
                                                <span class="{{$proffit_per_unit_class}}"> {{number_format($profit_per_unit,0,"",",")}} </span> x {{$daySales7_total}} = {{number_format($profit_per_unit*$daySales7_total,0,"",",")}}
                                                <br>
                                                
                                                {{__('member/reports/skuCrawleritem.index.table.monthlySellQty')}}:
                                                <span class="{{$proffit_per_unit_class}}"> {{number_format($profit_per_unit,0,"",",")}} </span> x {{$daySales30_total}} = {{number_format($profit_per_unit*$daySales30_total,0,"",",")}}<br>
                                                
                                                {{__('member/reports/skuCrawleritem.index.table.totalSellQty')}}:
                                                <span class="{{$proffit_per_unit_class}}"> {{number_format($profit_per_unit,0,"",",")}} </span> x {{$nDays_total}} = <br>
                                                
                                                <div class="pull-right"><u><b><span class="{{$proffit_per_unit_class}}">{{number_format($profit_per_unit*$nDays_total,0,"",",")}}</span></b></u></div>
                                            </td>
                                            
                                            <td>
                                                <input class="w-100" type="text" name="amount" id="amount">
                                                <span class="btn btn-primary btn-sm" onclick="purchase_order_cart_item_add(this, php_inject={{json_encode(['sku_id' => $sku->sku_id])}});"><i class="fa fa-plus"></i></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--点击加载下一页的按钮--}}
                                <div class="text-center">
                                    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                    @if( $skus->currentPage() == $skus->lastPage())
                                        <span class="text-center text-muted">{{__('default.index.lazzyload_no_more_records')}}</span>
                                    @else
                                        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $skus->appends($filters)->nextPageUrl() }}">
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
                    float_image(className="item-image", x=40, y=-10)
                }
            });
        });
        float_image(className="item-image", x=40, y=-10)
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
