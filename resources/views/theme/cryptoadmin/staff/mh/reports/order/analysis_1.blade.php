@extends(config('theme.staff.staff-app'))

@section('title','MH - 訂單列表')

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
                        <div class="box-body div_overflow-x">
                            {{--CrawlerItem 爬蟲項目--}}
                            <div class="infinite-scroll">
                                <table class="table table-bordered table-stripped fontsize-1">
                                    <thead class="text-center">
                                        <tr class="">
                                            <th>編號</th>
                                            <th>接單日期</th>
                                            <th>客戶採購單號</th>
                                            <th>訂單類型</th>
                                            <th>總數</th>
                                            @foreach($size_oders as $size)
                                                <th class="w-50">{{$size}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($shoes_orders as $shoes_order)
                                            <tr class="pull-up">
                                                <td>
                                                    {{($shoes_orders->currentPage()-1)*($shoes_orders->perPage()) + $loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$shoes_order->received_at}}<br>
                                                    {{$shoes_order->model_name}}<br>
                                                    {{$shoes_order->mh_order_code}}<br>
                                                    {{$shoes_order->department}}<br>
                                                </td>
                                                <td>{{$shoes_order->c_purhcase_code}}</td>
                                                <td>{{$shoes_order->order_type}}</td>
                                                <td>{{   $shoes_order->ShoesOrderDetails->count()>0?
                                                            $shoes_order->ShoesOrderDetails->sum('qty'): ""}}</td>
                                                @foreach($size_oders as $size)
                                                        <td>{{$item = $shoes_order->ShoesOrderDetails->where('size',$size)->first()?
                                                                        $shoes_order->ShoesOrderDetails->where('size',$size)->first()->qty : ""}}</td>
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
                autoTriggerUntil: 0,
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
