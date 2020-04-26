@extends(config('theme.staff.staff-app'))

@section('title','MH - 訂單列表')

@section('css')
<style type="text/css">
    <!--
    table{
        border-collapse:collapse;
        border:1px solid black;
    }

    th, td {
        border:1px solid black;
        padding: 3px;
        margin: 0px;
    }
    table tr:hover{
        background-color: yellow;
    }
    -->
</style>
@endsection
@section('content')
    <div class="container-full">
        <section class="content fontsize-1">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border m-10 p-0">
                            <form class="mb-0">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">MH指令號</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="mh_order_codes" placeholder="MH指令號" value="{{request()->mh_order_codes}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">客戶訂單號</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="c_order_codes" placeholder="客戶訂單號" value="{{request()->c_order_codes}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">採購單號</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="c_purchase_codes" placeholder="客戶採購單號" value="{{request()->c_purchase_codes}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">型體名稱</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="model_names" placeholder="請輸入型體名稱" value="{{request()->model_names}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">部門</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="departments" placeholder="請輸 IP,SP,RB" value="{{request()->departments}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">訂單狀況</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="order_conditions" placeholder="請輸訂單狀況" value="{{request()->order_conditions}}">
                                    </div>
                                    <label class="col-sm-1 col-form-label">訂單類型</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="order_types" placeholder="請輸訂單類型" value="{{request()->order_types}}">
                                    </div>

                                    <label class="col-sm-1 col-form-label">顏色</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type="text" name="colors" placeholder="請輸入顏色" value="{{request()->colors}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{route('staff.reportMHOrder.analysis')}}" class="form-control btn btn-sm btn-primary">重新搜尋</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="form-control btn btn-sm btn-primary" name="submit['submit_get']" value="submit_get">搜尋</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-1">
                                        <div>
                                            <button type="button" class="form-control btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">下載</button>
                                            <div class="dropdown-menu" style="will-change: transform;">
                                                <button type="submit" class="dropdown-item" name="submit[download_shoes_order_with_sizes]" value="download_shoes_order_with_sizes">訂單(含Size)</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>

                        {{--顯示內容--}}
                        <div class="box-body div_overflow-x m-10 p-0">
                            {{--CrawlerItem 爬蟲項目--}}
                            <div class="infinite-scroll">
                                <table class="itable" >
                                    <thead class="text-center">
                                        <tr class="bg-primary">
                                            <th>No.</th>
                                            @foreach($size_oders as $size)
                                                <th class="m-5 p-5" style="min-width:50px;">{{$size}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($shoes_molds->groupBy('m_id') as $model_name => $shoes_molds_gb_models)
                                            <tr>
                                                <td>{{$model_name}}</td>
                                                @foreach($size_oders as $size)
                                                    @php
                                                        $total = $shoes_molds_gb_models->filter(function($item) use($size){
																   return $item->size == $size;
															   })->sum('qty')
                                                    @endphp
                                                    <td>{{$total==0? "":$total}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
{{--                                --}}{{--点击加载下一页的按钮--}}
{{--                                <div class="text-center">--}}
{{--                                    --}}{{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
{{--                                    @if( $shoes_molds->currentPage() == $shoes_molds->lastPage())--}}
{{--                                        <span class="text-center text-muted">没有更多了</span>--}}
{{--                                    @else--}}
{{--                                        --}}{{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
{{--                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $shoes_molds->appends($filters)->nextPageUrl() }}">--}}
{{--                                            加载更多....--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

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
                autoTriggerUntil: 2,
                // 设置加载下一页缓冲时的图片
                loadingHtml: '<div class="text-center"><img class="center-block" src="{{asset('images/default/icons/loading.gif')}}" alt="Loading..." /><div>',
                padding: 0,
                nextSelector: 'a.jscroll-next:last',
                contentSelector: '.infinite-scroll',
                callback:function() {
                    float_image(className="item-image", x=90, y=-10)
                }
            });
        });
    </script>
@endsection
