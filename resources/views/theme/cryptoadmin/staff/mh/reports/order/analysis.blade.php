@extends(config('theme.staff.staff-app'))

@section('title','MH - 訂單列表')

@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border p-1">
                            <form class="mb-0">
                            <div class=" row">
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
                                <label class="col-sm-1 col-form-label">客戶名稱</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="c_names" placeholder="請輸入客戶名稱" value="{{request()->c_names}}">
                                </div>
                                <label class="col-sm-1 col-form-label">接單日期(起)</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="text" name="received_start_at" placeholder="接單起始日" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{request()->received_start_at}}">
                                </div>
                                <label class="col-sm-1 col-form-label">接單日期(終)</label>
                                <div class="col-sm-2">
                                   <input class="form-control" type="text" name="received_end_at" placeholder="接單終止日" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{request()->received_end_at}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <a href="{{route('staff.mh.report.order_analysis')}}" class="form-control btn btn-primary mt-5">重新搜尋</a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="form-control btn btn-primary mt-5">搜尋</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="box-body div_overflow-x m-0 p-1">
                            {{--CrawlerItem 爬蟲項目--}}
                            <div class="infinite-scroll">
                                <table class="table table-bordered table-striped table-hover fontsize-1">
                                    <thead class="text-center">
                                        <tr class="bg-primary">
                                            <th class="m-5 p-5">編號</th>
                                            <th class="m-5 p-5">部門</th>
                                            <th class="m-5 p-5">型體</th>
                                            <th class="m-5 p-5">客戶名稱</th>
                                            <th class="m-5 p-5">訂單狀況</th>
                                            <th class="m-5 p-5">MH指令號</th>
                                            <th class="m-5 p-5">客戶訂單號</th>
                                            <th class="m-5 p-5">客戶採購單號</th>
                                            <th class="m-5 p-5">訂單類型</th>
                                            <th class="m-5 p-5">預告日期</th>
                                            <th class="m-5 p-5">接單日期</th>

                                            <th class="m-5 p-5">顏色</th>
                                            <th class="m-5 p-5">品名</th>
                                            <th class="m-5 p-5">採購日期</th>
                                            <th class="m-5 p-5">進料日期</th>

                                            <th class="m-5 p-5">總數</th>
                                            <th class="m-5 p-5">需求日期</th>
                                            <th class="m-5 p-5">入庫日期</th>
                                            <th class="m-5 p-5">完成日期</th>
                                            <th class="m-5 p-5">出貨日期</th>
                                            @foreach($size_oders as $size)
                                                <th class="m-5 p-5">{{$size}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($shoes_orders as $shoes_order)
                                            <tr>
                                                <td class="m-0 p-0">
                                                    {{($shoes_orders->currentPage()-1)*($shoes_orders->perPage()) + $loop->iteration}}
                                                </td>
                                                <td class="m-0 p-0">{{$shoes_order->department}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->model_name}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->shoesCustomer->c_name}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->order_condition}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->mh_order_code}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->c_order_code}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->c_purchase_code}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->order_type}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->predict_at=="0000-00-00"? "":date('m/d', strtotime($shoes_order->predict_at))}}</td>
                                                <td class="m-0 p-0">{{$shoes_order->received_at=="0000-00-00"? "":date('m/d', strtotime($shoes_order->received_at))}}</td>

                                                <td class="m-0 p-0">{{$shoes_order->color}}</td>
                                                @if($shoes_order->shoesPurchases->count()>0)
                                                    <td class="m-0 p-0">{{$shoes_order->shoesPurchases->first()->material_name}}</td>
                                                    <td class="text-center">{{$shoes_order->shoesPurchases->first()->purchase_at=="0000-00-00"? "": date('m/d', strtotime($shoes_order->shoesPurchases->first()->purchase_at))}}</td>
                                                    <td class="m-0 p-0">{{$shoes_order->shoesPurchases->first()->outbound_at=="0000-00-00"? "": date('m/d', strtotime($shoes_order->shoesPurchases->first()->outbound_at))}}</td>
                                                @else
                                                    <td class="m-0 p-0"></td>
                                                    <td class="m-0 p-0"></td>
                                                    <td class="m-0 p-0"></td>
                                                @endif

                                                <td class="m-0 p-0">{{number_format($shoes_order->qty,0,"",",")}}</td>

                                                <td class="m-0 p-0"></td>
                                                <td class="m-0 p-0"></td>
                                                <td class="m-0 p-0"></td>
                                                <td class="m-0 p-0"></td>

                                                @foreach($size_oders as $size)
                                                        <td class="m-0 p-0">{{$item = $shoes_order->shoesOrderDetails->where('size',$size)->first()?
                                                                        number_format($shoes_order->shoesOrderDetails->where('size',$size)->first()->qty,0,"",",") : ""}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{--点击加载下一页的按钮--}}
                                <div class="text-center">
                                    {{--判断到最后一页就终止, 否则 jscroll 又会从第一页开始一直循环加载--}}
                                    @if( $shoes_orders->currentPage() == $shoes_orders->lastPage())
                                        <span class="text-center text-muted">没有更多了</span>
                                    @else
                                        {{-- 这里调用 paginator 对象的 nextPageUrl() 方法, 以获得下一页的路由 --}}
                                        <a class="jscroll-next btn btn-outline-secondary btn-block rounded-pill" href="{{ $shoes_orders->appends($filters)->nextPageUrl() }}">
                                            加载更多....
                                        </a>
                                    @endif
                                </div>
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
                autoTriggerUntil: 9,
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
