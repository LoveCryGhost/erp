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
                        <div class="box-header">
                            <div class="row">
                                <div class="col">
                                    <form class="form-control m-b-0  bg-color-lightblue">
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/reports/skuCrawleritem.index.search.sellPrice')}}</h5>
                                                <div class="controls">
                                                    <input class="iform-control w-110" type="text" name="sku_translations_price_min" placeholder="{{__('default.index.search.min')}}" value="{{request()->sku_translations_price_min}}">
                                                    ~
                                                    <input class="iform-control w-110"  type="text" name="sku_translations_price_max" placeholder="{{__('default.index.search.max')}}" value="{{request()->sku_translations_price_max}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/reports/skuCrawleritem.index.search.profit')}}</h5>
                                                <div class="controls">
                                                    <input class="iform-control" type="text" name="profit" placeholder="{{__('member/reports/skuCrawleritem.index.search.profit')}}" value="{{request()->profit}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/reports/skuCrawleritem.index.search.totalSeller')}}</h5>
                                                <div class="controls">
                                                    <input class="iform-control" type="text" name="totalSeller" placeholder="{{__('member/reports/skuCrawleritem.index.search.totalSeller')}}" value="{{request()->totalSeller}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <h5>{{__('member/reports/skuCrawleritem.index.search.monthlyProfit')}}</h5>
                                                <div class="controls">
                                                    <input class="iform-control" type="text" name="monthlyProfit" placeholder="{{__('member/reports/skuCrawleritem.index.search.monthlyProfit')}}" value="{{request()->monthlyProfit}}">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{route('member.reportSKU.crawlerItemAanalysis')}}" class="form-control btn btn-sm btn-primary">{{__('member/supplierGroup.index.search.reset')}}</a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">{{__('member/supplierGroup.index.search.submit')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box-body div_overflow-x">
                            <div class="infinite-scroll">
                                <table class="itable table">
                                    <thead>
                                        <tr>
                                            <th>{{__('default.index.table.no')}}</th>
                                            <th>{{__('default.index.table.name')}}</th>
                                            <th>
                                                {{__('member/reports/skuCrawleritem.index.table.skuName')}}<br>
                                                {{__('default.index.table.dimenssion')}}
                                            </th>
                                            <th>{{__('member/reports/skuCrawleritem.index.search.sellPrice')}}</th>
                                            <th>{!!__('member/reports/skuCrawleritem.index.table.purchasePrice')!!}</th>
                                            <th>{!!__('member/reports/skuCrawleritem.index.table.shippingCost') !!}</th>
                                            <th>{{__('member/reports/skuCrawleritem.index.table.profit')}}</th>
                                            <th>{{__('member/reports/skuCrawleritem.index.table.profitAnalysis')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index=1;@endphp
                                        @foreach($skus as $sku)
                                            <tr>
                                                <td>
                                                    {{($skus->currentPage()-1)*($skus->perPage()) + $loop->iteration}}<br>
                                                </td>
                                                <td class="text-left">
                                                    {{$sku->p_name}}<br>
                                                    <img class="item-image img-30 rounded" src="{{$sku->p_img_path!==null? asset($sku->p_img_path):asset('images/default/products/product.jpg')}}" />
                                                </td>
                                                <td class="text-left">
                                                    {{$sku->sku_name}}
                                                    {{$sku->length_pcs}}x{{$sku->width_pcs}}x{{$sku->heigth_pcs}}<br>
                                                    <small>({{$sku->volume_pcs}})</small>
                                                </td>
                                                <td>{{$sku->sell_price}}</td>
                                                
                                                <td>{{$sku->sku_supplier_purchase_price}}</td>
                                                <td>{{$sku->shipping_cost}}</td>
                                                <td>{{$sku->profit}} %</td>
                                                <td class="text-left">{{__('member/reports/skuCrawleritem.index.table.monthlySellQty')}}: {{$sku->total_monthly_sold}}<br>
                                                    {{__('member/reports/skuCrawleritem.index.table.totalSellQty')}}: {{$sku->total_historical_sold}}<br>
                                                    {{__('member/reports/skuCrawleritem.index.table.sellerQty')}}: {{$sku->total_seller}}
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
                    float_image(className="item-image", x=70, y=-10)
                }
            });
        });
    </script>
@endsection
